<?php
$host="localhost";
$db="a3002193_scp";
$user="a3002193_developer";
$pwd="developer123";

$dsn="mysql:host=$host; dbname=$db";
try
{
    $conn= new PDO($dsn,$user,$pwd);
}
catch(PDOException $error)
{
echo "<h3> Error </h3>" . $error->getMessage(); 
}