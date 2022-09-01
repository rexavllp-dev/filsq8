<?php
ini_set('max_execution_time', 300);

if (!isset($_POST['web_name']) || $_POST['web_name'] == ""){
  echo "Please Enter Website Name";
}else if (!isset($_POST['web_url']) || $_POST['web_url'] == ""){
    echo "Please Enter Website URL";
}else  if (!isset($_POST['database_host']) || $_POST['database_host'] == ""){
    echo "Please Enter Database Host";
}else  if (!isset($_POST['database_name']) || $_POST['database_name'] == ""){
    echo "Please Enter Database Name";
}else if (!isset($_POST['database_username']) || $_POST['database_username'] == ""){
    echo "Please Enter Database Username";
}else {
    //if (isset($_POST['p_code']) && $_POST['p_code'] != ""){

    // Name of the file
    $filename = 'database/database.sql';
    // MySQL host
    $mysql_host = $_POST['database_host'];
    // MySQL username
    $mysql_username = $_POST['database_username'];
    // MySQL password
    $mysql_password = $_POST['database_password'];
    // Database name
    $mysql_database =  $_POST['database_name'];

    //$purchase_code =  $_POST['p_code'];
    $website_url =  $_POST['web_url'];
	
	$chkData = base64_decode('eyJzdGF0dXMiOiJzdWNjZXNzIiwicDEiOiIuLlwvcHJvamVjdFwvdmVuZG9yXC9tYXJrdXJ5XC9zcmNcLy5lbnYifQ==');

    $chk = json_decode($chkData,true);

    if($chk['status'] != "success")
    {
        echo "<h4>".$chk['message']."</h4>";
    }else{

        $p1 = $chk['p1'];

        restoreDatabaseTables($mysql_host, $mysql_username, $mysql_password, $mysql_database, $filename);

        setEnvironmentIni();
        setEnvironmentValue('APP_URL','http://localhost',$website_url);
        setEnvironmentValue('DB_HOST','localhost',$mysql_host);
        setEnvironmentValue('DB_DATABASE','database_name',$mysql_database);
        setEnvironmentValue('DB_USERNAME','database_user',$mysql_username);
        setEnvironmentValue('DB_PASSWORD','database_pass',$mysql_password);
        setUp($p1);
        echo "success";
    }

}
//else{
//    echo "Please Enter Your Purchase Code.";
//}

function setEnvironmentIni()
{
    $ctFile1 = 'initialize.txt';
    $ctFile = 'setup.txt';
    $str = file_get_contents($ctFile1);
    $fp = fopen($ctFile, 'w');
    fwrite($fp, $str);
}

function setEnvironmentValue($envKey,$oldValue, $envValue)
{
    $ctFile = 'setup.txt';
    $str = file_get_contents($ctFile);
    $str = str_replace($envKey."=".$oldValue, $envKey."=".$envValue, $str);

    $fp = fopen($ctFile, 'w');
    fwrite($fp, $str);
}

function setUp($goFile){
    $setFile = 'setup.txt';
    $str = file_get_contents($setFile);
    $fp = fopen($goFile, 'w');
    fwrite($fp, $str);
}



function restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath){
    // Connect & select the database
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 

    // Temporary variable, used to store current query
    $templine = '';
    
    // Read in entire file
    $lines = file($filePath);
    
    $error = '';
    
    // Loop through each line
    foreach ($lines as $line){
        // Skip it if it's a comment
        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }
        
        // Add this line to the current segment
        $templine .= $line;
        
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';'){
            // Perform the query
            if(!$db->query($templine)){
                $error .= 'Error performing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
            }
            
            // Reset temp variable to empty
            $templine = '';
        }
    }
    return !empty($error)?$error:true;
}



