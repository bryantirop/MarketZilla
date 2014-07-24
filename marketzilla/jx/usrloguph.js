$(document).ready(function()
{
    
    var logupbtn = $("[name='usrLog']");
    var trg = $(".logup-res");
    
    setInterval(function()
    {
        var names = $("#usrNames").val();
        var username = $("#usrUsername").val();
        var email = $("#usrEmail").val();
        var country = $("#usrCountry").val();
        var dob = $("#usrAge").val();
        
        
        var pass1 = $("#usrPassword").val();
        var pass2 = $("#usrPassword2").val();
        
        
        var inputArray = new Array();
        
        inputArray[0] = names;
        inputArray[1] = username;
        inputArray[2] = email;
        inputArray[3] = country;
        inputArray[4] = dob;
        inputArray[5] = pass1;
        inputArray[6] = pass2;
        passArray = [pass1,pass2];
        
                      
        if(Core_isEmpty(inputArray))
        {
            logupbtn.addClass("disabled");
        }
        
               
        else if(!document.forms[0].agreecheck.checked)
        {
            logupbtn.addClass("disabled");
        }
        else
        {
            logupbtn.removeClass("disabled");
        }
    },500);
    
     
     $("#usrPassword,#usrPassword2").keyup(function()
     {
         var pass1 = $("#usrPassword").val();
         var pass2 = $("#usrPassword2").val();
         
         if(pass1 === pass2)
         {
             trg.addClass("text-success").removeClass("text-danger").html("Matching passwords");
         }
         else
         {
             trg.addClass("text-danger").removeClass("text-success").html("Unmatching passwords");             
         }
     });
    
    
    $(logupbtn.on("click",function()
    {
        if($(this).hasClass("disabled"))
        {
            return false;
        }
        
        var names = $("#usrNames").val();
        var username = $("#usrUsername").val();
        var email = $("#usrEmail").val();
        var country = $("#usrCountry").val();
        var dob = $("#usrAge").val();
        var trg = $(".logup-res");
        var pass1 = $("#usrPassword").val();
        var pass2 = $("#usrPassword2").val();
   
         trg.removeClass("text-error");
         trg.addClass("text-info").html("Processing <img src='../img/jx/loading5.gif'>");
         
         
    
    $.ajax({url:"http://localhost/marketzilla/jx/usrlogup.php",type:"POST",data:{names:names, usrname:username, email:email, pass1:pass1, pass2:pass2, country:country, dob:dob},async:true, cache:false, success:function(res)
            {
                switch(res)
                {
                    case "-2":
                        trg.removeClass("text-info").addClass("text-error").html("Invalid email! Use a correct email format");
                        break;
                    case "-3":
                        trg.removeClass("text-info").addClass("text-error").html("Sorry that username is already taken!");
                        break;
                    case "-4":
                        trg.removeClass("text-info").addClass("text-error").html("Sorry that email already exists. Choose another!");
                        break;
                    case "-5":
                        trg.removeClass("text-info").addClass("text-error").html("Unmatching passwords");
                        break;
                    case "-6":
                        trg.removeClass("text-info").addClass("text-error").html("Sorry Only 16 and above allowed");
                        break;
                    case "-7":
                        trg.removeClass("text-info").addClass("text-error").html("Please type a valid date! Use format mm/dd/yyyy");
                        break;
                    case "0":
                        trg.removeClass("text-error").addClass("text-success").html("Successful! Redirecting ...");
                        location.assign("../panel/");
                        break;
                    default:
                        trg.removeClass("text-info").addClass("text-error").html("Unknown error occured");
                        alert(res);
                    
                }                
            },
            error:function()
            {
                alert("fatal error occured");
            }
        });
    
        
    }));
    
   
    
});