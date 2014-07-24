<?php

$mysqli = new mysqli("localhost","root","");

if(!$mysqli)
{
    die("Sorry could not connect to server. Error :".$mysqli->error);
}

while(!$mysqli->select_db("marketApp"))
{
    $mysqli->query("CREATE DATABASE IF NOT EXISTS marketApp") or die($mysqli->error);
}
