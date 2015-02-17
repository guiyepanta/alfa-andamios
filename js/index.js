$(document).ready(function() { 
    $('.prod_details').click(function(event) { 
    	var target = $(event.target);
    	var idPrd = target.attr('data-id-prd');
        $.blockUI({
    			message: '<h1>cargando...</h1>',
    			css: { border: '1px solid #555' }
		});
		var postData = {
	        "idProducto" : idPrd,
	        "showAddToCart" : false,
	    };
		$.ajax({
            url: 'details.php',
            type: 'POST',
            data: postData,
            success: function (data) {
                $.blockUI({
                	message: data ,
    				css: { border: '1px solid #333', left: '25%', top: '25%', width: '625px', '-moz-box-shadow': '0 20px 35px rgba(0,0,0,0.75)', '-webkit-box-shadow': '0 20px 35px rgba(0,0,0,0.75)', 'box-shadow': '0 20px 35px rgba(0,0,0,0.75)' }
    			});
            },
            complete: function() {
                $('.btn_close').click(function() {
                	$.unblockUI();
                });
            },
            error: function () {
                $.unblockUI();
            }
        });
    });
    
    $('.prod_details_link').click(function(event) {
    	event.preventDefault(); 
    	var target = $(event.target);
    	var idPrd = target.attr('data-id-prd');
        $.blockUI({
    			message: '<h1>cargando...</h1>',
    			css: { border: '1px solid #555' }
		});
		var postData = {
	        "idProducto" : idPrd,
	        "showAddToCart" : false,
	    };
		$.ajax({
            url: 'details.php',
            type: 'POST',
            data: postData,
            success: function (data) {
                $.blockUI({
                	message: data ,
    				css: { border: '1px solid #333', left: '25%', top: '25%', width: '625px', '-moz-box-shadow': '0 20px 35px rgba(0,0,0,0.75)', '-webkit-box-shadow': '0 20px 35px rgba(0,0,0,0.75)', 'box-shadow': '0 20px 35px rgba(0,0,0,0.75)' }
    			});
            },
            complete: function() {
                $('.btn_close').click(function() {
                	$.unblockUI();
                });
            },
            error: function () {
                $.unblockUI();
            }
        });
    });
    
    $('.prod_buy').click(function(event) { 
    	var target = $(event.target);
    	var idPrd = target.attr('data-id-prd');
        $.blockUI({
    			message: '<h1>cargando...</h1>',
    			css: { border: '1px solid #555' }
		});
		var postData = {
	        "idProducto" : idPrd,
	        "showAddToCart" : true,
	    };
		$.ajax({
            url: 'details.php',
            type: 'POST',
            data: postData,
            success: function (data) {
                $.blockUI({
                	message: data ,
    				css: { border: '3px solid #ccc', left: '25%', top: '25%', width: '625px', '-moz-box-shadow': '0 20px 35px rgba(0,0,0,0.75)', '-webkit-box-shadow': '0 20px 35px rgba(0,0,0,0.75)', 'box-shadow': '0 20px 35px rgba(0,0,0,0.75)'}
    			});
            },
            complete: function() {
                $('.btn_close').click(function() {
                	$.unblockUI();
                });
            },
            error: function () {
                $.unblockUI();
            }
        });
    });
    
}); 
var addToCart = function(postData){
	$.ajax({
        url: 'addToCart.php',
        type: 'POST',
        data: postData,
        success: function (data) {
        	$.blockUI({
            	message: data 		    				
			});		                
        },
        complete: function() {
            $.unblockUI();
        },
        error: function () {
            $.unblockUI();
        }
    });
};