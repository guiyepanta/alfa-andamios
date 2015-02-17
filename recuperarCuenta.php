<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Details</title>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
        <style type="text/css">
            .btn {
	            -moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	            -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	            box-shadow:inset 0px 1px 0px 0px #ffffff;
	            background-color:#ededed;
	            -webkit-border-top-left-radius:6px;
	            -moz-border-radius-topleft:6px;
	            border-top-left-radius:6px;
	            -webkit-border-top-right-radius:6px;
	            -moz-border-radius-topright:6px;
	            border-top-right-radius:6px;
	            -webkit-border-bottom-right-radius:6px;
	            -moz-border-radius-bottomright:6px;
	            border-bottom-right-radius:6px;
	            -webkit-border-bottom-left-radius:6px;
	            -moz-border-radius-bottomleft:6px;
	            border-bottom-left-radius:6px;
	            text-indent:0;
	            border:1px solid #dcdcdc;
	            display:inline-block;
	            font-family:arial;
	            font-size:16px;
	            font-weight:bold;
	            font-style:normal;
	            height:36px;
	            line-height:36px;
	            margin-bottom: 5px;
	            text-decoration:none;
	            text-align:center;
	            text-shadow:1px 1px 0px #ffffff;
            }
            .close {
                width:100px;
                color:#777777;                
            }
            .recuest_account{                
                width: 175px;
                color: #0054A3; 
            }
            .btn:hover {
            	background-color:#dfdfdf;
            }
            .btn:active {
            	position:relative;
            	top:1px;
            }
            
            #galeria, #galeria * {
            	box-sizing:border-box,-moz-box-sizing:border-box
            }
			#galeria {
				border: 1px solid #EAEAEA;  /* Borde de la galería */
				padding: 5px;
				background: white;  /* Fondo de la galería */
				width: 190px;  /* Ancho de la galería */
			}
			#galeria_miniaturas {
				display: table;
				margin: 0 auto;
			}
			#imgGaleria {
				height: 140px;
			}
			.miniatura {
			    border: 1px solid #ddd;
			    cursor: pointer;
			    float: left;
			    height: 50px;
			    margin: 3px;
			    padding: 2px;
			    width: 50px;
			}
			.miniatura:hover {
				opacity:.8;   /* Opacidad */
				-moz-opacity:.8;
				-khtml-opacity:.8;
				filter:alpha(opacity=80);
			}
			.miniatura:active {
				opacity:1;
				-moz-opacity:1;
				-khtml-opacity:1;
				filter:alpha(opacity=80);
			}
            .error_hidden{
                display: none;
            }
            .error_active{
                display: inline;
                color: #f00;
                font-size: 11px;
                padding-left: 148px;
            }		            
        </style>
        
        <script>
        	$(document).ready(function() { 
        	    var clearError = function(){
        	        $('.error_active').removeClass("error_active").addClass("error_hidden");
        	    };
        		var displayError = function(msj){
                    $('.error_hidden').html(msj);
                    $('.error_hidden').removeClass("error_hidden").addClass("error_active");
                }; 
                
                var recuestAccount = function(postData){
                    clearError();
                    $.ajax({
                        url: 'requestAccount.php',
                        type: 'POST',
                        data: postData,
                        success: function (data) {
                            if (data=="TRUE"){
                                alert("Se ha enviado la informacion a la cuenta de correo indicada.\r\nSi no recibe la informacion, revise los correos no deseados de su casilla de e-mail,\r\nsi no lo encuentra comuniquese con nosotros.");
                            } else if (data.indexOf("FALSE-ERROR-SEND") > -1) {
                                alert("Ha acurrido un error al intentar enviar sus datos.\r\nVualva a intentar luego y si el error persiste comuniquese con nosotros.");
                                $('a.close').trigger("click"); 
                            } else {
                                displayError(data);
                            }                                
                        }
                    });                    
                }; 
                
        		$('#button.recuest_account').click(function(event) {
                    clearError(); 
        			var email = $('#txtEmail.recuest_account').val();
                    var ident = $('#txtIdent.recuest_account').val();
                    var error = "";
        			
        			if (email=="") {
        			    error = "Debe ingresar e-mail.";
        			} 
        			else if(!validaCorreo(email)) { 
            			error = "E-mail invalido.";
                    }
            		else if (ident == ""){
            		    error = "Debe ingresar DNI o CUIT.";
            		}
            			
            		if (error==""){
            		  var postData = {
                            "email" : email,
                            "ident":ident
                        };
                        recuestAccount(postData);    
            		}
            		else
            		    displayError(error);
            		        			
        		});
        		
        		     		
        	});
        </script>
    </head>
    <body>        
        <div id="main_container">
	        <div id="main_content">
	            <div class="center_content">
	            	<div class="center_title_bar">Recuperar datos Cuenta</div>
	                <div class="center_recuest_account_box">
                        <div class="details_recuest_account">
                              <span>&iquest;Has olvidado los datos de tu cuenta?</span>
                              <br />Escribe la direccion de e-mail con la que has creado la cuenta y tu DNI o CUIT
                              y te enviaremos los datos de acceso a tu cuenta de e-mail.                          
                        </div>
                        <div class="form_recuest_account">
                            <form>
                                <label>Direcci&oacute;n de E-mail:</label>
                                <input type='text' id='txtEmail' name='txtEmail' style='width:250px'class="recuest_account" />
                                <br />
                                <label style="margin-left: 67px;">DNI / CUIT:</label>
                                <input type='text' id='txtIdent' name='txtIdent' style='width:100px'class="recuest_account" maxlength="11"/>&nbsp;<span style="color:#6E899D; font-size: 11px;">Sin puntos (.), espacios y guiones (-)</span>
                                <br /><span class="error_hidden"></span>
                            </form>
                        </div>
                    </div>
	            </div>
	            <div style="float: left; padding-right: 10px; text-align: right; width: 615px;"><a href="#" id="button" class="btn recuest_account">Recuprar datos</a>&nbsp;<a href="#" class="btn close">Cerrar</a></div>
	        </div>
        </div>
        <!-- end of main_container -->
        <script language="Javascript">
            document.oncontextmenu = function(){return false}
        </script>
    </body>
</html>