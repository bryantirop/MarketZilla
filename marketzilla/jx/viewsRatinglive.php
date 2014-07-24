<?php
require_once '../sys/conn.php';
require_once '../sys/Product.php';

$prod = $_POST['trg_p'];

$product = new Product($mysqli,$prod);

if(isset($_POST['the_view']) || !empty($_POST['the_view']))
{
    $view = $_POST['the_view'];
    $product->setView($view);
}
if(isset($_POST['rating']) || !empty($_POST['rating']))
{
    $rating = $_POST['rating'];
    $product->setRating($rating);
}







