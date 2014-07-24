<?php

require_once '../sys/conn.php';
require_once '../sys/Data.php';


if(isset($_POST['submitCreateProduct']))
{
    
    $name = $_POST['productName'];
    $firm = $_SESSION['uid'];
    $price = $_POST['productPrice'];
    $desc = $_POST['productDesc'];
    $img = $_FILES['productImg'];
    
    
    
    $reg = new Data($mysqli);
    
    echo $reg->addProduct($name, $price, $firm, $img, $desc);     
    
}


