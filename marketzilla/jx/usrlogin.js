$(document).ready(function()
{
    var usrname = $("#usrEmail");
    var usrpwd = $("#usrPassword");
    var firmid = $("#firmID");
    var firmpwd = $("#firmPassCode");
    var usrbtn = $("[name='usrLog']");
    var firmbtn = $("#firmLog");
    var usres = $("[name='usrLogResult']");
    var firmres = $("[name='firmLogResult']");
   
    setInterval(function(){
        unameval = usrname.val();
        upwdval = usrpwd.val();
        fidval = firmid.val();
        fpwdval = firmpwd.val();
        
        var uinp = [unameval,upwdval];
        var finp = [fidval,fpwdval];
        
        if(Core_isEmpty(uinp))
        {
            usrbtn.addClass("disabled");
        }
        else
        {
            usrbtn.removeClass("disabled");
        }
        
        if(Core_isEmpty(finp))
        {
            firmbtn.addClass("disabled");
        }
        else
        {
            firmbtn.removeClass("disabled");
        }
                
    },100);
    
    usrbtn.on("click", function()
    {
        if($(this).hasClass("disabled"))
        {
            return false;            
        }
        unameval = usrname.val();
        upwdval = usrpwd.val();
        
        var usrem = document.forms[0].usrRem.checked ? "on":"off";
        
         
        
        $.ajax({
           url:"jx/usrloginlive.php",
           type:"POST",
           data:{logtype:"usr",usrname:unameval,usrpwd:upwdval,usrem:usrem},
           async:true,
           cache:false,
           success:function(result)
           {
               switch(result)
               {
                   case "-1":
                       usres.addClass("text-danger").html("Wrong username/email or password");
                       break;
                   case "0":
                       usres.addClass("text-success").removeClass("text-danger").html("Successful! Redirecting...");
                       setTimeout(function(){
                          window.location="panel/"; 
                       },2000);
                       break;
                   default:
                       alert(result);                 
                   
               }            
               
           },
           error:function()
           {
               alert("No Internet Connection");
           }
            
        });
        
        
        
        
    });
    
    
    firmbtn.on("click", function()
    {
        
        if($(this).hasClass("disabled"))
        {
            return false;            
        }
        fidval = firmid.val();
        fpwdval = firmpwd.val();
        
                        
        $.ajax({
           url:"jx/usrloginlive.php",
           type:"POST",
           data:{logtype:"firm",firmID:unameval,firmPass:fpwdval},
           async:true,
           cache:false,
           success:function(result)
           {
               switch(result)
               {
                   case "-1":
                       firmres.addClass("text-danger").removeClass("text-success").html("Wrong ID or Pass Key");
                       break;
                   case "0":
                       firmres.addClass("text-success").removeClass("text-danger").html("Successful! Redirecting...");
                       setTimeout(function(){
                         location="panel/"; 
                       },2000);
                       break;
                   default:
                       alert(result);                 
                   
               }            
               
           },
           error:function()
           {
               alert("No Internet Connection");
           }
            
        });
        
        
        
    });
    
    
    
    
    
    
    
    
    
    
    
});