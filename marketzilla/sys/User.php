<?php

require_once dirname(__FILE__)."/Control.php";

class User extends Control
{
    public $names,$username,$country,$photo;
    private $uid;
    
    public function __construct($mysqli,$uid)
    {
        parent::__construct($mysqli);
        $this->uid = $uid;
        
        $this->rescan();
    }
    
    public function rescan()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM comm WHERE id = ?");
        $stmt->bind_param("i",  $this->uid);
        $stmt->execute();
        
        $res = $stmt->get_result();
        $data = $res->fetch_assoc();
        
        $this->names = $data['names'];
        $this->username = $data['username'];
        $this->country = $data['country'];
        $this->photo = $data['photo'];
        
        $stmt->close();
        $res->close();
        
        return $this;
    }
    
    public function setNames($names)
    {
        $this->cleanData(array($names));
        $stmt = $this->mysqli->prepare("UPDATE comm SET names=? WHERE id=?");
        $stmt->bind_param("si",$names,  $this->uid);
        $stmt->execute();
        
        $stmt->close();
        
        $this->rescan();
        
        return $this;
    }
    
    public function setCountry($country)
    {
        $this->cleanData(array($country));
        $stmt = $this->mysqli->prepare("UPDATE comm SET names=? WHERE id=?");
        $stmt->bind_param("si",$country,  $this->uid);
        $stmt->execute();
        
        $stmt->close();
        
        $this->rescan();
        
        return $this;
    }
    
    public function setPhoto($img)
    {
        $retUpl = $this->uploadImg($img);
        
        if($retUpl == "-1" || $retUpl == "-2" || $retUpl == "-3")
        {
            return $retUpl;
        }
        
        $stmt = $this->mysqli->prepare("UPDATE comm SET photo=? WHERE id=?");
        $stmt->bind_param("si",$retUpl,$this->uid);
        $stmt->execute();
        
        $this->rescan();
        
        return $this;
        
    }
    
}

