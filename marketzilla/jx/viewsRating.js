$(document).ready(function()
{
   
   var post_view_btns = $("[name='product_view_post']");
   var post_view = $("[name='product_view']");
   var prod_rate = $("[name='product_rating']");
   
  
   setInterval(function()
   {
       post_view.each(function (elem)
       {
           trg = elem.attr("trg");
           inp = [elem];
           if(Core_isEmpty(inp))
           {
               trg = $("[name='product_view_post'][trg='"+trg+"']").addClass("disabled");
           }
           else
           {
               $("[name='product_view_post'][trg='"+trg+"']").removeClass("disabled");
           }
       });
          
   },400);
    
    
    
     
    post_view_btns.on("click", function()
    {
        if($(this).hasClass("disabled"))
        {
            return false;
        }
        
       var trg = $(this).attr("trg");
       var the_view = $("[pname='product_view_post'][trg='"+trg+"']").val();
       
        
        $.ajax({url:"../jx/viewsRatinglive.php", type:"POST", data:{the_view:the_view,trg_p:trg}, success:function(result)
            {
                window.location.reload();
            },
            error:function()
            {
                alert("No internet connection");
            }
        
        });
        
    });
    
    
    prod_rate.on("change", function()
    {
       var trg = $(this).attr("trg");
       var rating = $(this).val();
       
       
       $.ajax({url:"../jx/viewsRatinglive.php", type:"POST", data:{rating:rating,trg_p:trg},
           success:function(result)
           {
               window.location.reload();                
           },
            error:function()
            {
                alert("No internet connection");
            }
        
        });
        
    });
    
    $("select[sgroup='on']").on("change", function()
    {
       
       var country = $("[name='usrCountry']").val();
       var sortby = $("[name='sortBy']").val();
       var orderby = $("[name='sortHow']").val();
       
       $.ajax({
           url:"../jx/sortProductslive.php",
           type:"POST",
           data:{types:"sort",country:country,sortby:sortby,orderby:orderby},
           async:true,
           cache:false,
           success:function(result)
           {
               $("[name='products_table']").html(result);
           },
           error:function()
           {
                alert("No internet connection");
           }           
           
       });
       
        
    });
    
    $("[name='search_bar']").on("keyup", function(e)
    {
       var term;
       term = $(this).val();
       
              
       input = [term];
       
       if(Core_isEmpty(input))
       {
           return false;
       }
       
       $.ajax({
           url:"../jx/sortProductslive.php",
           type:"POST",
           data:{types:"search",term:term},
           async:true,
           cache:false,
           success:function(result)
           {
               $("[name='products_table']").html(result);
           },
           error:function()
           {
                alert("No internet connection");
           }           
           
       });
        
        
    });
    
    
      
});