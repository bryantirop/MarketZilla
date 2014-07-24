<?php
require_once dirname(__FILE__)."/../sys/conn.php";
require_once dirname(__FILE__)."/../sys/Loggs.php";

$logtype = $_POST['logtype'];

$logs = new Loggs($mysqli);


if($logtype == "usr")
{
    $uname = $_POST['usrname'];
    $upwd = $_POST['usrpwd'];
    $urem = $_POST['usrem'];
    
    if($urem == "on")
    {
        echo $logs->LogUser($uname, $upwd, $rem);
    }
    else
    {
         echo $logs->LogUser($uname, $upwd);
    }
    
    
}
else if($logtype == "firm")
{
    $firmID = $_POST['firmID'];
    $firmPass = $_POST['firmPass'];
    
    echo $logs->LogFirm($firmID, $firmPass);
    
}
else
{
    echo "Unknown request";
    exit;
}
