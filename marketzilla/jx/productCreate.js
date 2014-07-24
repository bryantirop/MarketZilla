$(document).ready(function()
{
    
   var pname;
   var pprice;
   var pdesc;
   var pimg;
   
   var crbtn = $("#createProductBtn");
   var respan = $("[name='createProductResult']");
   
   
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
            case "0":
                respan.removeClass("text-danger").removeClass("text-info").addClass("text-success").html("Successful! You can close the dialog now");
                window.location.reload();
                break;
            case "-31":
                respan.removeClass("text-success").removeClass("text-info").addClass("text-danger").html("Fatal error occured during image upload. Try again");
                break;
            case "-32":
                respan.removeClass("text-success").removeClass("text-info").addClass("text-danger").html("Image must be minimum 80KB and maximum 2MB");
                break;
            case "-33":
                respan.removeClass("text-success").removeClass("text-info").addClass("text-danger").html("Image must type .jpg,.jpeg,.png,.gif, or .bmp");
                break;
            default:
                alert(response.responseText);
            
        }
        
    },
    error: function()
    {
       
 
    }
 
};

        $("#CreateProductForm").ajaxForm(options);
   
   setInterval(function(){
       
       pname = $("#productName").val();
       pprice = $("#productPrice").val();
       pdesc = $("#productDesc").val();
       pimg = $("#productImg").val();
       
       
       params_array = [pname,pprice,pdesc,pimg];
       
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
       
       $("[name='submitCreateProduct']").trigger("click");
       
       
   });
   
   $("[vname='view_products']").on("click", function()
    {
       var trg = $(this).attr("trg");
       $("[vname='product_views_tr'][trg='"+trg+"']").slideToggle();
       
    });
    
       
    $("[vname='view_products_o']").on("click", function()
    {
       var trg = $(this).attr("trg");
       $("[vname='product_views_tr_o'][trg='"+trg+"']").slideToggle();
       
    });
    
    
});