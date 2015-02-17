$(document).ready(function() {    
    
    $('.recuest_account_link').click(function(event) {
    	event.preventDefault(); 
    	var target = $(event.target);
        $.blockUI({
    			message: '<h1>cargando...</h1>',
    			css: { border: '1px solid #555' }
		});		
		$.ajax({
            url: 'recuperarCuenta.php',
            type: 'GET',
            success: function (data) {
                $.blockUI({
                	message: data ,
    				css: { border: '1px solid #333', left: '25%', top: '25%', width: '625px', '-moz-box-shadow': '0 8px 16px rgba(0,0,0,0.5)', '-webkit-box-shadow': '0 8px 16px rgba(0,0,0,0.5)', 'box-shadow': '0 8px 16px rgba(0,0,0,0.5)' }
    			});
            },
            complete: function() {
                $('.close').click(function() {
                	$.unblockUI();
                });
            },
            error: function () {
                $.unblockUI();
            }
        });
    });
});