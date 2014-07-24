<?php


session_start();


class Control
{
    protected $mysqli;
    protected $salt = "thegreatpolarbear";
    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;     
        $this->Init();
    }
    
    private function Init()
    {
        $this->mysqli->query("CREATE TABLE IF NOT EXISTS comm"
                . "(id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,"
                . "names VARCHAR(30) NOT NULL,"
                . "username VARCHAR(30) NOT NULL,"
                . "email VARCHAR(100) NOT NULL,"
                . "password VARCHAR(100) NOT NULL,"
                . "country VARCHAR(100) NOT NULL,"
                . "dob VARCHAR(8) NOT NULL,"
                . "photo VARCHAR(255) NOT NULL)");
        $this->mysqli->query("CREATE TABLE IF NOT EXISTS firms"
                . "(id INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,"
                . "name VARCHAR(50) NOT NULL,"
                . "firmID VARCHAR(20) NOT NULL,"
                . "passcode VARCHAR(100) NOT NULL,"
                . "country VARCHAR(20) NOT NULL,"
                . "home VARCHAR(50) NOT NULL,"
                . "motto VARCHAR(30) NOT NULL,"
                . "logo VARCHAR(255) NOT NULL,"
                . "avg_rating DECIMAL NOT NULL)");
        
        $this->mysqli->query("CREATE TABLE IF NOT EXISTS products"
                . "(id INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,"
                . "name VARCHAR(100) NOT NULL,"
                . "price DECIMAL NOT NULL,"
                . "firmID VARCHAR(20) NOT NULL,"
                . "img VARCHAR(255) NOT NULL,"
                . "rating DECIMAL NOT NULL DEFAULT 0.0,"
                . "description LONGTEXT NOT NULL)") or die($this->mysqli->error);
        
        $this->mysqli->query("CREATE TABLE IF NOT EXISTS product_views"
                . "(id INT(15) NOT NULL AUTO_INCREMENT PRIMARY KEY,"
                . "product_view LONGTEXT NOT NULL,"
                . "product_id INT(12) NOT NULL,"
                . "product_viewer INT(10) NOT NULL)");
        
        $this->mysqli->query("CREATE TABLE IF NOT EXISTS product_rating"
                . "(id INT(15) NOT NULL AUTO_INCREMENT PRIMARY KEY,"
                . "product_id INT(12) NOT NULL,"
                . "rater INT(10) NOT NULL,"
                . "rating INT(2) NOT NULL)");
        
         
    }
    
    protected function cleanData($inputs)
    {
        foreach($inputs as &$input)
        {
            preg_replace("/;/","",$input);
            $input = mysql_real_escape_string(htmlspecialchars(htmlentities(strip_tags(trim($input)))));
        }
        
    }
    
    protected function hashData($input)
    {
        return hash("sha256",($input.$this->salt));
    }
            
        
    public function uploadImg($fileobj,$max=1887436.8,$min=71680)
    {
        $validmimes = array("jpg","jpeg","png","gif","bmp");
        if($fileobj['error'] > 0)
        {
            return "-31";
        }
        
        if($fileobj['size'] < $min || $fileobj['size'] > $max)
        {
            return "-32";
        }
        
        $basename = pathinfo($fileobj['name'],PATHINFO_BASENAME);
        $ext = pathinfo($fileobj['name'],PATHINFO_EXTENSION);
        
        if(!in_array($ext,$validmimes))
        {
            return "-33";
        }
        
        $basename = md5(uniqid($basename));
        $fname = $basename.".".$ext;
        
        $fpath = dirname(__FILE__)."/../img/comm/".$fname;
        
        move_uploaded_file($fileobj['tmp_name'], $fpath);
        
        return $fname;
        
        
    }
        
    
}