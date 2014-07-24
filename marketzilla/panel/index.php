<?php
require_once '../sys/conn.php';
require_once '../sys/Firms.php';
require_once '../sys/User.php';
require_once '../sys/Data.php';


$namebar="";
if($_SESSION['logtype'] == "usr")
{
    $me = new User($mysqli, $_SESSION['uid']);
    $namebar = $me->names;
}
else 
{
    $frm = new Firms($mysqli, $_SESSION['uid']);
    $namebar = $frm->name;
}



$dataGen = new Data($mysqli);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Market App Panel</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
        <style type="text/css">
            
            [vname='product_views_tr'],[vname='product_views_tr_o']{
                display: none;
            }
            
        </style>
    </head>
    <body>
        
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="javascript:void">Market App</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li class="active"><a href="javascript:void"><?php echo $namebar; ?> &nbsp;<i class="glyphicon glyphicon-home"></i></a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
         <li class="dropdown">
            <a href="javascript:void" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i></a>
          <ul class="dropdown-menu">
              <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Sign Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
        <br><br>
        
        <table>
            <tr>
                <td style="width: 50px;"></td>
                <td style="width:1300px;">
                    <table style="width: 1300px; border: 1px solid  #cccccc; height: 610px; overflow: scroll;">
                        <tr>
                            <td style="height: 100px;">
                                <table>
                                    <tr>
                                        <td style="width:280px;">
                                            <div class="navbar-form navbar-left" role="search">
                                                <div class="form-group has-feedback">
                                                    <input type="text" class="form-control" style="width:260px;" placeholder="Search" name='search_bar'>
                                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                                </div>
                                            </div>
                                            
                                        </td>
                                        <td>
                                            
                                            <table style="width: 650px !important;">
                                                <tr>
                                                    <td style="width:40px !important;">
                                                      Country:
                                                    </td>
                                                    <td style="width:270px !important;">
                                                        <select id="usrCountry" class="form-control"  name="usrCountry" sgroup="on"><option value="">All Countries</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua & Barbuda">Antigua & Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option><option value="Botswana">Botswana</option><option value="Brazil">Brazil</option><option value="Brunei">Brunei</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burma">Burma</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Democratic Republic of Congo">Democratic Republic of Congo</option><option value="Congo">Congo</option><option value="Costa Rica">Costa Rica</option><option value="Cote d'Ivoire">Cote d'Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Greece">Greece</option><option value="Grenada">Grenada</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Honduras">Honduras</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea North">Korea North</option><option value="Korea South">Korea South</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestine">Palestine</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Qatar">Qatar</option><option value="Romania">Romania</option><option value="Russia">Russia</option><option value="Rwanda">Rwanda</option><option value="Saint Kitts & Nevis">Saint Kitts & Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Vincent & the Grenadines">Saint Vincent & the Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome & Principe">Sao Tome & Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Sudan">South Sudan</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tonga">Tonga</option><option value="Trinidad & Tobago">Trinidad & Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option><optgroup label="Other States"><option value="Abkhazia">Abkhazia</option><option value="Cook Islands">Cook Islands</option><option value="Kosovo">Kosovo</option><option value="Nagorno-Karabakh">Nagorno-Karabakh</option><option value="Niue">Niue</option><option value="Northern Cyprus">Northern Cyprus</option><option value="SADR">SADR</option><option value="Somaliland">Somaliland</option><option value="South Ossetia">South Ossetia</option><option value="Taiwan">Taiwan</option><option value="Transnistria">Transnistria</option></optgroup></select> 
                                                    </td>
                                                    <td style="width:40px !important;" align="right">
                                                        Sort:
                                                    </td>
                                                    <td style="width:130px !important;">
                                                        <select class="form-control" name="sortBy" sgroup="on"><option value="id">Newest</option><option value="rating">Rating</option><option value="name">Name</option></select>
                                                    </td>
                                                    <td style="width:60px !important;" align="right">
                                                        Order:
                                                    </td>
                                                    <td style="width:130px !important;" align="right">
                                                        <select class="form-control" name="sortHow" sgroup="on"><option value="DESC">Descending</option><option value="ASC">Ascending</option></select>  
                                                    </td>
                                                </tr>
                                            </table>
                                            
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="width:100px;"></td>
                                                    <td style="width: 100px;" align="right">
                                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createFirmModal">Create Firm</button> 
                                                    </td>
                                                </tr>
                                            </table>
                                                                                      
                                        </td>
                                    </tr>
                                </table>
                                
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                
                                <table>
                                    <tr>
                                        <td valign="top">
                                            <table style="border-right: 1px solid #cccccc; width: 710px; height: 500px;">
                                                <tr>
                                                    <td valign="top">
                                                        <table style="width: 700px; border-bottom: 1px solid #cccccc;"><tr><td align="center"><b>Products</b></td></tr></table>
                                                        <table name="products_table">
                                                      <?php
                                                      
                                                      $products = $dataGen->getAllProducts("rating", "DESC");
                                                     
                                                      
                                                      foreach($products as $product)
                                                      {
                                                          $num_views = count($product->getViews());
                                                    $views = $product->getViews();
                                                    
                                                    $product_firm = new Firms($mysqli,$product->firm);
                                                    
                                                   
                                                    echo "<tr><td valign='top'><table style='border-bottom: 1px solid #cccccc; width: 700px;'><tr><td width='180px'><img src='../img/comm/".$product->logo."' height='100px;' style='border: 1px solid #cccccc;'></td><td valign='top' width='680px'>";
                                                         echo "<b>".$product->name."</b> of <em>".$product_firm->name."</em><br>Rating: <strong>".$product->rating."</strong><br><a href='javascript:' trg='".$product->prod."' vname='view_products'>views (".$num_views.")</a></td>";
                                                         echo "</tr></table></td></tr>";
                                                    echo "<tr vname='product_views_tr' trg='".$product->prod."'><td valign='top'><table><tr><td><b>Views</b></td></tr></table>";
                                                        
                                                         echo "<table>";
                                                         
                                                         if(count($views) == 0)
                                                         {
                                                             echo "<tr><td>No views yet for this product</td></tr>"; 
                                                         }
                                                         
                                                         foreach($views as $view)
                                                         {
                                                             $viewer = new User($mysqli, $view['product_viewer']);
                                                             
                                                            echo "<tr><td><table><tr><td><img src='../img/comm/default_original_profile_pic.png' width='60px;'></td><td valign='top'>".$viewer->names." rates this ".$product->getUsrRating($view['product_viewer'])."<br>";
                                                                           echo wordwrap($view['product_view'],50,true)."</td></tr></table><tr>";  
                                                                                                                                                                                      
                                                         }
                                                         
                                                         
                                                         
                                                         
                                                         if($_SESSION['logtype'] == "usr")
                                                         {
                                                             echo "<tr><td><table style='border-top:1px solid #cccccc; width: 300px; height: 40px; '><tr><td width='200px'>Rate this product</td><td width='100px'><select name='product_rating' trg='".$product->prod."'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option></select></td></tr></table></td></tr>";
                                                             echo "<tr><td><table style='border-top:1px solid #cccccc; width: 300px; height: 40px; '><tr><td width='240px'><textarea pname='product_view_post' trg='".$product->prod."' placeholder='Give your view on this product' style='width:220px; resize:none;'></textarea></td><td width='60px' valign='top'><button class='btn btn-primary btn-sm' name='product_view_post' trg='".$product->prod."'>Post</button></td></tr></table></td></tr>";                                                             
                                                             
                                                         }
                                                         
                                                         echo "</table></td></tr>";
                                                          
                                                                                                                   
                                                      }
                                                      
                                                      
                                                                                                                                                               
                                                      ?>
                                                        </table>
                                                    </td>
                                                </tr>
                                                
                                            </table>                                         
                                            
                                        </td>
                                        <td valign="top">
                                            
                                            <table style="width: 350px;">
                                                <tr>
                                                    <td valign="top">
                                                        <table style="width: 340px; height: 60x; border-bottom: 1px solid #cccccc;"><tr><td align="center"><b>Firms</b></td></tr></table>
                                                        <?php
                                                            
                                                        $allfirms = $dataGen->getAllFirms();
                                                        
                                                        echo "<table>";
                                                        
                                                        foreach($allfirms as $firm)
                                                        {
                                                            $firm->rescan();
                                                                                                                     
                                                            echo "<tr><td valign='top'>";
                                                                echo "<table style='border-bottom: 1px solid #cccccc;' height='80px'><tr><td valign='top' width='130px'><img src='../img/comm/".$firm->logo."' width='120px'></td>";
                                                                            echo "<td valign='top' width='200px'>".$firm->name." @".$firm->firmID."<br>".$firm->home." ".$firm->country."<br>".wordwrap($firm->motto,25,true)."</td>";
                                                                            echo "<td valign='top'><strong>".$firm->avg_rating."</strong></td>";
                                                                echo "</tr></table>";
                                                                
                                                            echo "</td></tr>";                                                         
                                                            
                                                            
                                                            
                                                        }               
                                                        
                                                        echo "</table>";
                                                        ?>
                                                        
                                                    </td>
                                                </tr>
                                            </table>                                           
           
                                        </td>
                                        <?php
                                        
                                        if($_SESSION['logtype']=='firm')
                                        {
                                            echo "<td valign='top'><table style='border-left: 1px solid #cccccc; border-right:1px solid #cccccc; width: 280px; height:500px;'><tr><td valign='top'>";
                                            $este = new Firms($mysqli,$_SESSION['uid']);
                                            $products = $este->products;
                                            echo "<table align=''><tr><td align='center' width='100'><b>Our Products</b></td><td align='right' width='150'><a href='javascript:' data-toggle='modal' data-target='#createProductModal'>Add new product</a></td></tr></table>";
                                            
                                            echo "<table>";
                                                foreach($products as $product)
                                                {
                                                    $num_views = count($product->getViews());
                                                    $views = $product->getViews();
                                                   
                                                    echo "<tr><td valign='top'><table style='border-bottom: 1px solid #cccccc; width: 300px;'><tr><td width=''><img src='../img/comm/".$product->logo."' height='80px;' style='border: 1px solid #cccccc;'></td><td valign='top' width='200px'>";
                                                         echo "<b>".$product->name."</b><br>Rating: <strong>".$product->rating."</strong><br><a href='javascript:' trg='".$product->prod."' vname='view_products_o'>views (".$num_views.")</a></td>";
                                                         echo "</tr></table></td></tr>";
                                                    echo "<tr vname='product_views_tr_o' trg='".$product->prod."'><td valign='top'><table><tr><td><b>Views</b></td></tr></table>";
                                                        
                                                         echo "<table>";
                                                         
                                                         if(count($views) == 0)
                                                         {
                                                             echo "<tr><td>No views yet for this product</td></tr>"; 
                                                         }
                                                         
                                                         foreach($views as $view)
                                                         {
                                                             $viewer = new User($mysqli, $view['product_viewer']);
                                                             
                                                             echo "<tr><td><img src='../img/comm/default_original_profile_pic.png' width='60px;'></td><td valign='top'>".$viewer->names." rates this ".$product->getUsrRating($view['product_viewer'])."<br>";
                                                                           echo wordwrap($view['product_view'],50,true)."</td></tr>";                                                              
                                                                                                                          
                                                         }
                                                         
                                                         
                                                         echo "</table></td></tr>";
                                                         
                                                                                                                   
                                                                                                                   
                                                      }
                                                         
                                                                                      
                                                    
                                                
                                                                                      
                                            echo "</table>";
                                            echo "</td>";
                                        }                                        
                                        
                                        ?>
                                    </tr> 
                                </table>                                
                                
                            </td>
                        </tr>
         
                    </table>                   
                    
                </td>
                
            </tr>
                     
        </table>
        
        
        
        
        
        <div class="modal fade" id="createFirmModal" tabindex="-1" role="dialog" aria-labelledby="createFirmModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create Firm</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" id="CreateFirmForm" role="form" method="post" enctype="multipart/form-data" action="../jx/firmCreatelive.php">
  <div class="form-group">
    <label for="firmName" class="col-sm-4 control-label">Name of Firm</label>
    <div class="col-sm-7">
        <input type="text" class="form-control" id="firmName" name="firmName" placeholder="Type Name of Firm">
    </div>
  </div>
  <div class="form-group">
    <label for="firmID" class="col-sm-4 control-label">Firm ID</label>
    <div class="col-sm-7">
        <input type="text" class="form-control" id="firmID" name="firmID" placeholder="Type unique ID">
    </div>
  </div>
 <div class="form-group">
    <label for="firmPass" class="col-sm-4 control-label">Firm Password</label>
    <div class="col-sm-7">
        <input type="password" class="form-control" id="firmPass" name="firmPass" placeholder="Type password">
    </div>
  </div>             
 <div class="form-group">
    <label for="firmCountry" class="col-sm-4 control-label">Country</label>
    <div class="col-sm-7">
      <select id="firmCountry" class="form-control"  name="firmCountry"><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua & Barbuda">Antigua & Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option><option value="Botswana">Botswana</option><option value="Brazil">Brazil</option><option value="Brunei">Brunei</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burma">Burma</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Democratic Republic of Congo">Democratic Republic of Congo</option><option value="Congo">Congo</option><option value="Costa Rica">Costa Rica</option><option value="Cote d'Ivoire">Cote d'Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Greece">Greece</option><option value="Grenada">Grenada</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Honduras">Honduras</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea North">Korea North</option><option value="Korea South">Korea South</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestine">Palestine</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Qatar">Qatar</option><option value="Romania">Romania</option><option value="Russia">Russia</option><option value="Rwanda">Rwanda</option><option value="Saint Kitts & Nevis">Saint Kitts & Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Vincent & the Grenadines">Saint Vincent & the Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome & Principe">Sao Tome & Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Sudan">South Sudan</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tonga">Tonga</option><option value="Trinidad & Tobago">Trinidad & Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option><optgroup label="Other States"><option value="Abkhazia">Abkhazia</option><option value="Cook Islands">Cook Islands</option><option value="Kosovo">Kosovo</option><option value="Nagorno-Karabakh">Nagorno-Karabakh</option><option value="Niue">Niue</option><option value="Northern Cyprus">Northern Cyprus</option><option value="SADR">SADR</option><option value="Somaliland">Somaliland</option><option value="South Ossetia">South Ossetia</option><option value="Taiwan">Taiwan</option><option value="Transnistria">Transnistria</option></optgroup></select>
    </div>
  </div>
 <div class="form-group">
    <label for="firmHome" class="col-sm-4 control-label">Location</label>
    <div class="col-sm-7">
        <input type="text" class="form-control" id="firmHome" name="firmHome" placeholder="e.g. Dallas, Texas">
    </div>
  </div>
 <div class="form-group">
    <label for="firmMotto" class="col-sm-4 control-label">Firm Motto</label>
    <div class="col-sm-7">
        <textarea class="form-control" id="firmMotto" name="firmMotto" placeholder="Type the motto of the firm" style="resize: none;" rows="4"></textarea>
    </div>
  </div>
<div class="form-group">
    <label for="firmLogo" class="col-sm-4 control-label">Firm Logo</label>
    <div class="col-sm-7">
        <input type="file" class="form-control" id="firmLogo" name="firmLogo">
    </div>
  </div>  
              <input type="submit" name="submitCreateFirm" style="display: none;">
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="createFirmBtn">Finish</button>
        &nbsp;&nbsp;<span name="createFirmResult"></span>
      </div>
    </div>
  </div>
</div>
        
        
        <div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="createFirmModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Product</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" id="CreateProductForm" role="form" method="post" enctype="multipart/form-data" action="../jx/productCreatelive.php">
  <div class="form-group">
    <label for="productName" class="col-sm-4 control-label">Name</label>
    <div class="col-sm-7">
        <input type="text" class="form-control" id="productName" name="productName" placeholder="Type Name of Product">
    </div>
  </div>
  <div class="form-group">
    <label for="productPrice" class="col-sm-4 control-label">Price </label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Type price of product">
    </div>
  </div>
 <div class="form-group">
    <label for="productDesc" class="col-sm-4 control-label">Description</label>
    <div class="col-sm-7">
        <textarea class="form-control" id="productDesc" name="productDesc" placeholder="Type short details" style="resize: none;" rows="4"></textarea>
    </div>
  </div>
<div class="form-group">
    <label for="productImg" class="col-sm-4 control-label">Image</label>
    <div class="col-sm-7">
        <input type="file" class="form-control" id="productImg" name="productImg">
    </div>
  </div>  
              <input type="submit" name="submitCreateProduct" style="display: none;">
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="createProductBtn">Finish</button>
        &nbsp;&nbsp;<span name="createProductResult"></span>
      </div>
    </div>
  </div>
</div>
         
        
        <script type="text/javascript" src="../jquery/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="../jquery/jquery.easing.1.3.min.js"></script>
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../jquery/jquery.form.js"></script>
        <script type="text/javascript" src="../jx/mkappcore.js"></script>
        <script type="text/javascript" src="../jx/viewsRating.js"></script>
        <script type="text/javascript" src="../jx/firmCreate.js"></script>
        <script type="text/javascript" src="../jx/productCreate.js"></script>
        
    </body>
</html>