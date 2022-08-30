<?php 
namespace App\Classes;
use App\Models\Generalsetting;
class PHP_AES_Cipher {

	private static $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher
	private static $CIPHER_KEY_LEN = 16; //128 bits
	//private static $key =  "";// given by payle system

	/**
 	* Encrypt data using AES Cipher (CBC) with 128 bit key
 	*
 	* @param type $key - key to use should be 16 bytes long (128 bits)
 	* @param type $data - data to encrypt
 	* @return encrypted data in base64 encoding with iv attached at end after a :
 	*/

	static function encrypt($data) {
		$settings = Generalsetting::findOrFail(1);
		$key=$settings->payle_resource_key;
    	if (strlen($key) < PHP_AES_Cipher::$CIPHER_KEY_LEN) {
        	$key = str_pad("$key", PHP_AES_Cipher::$CIPHER_KEY_LEN, "0"); //0 pad to len 16
    	} else if (strlen($key) > PHP_AES_Cipher::$CIPHER_KEY_LEN) {
        	$key = substr($str, 0, PHP_AES_Cipher::$CIPHER_KEY_LEN); //truncate to 16 bytes
    	}



    	    	
    	$encryptedPayload = bin2hex (openssl_encrypt($data, PHP_AES_Cipher::$OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $key));

    	return strtoupper($encryptedPayload);

	}


    

	/**
 	* Decrypt data using AES Cipher (CBC) with 128 bit key
 	*
 	* @param type $key - key to use should be 16 bytes long (128 bits)
 	* @param type $data - data to be decrypted in base64 encoding with iv attached at the end after a :
 	* @return decrypted data
 	*/
	static function decrypt($data="") {

		$settings = Generalsetting::findOrFail(1);
		$key=$settings->payle_resource_key;
    	if (strlen($key) < PHP_AES_Cipher::$CIPHER_KEY_LEN) {
        	$key = str_pad("$key", PHP_AES_Cipher::$CIPHER_KEY_LEN, "0"); //0 pad to len 16
    	} else if (strlen($key) > PHP_AES_Cipher::$CIPHER_KEY_LEN) {
        	$key = substr($str, 0, PHP_AES_Cipher::$CIPHER_KEY_LEN); //truncate to 16 bytes
    	}
		
    	$hex2bin = hex2bin($data);


    	$decryptedData = openssl_decrypt($hex2bin, PHP_AES_Cipher::$OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $key);


     

    	// $parts = explode(':', $data); //Separate Encrypted data from iv.
    	// $decryptedData = openssl_decrypt(base64_decode($parts[0]), PHP_AES_Cipher::$OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, base64_decode($parts[1]));

    	return $decryptedData;
	}

}
?>