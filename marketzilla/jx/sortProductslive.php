<?php

require_once '../sys/conn.php';
require_once '../sys/Data.php';
require_once '../sys/Firms.php';
require_once '../sys/User.php';

$data = new Data($mysqli);

$output="";

if($_POST['types'] == "search")
{
    
    $term = $_POST['term'];
    
    $products = $data->filterProducts($term);
    
     foreach($products as $product)
                                                      {
                                                          $num_views = count($product->getViews());
                                                    $views = $product->getViews();
                                                    
                                                    $product_firm = new Firms($mysqli,$product->firm);
                                                    
                                                   
                                                    $output.="<tr><td valign='top'><table style='border-bottom: 1px solid #cccccc; width: 700px;'><tr><td width='180px'><img src='../img/comm/".$product->logo."' height='100px;' style='border: 1px solid #cccccc;'></td><td valign='top' width='680px'>";
                                                         $output.="<b>".$product->name."</b> of <em>".$product_firm->name."</em><br>Rating: <strong>".$product->rating."</strong><br><a href='javascript:' trg='".$product->prod."' vname='view_products'>views (".$num_views.")</a></td>";
                                                         $output.="</tr></table></td></tr>";
                                                    $output.="<tr vname='product_views_tr' trg='".$product->prod."'><td valign='top'><table><tr><td><b>Views</b></td></tr></table>";
                                                        
                                                         $output.="<table>";
                                                         
                                                         if(count($views) == 0)
                                                         {
                                                             $output.="<tr><td>No views yet for this product</td></tr>"; 
                                                         }
                                                         
                                                         foreach($views as $view)
                                                         {
                                                             $viewer = new User($mysqli, $view['product_viewer']);
                                                             
                                                            $output.="<tr><td><table><tr><td><img src='../img/comm/default_original_profile_pic.png' width='60px;'></td><td valign='top'>".$viewer->names." rates this ".$product->getUsrRating($view['product_viewer'])."<br>";
                                                                           $output.=wordwrap($view['product_view'],50,true)."</td></tr></table><tr>";  
                                                                                                                                                                                      
                                                         }
                                                         
                                                         
                                                         
                                                         
                                                         if($_SESSION['logtype'] == "usr")
                                                         {
                                                             $output.="<tr><td><table style='border-top:1px solid #cccccc; width: 300px; height: 40px; '><tr><td width='200px'>Rate this product</td><td width='100px'><select name='product_rating' trg='".$product->prod."'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option></select></td></tr></table></td></tr>";
                                                             $output.="<tr><td><table style='border-top:1px solid #cccccc; width: 300px; height: 40px; '><tr><td width='240px'><textarea pname='product_view_post' trg='".$product->prod."' placeholder='Give your view on this product' style='width:220px; resize:none;'></textarea></td><td width='60px' valign='top'><button class='btn btn-primary btn-sm' name='product_view_post' trg='".$product->prod."'>Post</button></td></tr></table></td></tr>";                                                             
                                                             
                                                         }
                                                         
                                                         $output.="</table></td></tr>";
                                                          
                                                                                                                   
                                                      }
    
    
}
else
{
    $country = ($_POST['country']=="")?NULL:$_POST['country'];
    $sortby = $_POST['sortby'];
    $orderby = $_POST['orderby'];
    
    $products = $data->getAllProducts($sortby, $orderby, $country);
    
    foreach($products as $product)
                                                      {
                                                          $num_views = count($product->getViews());
                                                    $views = $product->getViews();
                                                    
                                                    $product_firm = new Firms($mysqli,$product->firm);
                                                    
                                                   
                                                    $output.="<tr><td valign='top'><table style='border-bottom: 1px solid #cccccc; width: 700px;'><tr><td width='180px'><img src='../img/comm/".$product->logo."' height='100px;' style='border: 1px solid #cccccc;'></td><td valign='top' width='680px'>";
                                                         $output.="<b>".$product->name."</b> of <em>".$product_firm->name."</em><br>Rating: <strong>".$product->rating."</strong><br><a href='javascript:' trg='".$product->prod."' vname='view_products'>views (".$num_views.")</a></td>";
                                                         $output.="</tr></table></td></tr>";
                                                    $output.="<tr vname='product_views_tr' trg='".$product->prod."'><td valign='top'><table><tr><td><b>Views</b></td></tr></table>";
                                                        
                                                         $output.="<table>";
                                                         
                                                         if(count($views) == 0)
                                                         {
                                                             $output.="<tr><td>No views yet for this product</td></tr>"; 
                                                         }
                                                         
                                                         foreach($views as $view)
                                                         {
                                                             $viewer = new User($mysqli, $view['product_viewer']);
                                                             
                                                            $output.="<tr><td><table><tr><td><img src='../img/comm/default_original_profile_pic.png' width='60px;'></td><td valign='top'>".$viewer->names." rates this ".$product->getUsrRating($view['product_viewer'])."<br>";
                                                                           $output.=wordwrap($view['product_view'],50,true)."</td></tr></table><tr>";  
                                                                                                                                                                                      
                                                         }
                                                         
                                                         
                                                         
                                                         
                                                         if($_SESSION['logtype'] == "usr")
                                                         {
                                                             $output.="<tr><td><table style='border-top:1px solid #cccccc; width: 300px; height: 40px; '><tr><td width='200px'>Rate this product</td><td width='100px'><select name='product_rating' trg='".$product->prod."'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option></select></td></tr></table></td></tr>";
                                                             $output.="<tr><td><table style='border-top:1px solid #cccccc; width: 300px; height: 40px; '><tr><td width='240px'><textarea pname='product_view_post' trg='".$product->prod."' placeholder='Give your view on this product' style='width:220px; resize:none;'></textarea></td><td width='60px' valign='top'><button class='btn btn-primary btn-sm' name='product_view_post' trg='".$product->prod."'>Post</button></td></tr></table></td></tr>";                                                             
                                                             
                                                         }
                                                         
                                                         $output.="</table></td></tr>";
                                                          
                                                                                                                   
                                                      }
                                                      
    
    
}


echo $output;

