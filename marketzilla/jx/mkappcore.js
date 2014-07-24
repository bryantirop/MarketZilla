function Core_isEmpty(arg)
{
    for(var i=0; i<arg.length; ++i)
    {
        if(/^\s+$/.test(arg[i]) || arg[i] === "") return true;
    }
    
    return false;
    
}

$(document).ready(function()
{
   
    $(".disabled").on("click", function()
    {
       return false; 
    });
    
});