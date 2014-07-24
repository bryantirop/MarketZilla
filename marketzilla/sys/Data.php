<?php
require_once dirname(__FILE__)."/conn.php";
require_once dirname(__FILE__)."/Control.php";
require_once dirname(__FILE__)."/Firms.php";
require_once dirname(__FILE__)."/Product.php";
require_once dirname(__FILE__)."/User.php";

class Data extends Control
{
    private $party,$party_country;
    public function __construct($mysqli)
    {
        parent::__construct($mysqli);
        
        $this->getParty();
    }
    
    public function getAllProducts($col,$order,$country = NULL)
    {
        $query = "SELECT * FROM products";
        $product_array = $country_array = $param_array = array();
        
        $params="";
        if(is_array($country))
        {
            $query.=" WHERE firmID IN(SELECT firmID FROM firms WHERE country IN(";
            
            foreach($country as $key=>$val)
            {
                $query.="?";
                $params.="s";
                $country_array [] = &$val;
                if($key == (count($country)-1))
                {
                    $query.=",";
                }
            }
            $query.="))";
                        
        }
        else if(is_string($country))
        {
            $query.=" WHERE firmID IN(SELECT firmID FROM firms WHERE country = ?)";
            $country_array[] = &$country;
            $params.="s";
        }
        
        
        $query.=" ORDER BY ".$col." ".$order;
        
        $stmt = $this->mysqli->prepare($query);
        if(!empty($params) && is_array($country))
        {
            $param_array[]=&$params;
            foreach($country_array as $cont)
            {
                $param_array[] = &$cont;
            }
            call_user_func_array(array($stmt,'bind_param'), $param_array);            
        }
        if(!empty($params) && !is_array($country))
        {
            $param_array[]=&$params;
            $param_array[] = &$country;
            
            call_user_func_array(array($stmt,'bind_param'), $param_array);            
        }
        
        $stmt->execute();
        
        $res = $stmt->get_result();
        while($data = $res->fetch_assoc())
        {
            $product_array[] = new Product($this->mysqli, $data['id']);            
        }
        
        $res->close();
        $stmt->close();
        
        return $product_array;
        
    }
    
    public function getAllFirms()
    {
        $firm_array = array();
        
        $stmt1 = $this->mysqli->prepare("SELECT * FROM firms ORDER BY avg_rating DESC");
        $stmt1->execute();
        $res1 = $stmt1->get_result();
        
        while($data1 = $res1->fetch_assoc())
        {
            $firm_array[] = new Firms($this->mysqli, $data1['firmID']);
        }
        
        $res1->close();
        $stmt1->close();
        
        return $firm_array;
        
    }
       
    private function getParty()
    {
        if($_SESSION['logtype'] == 'frm')
        {
            $firm = new Firms($this->mysqli, $_SESSION['uid']);
            $this->party = $firm;
            $this->party_country = $firm->country;
        }
        
        elseif($_SESSION['logtype'] == 'usr')
        {
            $usr = new User($this->mysqli, $_SESSION['uid']);
            $this->party_country = $usr->country;
        }
        
    }
        
    public function addProduct($name,$price,$firm,$img,$desc)
    {
        $this->cleanData(array($name,$price,$firm,$desc));
        
        $imgPath = $this->uploadImg($img);
        
        if($imgPath == "-31" || $imgPath == "-32" || $imgPath == "-32")
        {
            return $imgPath;
        }
        
        $stmt = $this->mysqli->prepare("INSERT INTO products(name,price,firmID,img,description) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sdsss",$name,$price,$firm,$imgPath,$desc);
        $stmt->execute();
        
        $stmt->close();
        
        return "0";
        
    }
    
    public function deleteProduct($prodId)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i",$prodId);
        $stmt->execute();
        
        $stmt2 = $this->mysqli->prepare("DELETE FROM product_views WHERE product_id = ?");
        $stmt2->bind_param("i",$prodId);
        $stmt2->execute();
        
        $stmt3 = $this->mysqli->prepare("DELETE FROM product_rating WHERE product_id = ?");
        $stmt3->bind_param("i",$prodId);
        $stmt3->execute();
        
        $stmt->close();
        $stmt2->close();
        $stmt3->close();
    }
    
    public function filterProducts($key)
    {
        $product_array = array();
        
        $stmt = $res = $stmt2 = $res2 = NULL;
        
        $this->cleanData(array($key));
        
        $key = "%".$key."%";
        
        $stmt = $this->mysqli->prepare("SELECT * FROM products WHERE name LIKE ?");
        $stmt->bind_param("s",$key);
        $stmt->execute();
        
        $res = $stmt->get_result();
        while($data = $res->fetch_assoc())
        {         
            $product_array[] = new Product($this->mysqli, $data['id']);                                                           
        }
        
        $stmt->close();
        $res->close();
        
        
        return $product_array;
        
    }
    
        
}

