<?php

require_once dirname(__FILE__)."/Control.php";
require_once dirname(__FILE__)."/Product.php";

class Firms extends Control
{
    private $firm_id;
    public $name,$firmID,$country,$home,$products = array(),$avg_rating,$logo,$motto;
    
    public function __construct($mysqli,$fid) 
    {
        parent::__construct($mysqli);
        
        $this->firm_id = $fid;
        
        $this->rescan();
    }
    
    public function rescan()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM firms WHERE firmID=?");
        $stmt->bind_param("s",  $this->firm_id);
        $stmt->execute();
        
        $res = $stmt->get_result();
        $data = $res->fetch_assoc();
        
        $this->name = $data['name'];
        $this->country = $data['country'];
        $this->firmID = $data['firmID'];
        $this->home = $data['home'];
        $this->logo = $data['logo'];
        $this->motto = $data['motto'];
        $this->avg_rating = $data['avg_rating'];
        
        $stmt = $this->mysqli->prepare("SELECT * FROM products WHERE firmID = ? ORDER BY rating DESC");
        $stmt->bind_param("s",  $this->firm_id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        while($data = $res->fetch_assoc())
        {
            $this->products[] = new Product($this->mysqli, $data['id']);
            
        }
        
        $res->close();
        $stmt->close();
        
                
        return $this;    
    }
    
    
    public function setLocation($country,$home)
    {
        $this->cleanData(array($country,$home));
        
        $stmt = $this->mysqli->prepare("UPDATE firms SET country=?, home=? WHERE firmID=?");
        $stmt->bind_param("sss",$country,$home,$this->firmID);
        $stmt->execute();
        
        $this->rescan();
        
        return $this;                
    }
    
    public function setMotto($motto)
    {
        $this->cleanData(array($motto));
        
        $stmt = $this->mysqli->prepare("UPDATE firms SET motto=? WHERE firmID=?");
        $stmt->bind_param("ss",$motto,$this->firmID);
        $stmt->execute();
        
        $this->rescan();
        
        return $this;     
        
    }
    
    public function setName($name)
    {
        $this->cleanData(array($name));
        
        $stmt = $this->mysqli->prepare("UPDATE firms SET name=? WHERE firmID=?");
        $stmt->bind_param("ss",$name,$this->firmID);
        $stmt->execute();
        
        $this->rescan();
        
        return $this;
    }
    
    public function setLogo($logo)
    {
        $retUpl = $this->uploadImg($logo);
        
        if($retUpl == "-1" || $retUpl == "-2" || $retUpl == "-3")
        {
            return $retUpl;
        }
        
        $stmt = $this->mysqli->prepare("UPDATE firms SET logo=? WHERE firmID=?");
        $stmt->bind_param("ss",$logo,$this->firmID);
        $stmt->execute();
        
        $this->rescan();
        
        return $this;
        
    }
    
        
}

