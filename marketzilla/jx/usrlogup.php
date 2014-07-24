<?php

require_once dirname(__FILE__)."/../sys/conn.php";
require_once dirname(__FILE__)."/../sys/Control.php";
require_once dirname(__FILE__)."/../sys/Loggs.php";

new Control($mysqli);

$names = $_POST['names'];
$email = $_POST['email'];
$country = $_POST['country'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$dob = $_POST['dob'];
$username = $_POST['usrname'];

if(preg_match("/\/|-/",$dob) === 0)
{
    echo "-7";
    exit;
}
$date_parts=  explode("/",$dob);

if(!checkdate($date_parts[0],$date_parts[1],$date_parts[2]))
{
    echo "-7";
    exit;
}

$timeb = date("U",  mktime(0, 0, 0, $date_parts[0], $date_parts[1], $date_parts[2]));
$now = date("U",time());

if((($now - $timeb)/(3600*24*365.15))< 16)
{
    echo "-6";
    exit;
}

$loger = new Loggs($mysqli);
$res = $loger->SignUpUsr($names, $username, $email, $pass1, $pass2, $country, $dob);
echo $res;


exit;