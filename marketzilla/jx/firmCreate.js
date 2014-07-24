$(document).ready(function()
{
    
   var fname;
   var fid;
   var fpass;
   var fcountry;
   var fhome;
   var fmotto;
   var flogo;
   var crbtn = $("#createFirmBtn");
   var respan = $("[name='createFirmResult']");
   
   
   var options = {
            
    uploadProgress: function(event, position, total, percentComplete)
    {
        respan.removeClass("text-danger").removeClass("text-success").addClass("text-info").html("Processing &nbsp;<img src='../img/jx/loading5.gif'>");
    },
    success: function()
    {
        respan.removeClass("text-danger").removeClass("text-success").addClass("text-info").html("Done! Reviewing results &nbsp;<img src='../img/jx/loading5.gif'>"); 
    },
    complete: function(response)
    {
        switch(response.responseText)
        {
            case "-1":
                respan.removeClass("text-success").removeClass("text-info").addClass("text-danger").html("That ID has already been taken. Choose another");
                break;
            case "-31":
                respan.removeClass("text-success").removeClass("text-info").addClass("text-danger").html("Fatal error occured during logo upload. Try again");
                break;
            case "-32":
                respan.removeClass("text-success").removeClass("text-info").addClass("text-danger").html("Logo must be minimum 80KB and maximum 2MB");
                break;
            case "-33":
                respan.removeClass("text-success").removeClass("text-info").addClass("text-danger").html("Logo must type .jpg,.jpeg,.png,.gif, or .bmp");
                break;
            case "0":
                respan.removeClass("text-danger").removeClass("text-info").addClass("text-success").html("Successful! Login to your firm now!"); 
                window.location.reload();
                break;
            default:
                alert(response.responseText);
            
            
        }
    },
    error: function()
    {
       
 
    }
 
};

        $("#CreateFirmForm").ajaxForm(options);
   
   setInterval(function(){
       
       fname = $("#firmName").val();
       fid = $("#firmID").val();
       fpass = $("#firmPass").val();
       fcountry = $("#firmCountry").val();
       fhome = $("#firmHome").val();
       fmotto = $("#firmMotto").val();
       
       
       params_array = [fname,fid,fpass,fcountry,fhome,fmotto,flogo];
       
       if(Core_isEmpty(params_array))
       {
           crbtn.addClass("disabled");
       }
       else
       {
           crbtn.removeClass("disabled");
       }
       
       
   },500);
   
   crbtn.on("click", function()
   {
       if($(this).hasClass("disabled"))
           return false;
       
       $("[name='submitCreateFirm']").trigger("click");
       
       
   });
    
    
});