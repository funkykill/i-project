<?php
$host = '(local)';
$database = 'EenmaalAndermaal';
$username = 'sa';
$pw = 'ma0957646622';

try{
    $con = new PDO("sqlsrv:Server=$host;Database=$database", "$username", "$pw");
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOexception $e){
   echo $e->getmessage();
}
?>