<?php
$hostname="localhost"; //local server name default localhost
$username="root";  //mysql username default is root.
$password="mephibosheth.";       
$database="msh_db";  
$con=mysql_connect($hostname,$username,$password);
if(! $con)
{
        die('Connection Failed'.mysql_error());
}
mysql_select_db($database,$con);	
?>