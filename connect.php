<?php
$serverName  = "DESKTOP-5FCO0CO";
$connectionInfo  = array( "Database"=>"phpDemoClass", "UID"=>"", "PWD"=>"");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) 
{
     echo "Connection established.<br />";
}
else
{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>