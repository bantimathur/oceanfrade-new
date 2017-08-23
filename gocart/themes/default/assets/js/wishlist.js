$("document").ready(function() {


fetchRec("","");    
   
    
    $(".removefromlist").live("click",function() {
      
            var conf = confirm("Are you sure u want to delete this record?");
            //alert(conf);
            if(conf == true) {
                deletePro($(this).attr('rel'));
            } else {
                return false;    
            }
            
       
    });
    

    
});
function fetchRec(type,value,rel) {
    $("#loader").show();
    var url = site_url+"order/wishlist_ajax";
    $.post(url, { type: type, value: value,rel:rel },
        function(data) {
            $("#loader").hide();
            //alert("Data Loaded: " + datas);
            $("#wishlist-section").html(data);
    });
}
function deletePro(id) {

    var url = site_url+"order/wishlist_delete";
    $.post(url, { str: id},
    function(data) {
        $("#msg").show();
        $("#msg").html("Your Job Has Been Deleted Successfully");
        setTimeout("$('#msg').slideUp()",2000);
        fetchRec();
    });
}