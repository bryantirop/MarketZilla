<?php

require_once '../sys/conn.php';
require_once '../sys/Loggs.php';



    $name = $_POST['firmName'];
    $fid = $_POST['firmID'];
    $fpass = $_POST['firmPass'];
    $fcountry = $_POST['firmCountry'];
    $fhome = $_POST['firmHome'];
    $fmotto = $_POST['firmMotto'];
    $flogo = $_FILES['firmLogo'];
    
    
    $reg = new Loggs($mysqli);
    $reg->regFirm($name, $fid, $fpass, $fpass, $fcountry, $fhome, $fmotto, $flogo);  
    
    
    


