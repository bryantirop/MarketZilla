<?php

require_once dirname(__FILE__)."/Control.php";
require_once dirname(__FILE__)."/Firms.php";

class Product extends Control
{
    public $prod;
    public $name,$firm,$desc,$price,$rating,$logo;
    
    public function __construct($mysqli,$prod)
    {
        parent::__construct($mysqli);
        $this->prod = $prod;
        
        $this->rescan();
    
    }
    
        
    public function rescan()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM products WHERE id=?");
        $stmt->bind_param("i",  $this->prod);
        $stmt->execute();
        
        $res = $stmt->get_result();
        $data = $res->fetch_assoc();
        
        $this->name = $data['name'];
        $this->firm = $data['firmID'];
        $this->price = $data['price'];
        $this->rating = $data['rating'];
        $this->logo = $data['img'];
        $this->desc = $data['description'];
        
    }
    
    public function getViews()
    {
        $view_array = array();
        $stmt = $this->mysqli->prepare("SELECT * FROM product_views WHERE product_id = ?");
        $stmt->bind_param("i",  $this->prod);
        $stmt->execute();
        
        $res = $stmt->get_result();
        while($data = $res->fetch_assoc())
        {
            $view_array [] = $data;
        }
        
        
        $res->close();
        $stmt->close();
        
        return $view_array;
        
    }
    
    
    public function setView($desc)
    {
        $this->cleanData(array($desc));
        
        $stmt = $this->mysqli->prepare("INSERT INTO product_views (product_view,product_id,product_viewer) VALUES(?,?,?)");
        $stmt->bind_param("sii", $desc,  $this->prod,  $_SESSION['uid']);
        $stmt->execute();
        
        $stmt->close();        
        
    }
    
    public function getUsrRating($uid)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM product_rating WHERE product_id = ? AND rater = ?");
        $stmt->bind_param("ii",  $this->prod,$uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $data = $res->fetch_assoc();
        
        return $data['rating'];
        
    }
    
    public function setRating($rate)
    {
                
        $stmt7 = $this->mysqli->prepare("SELECT * FROM product_rating WHERE product_id=? AND rater=?");
        $stmt7->bind_param("ii",  $this->prod, $_SESSION['uid']);
        $stmt7->execute();
        
        $res3 = $stmt7->get_result();
        if($res3->num_rows > 0)
        {
            $stmt2 = $this->mysqli->prepare("UPDATE product_rating SET rating = ?, rater = ? WHERE id = ?");
            $stmt2->bind_param("dii",$rate, $_SESSION['uid'],  $this->prod);
        }
        else
        {
            $stmt2 = $this->mysqli->prepare("INSERT INTO product_rating (rating,product_id,rater) VALUES (?,?,?)");
            $stmt2->bind_param("dii",$rate,  $this->prod ,$_SESSION['uid']);               
        }
        
        
        
        $stmt2->execute();
        $stmt2->close();
        
        $stmt7->close();
        $res3->close();
        
        $stmt5 = $this->mysqli->prepare("SELECT * FROM product_rating WHERE product_id = ?");
        $stmt5->bind_param("i", $this->prod);
        $stmt5->execute();
        
        $res2 = $stmt5->get_result();
        $ttl_p = 0.0;
        $ttl_num = $res2->num_rows;
        
        while($data2 = $res2->fetch_assoc())
        {
            $ttl_p += $data2['rating'];
        }
        
        $avg_pr = ($ttl_p / $ttl_num);
        
        $res2->close();
        $stmt5->close();
        
        $stmt6 = $this->mysqli->prepare("UPDATE products SET rating = ? WHERE id = ?");
        $stmt6->bind_param("di",$avg_pr,  $this->prod);
        $stmt6->execute();
        
        $stmt6->close();     
      
        
        
        $stmt3 = $this->mysqli->prepare("SELECT * FROM products WHERE firmID=?");
        $stmt3->bind_param("s",  $this->firm);
        $stmt3->execute();
        
        $res1 = $stmt3->get_result();
       
        $total_rate = 0.0;
        while($data = $res1->fetch_assoc())
        {
            $total_rate += $data['rating'];            
        }
        
        $ttl_raters = ($res1->num_rows+1);
        
        $avg_rating = ($total_rate / $ttl_raters);
        
        $stmt4 = $this->mysqli->prepare("UPDATE firms SET avg_rating = ? WHERE firmID = ?");
        $stmt4->bind_param("ds",$avg_rating,  $this->firm);
        $stmt4->execute();
        
        $stmt3->close();
        $stmt4->close();
        
        $res1->close();                       
        
        
        
        $this->rescan();
        
    }
    
    
     
    
}

