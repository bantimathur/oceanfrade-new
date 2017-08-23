var Addtocart = function () { 
	var addToCartformHandler = function(){
			var form1 = $('.product-cart-form form');	           
            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                invalidHandler: function (event, validator) { },                
                submitHandler: function (form) {
                    var action = form1.attr('action');
                    var formdata = form1.serialize();                    
                    addToCartHandler(action,formdata,'');
                    return false;
                }
            });
	}

    var addToCartlinkHandler    =function() {
        var link = $('.product-cart-link');   
        link.live('click',function(e){
            var formdata = {};
            formdata['id']=$(this).data('product_id');
            formdata['cartkey']=$(this).data('cartkey');
            var typeadc = $(this).data('typeadc');


            var action = $(this).attr('href');
            addToCartHandler(action,formdata,typeadc);            
            e.preventDefault();
        });        
    }


    var addToCartHandler = function(action,formdata,typeadc){
        $.post(action,formdata,function(data){
            if(typeadc=='buynow'){
                window.location.href=site_url+'/cart/view_cart';
            }
            $("#total_cart_count").text(parseInt(data));
        });
    }


    var addToWishList  = function(){
         var link = $('.product-add-to-wishlist');   
        link.on('click',function(e){
            var formdata = {};
            formdata['id']=$(this).data('product_id');            
            var action = $(this).attr('href');
            $.post(action,formdata,function(data){
                if(data==0)
                    alert("please login first.");
                else
                    alert("added to wishlist..");
            });
            e.preventDefault();
        });
    }

    return {
        //main function to initiate the module
        init: function () {
        	addToCartformHandler();    
            addToCartlinkHandler();    
            addToWishList(); 
        }

    };

}();
