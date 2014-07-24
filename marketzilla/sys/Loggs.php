<?php

require_once dirname(__FILE__).'/Control.php';


class Loggs extends Control
{
    
    public function __construct($mysqli)
    {
        parent::__construct($mysqli);
    }
    public function LogUser($username,$password,$rem = null)
    {
        $rows = 0;
        $this->cleanData(array($username,$password));
        $password = $this->hashData($password);
        
               
        $res = $this->mysqli->query("SELECT * FROM comm WHERE username = '".$username."' AND password = '".$password."'") or die($this->mysqli->error);
        $rows = $res->num_rows;
        if($rows == 0)
        {
            $res = $this->mysqli->query("SELECT * FROM comm WHERE email = '".$username."' AND password = '".$password."'") or die($this->mysqli->error);
            $rows = $res->num_rows;
            
        }
        if($rows > 0)
        {
            $data = $res->fetch_assoc();
            $uid = $data['id'];
            
            $res->close();
            
            
            
            $_SESSION['logtype'] = 'usr';
            $_SESSION['uid'] = $uid;
            
            if($rem != NULL)
            {
                setcookie("marketapp_usr_cookie", $uid, time()+(3600*24*30));
            }
            
            return "0";                        
            
        } 
        else
        {
            $res->close();
            
            return "-1";
           
        }
        
    }
    
    public function LogFirm($firmID,$passcode)
    {
        $rows = 0;
        $this->cleanData(array($firmID,$passcode));
        $passcode = $this->hashData($passcode);
        
        
        $res = $this->mysqli->query("SELECT * FROM firms WHERE firmID = '".$firmID."' AND passcode = '".$passcode."'") or die($this->mysqli->error);
        $rows = $res->num_rows;
        
        if($rows > 0)
        {
            
            $res->close();            
            
            $_SESSION['logtype'] = 'firm';
            $_SESSION['uid'] = $firmID;
            
            return "0";
            
        } 
        else
        {
            $res->close();
            
            return "-1";
            
        }
        
    }
    
    public function usrExists($username)
    {
        
        $this->cleanData(array($username));
        
        $stmt = $this->mysqli->prepare("SELECT * FROM comm WHERE username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
       
        $res = $stmt->get_result();
        if($res->num_rows > 0)
        {
            $res->close();
            $stmt->close();
            
            return true;
        }
        
        $res->close();
        $stmt->close();
        
        
        return false;
        
    }
    
    public function firmExists($firmID)
    {
        
        $this->cleanData(array($firmID));
        
        $stmt = $this->mysqli->prepare("SELECT * FROM firms WHERE firmID = ?");
        $stmt->bind_param("s",$firmID);
        $stmt->execute();
       
        $res = $stmt->get_result();
        if($res->num_rows > 0)
        {
            $res->close();
            $stmt->close();
            
            return true;
        }
        
        $res->close();
        $stmt->close();
        
        
        return false;
        
    }
    
        
    public function emailExists($email)
    {
        $this->cleanData(array($email));
        
        $stmt = $this->mysqli->prepare("SELECT * FROM comm WHERE email = ?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
       
        $res = $stmt->get_result();
        if($res->num_rows > 0)
        {
            $res->close();
            $stmt->close();
            
            return true;
        }
        
        $res->close();
        $stmt->close();
        
        
        return false;
    }
    
    public function SignUpUsr($names, $username, $email, $password1, $password2, $country, $dob)
    {
        $this->cleanData(array($names,$username,$email,$password1,$password2,$country,$dob));
        
        if(!filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL))
        {
            return "-2";
            
        }
        
        if($this->usrExists($username))
        {
            return "-3";
            
        }
            
        if($this->emailExists($email))
        {
            return "-4";
           
        }           
        
        if($password1 != $password2)
        {
            return "-5";
            
        }
            
        $img = dirname(__FILE__)."/../img/comm/default_original_profile_pic.png";
        
        $password1 = $this->hashData($password1);
        
        $stmt = $this->mysqli->prepare("INSERT INTO comm (names,username,email,password,country,dob,photo) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss",$names,$username,$email,$password1,$country,$dob,$img);
        $stmt->execute();
        
        $stmt->close();
        
        $last_id = $this->mysqli->insert_id;
        
        $_SESSION['uid'] = $last_id;
        $_SESSION['logtype'] = 'usr';
        
        return "0";
        
    }
    
    public function regFirm($name,$firmID,$passcode1,$passcode2,$country,$location,$motto,$logo)
    {
        $this->cleanData(array($name,$firmID,$passcode1,$passcode2,$country,$location,$motto));
        
        if($this->firmExists($firmID))
        {
            echo "-1";
            exit;
        }
            
        
        if($passcode1 != $passcode2)
        {
            echo "-2";
            exit;
        }
            
        
        $passcode1 = $this->hashData($passcode1);
        
        $logopath = $this->uploadImg($logo);
        if($logopath == "-31" || $logopath == "-32" || $logopath == "-33")
        {
            echo $logopath;
            exit;
        }
        
        $stmt = $this->mysqli->prepare("INSERT INTO firms (name,firmID,passcode,country,home,motto,logo) VALUES (?,?,?,?,?,?,?)");
        
        $stmt->bind_param("sssssss",$name,$firmID,$passcode1,$country,$location,$motto,$logopath);
        $stmt->execute();
        $stmt->close();
        
               
        echo "0";
        exit;
        
    }
    
    public function usrUpdatePhoto($fileobj,$uid)
    {
        $objpath = $this->uploadImg($fileobj);
        $stmt = $this->query->prepare("UPDATE comm SET photo=? WHERE id=?");
        $stmt->bind_param("si",$objpath,$uid);
        $stmt->execute();
        
        return "0";        
    }
    
        
}
