function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			// Creacion del objet AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E)
		{
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
		}
	}
	return xmlhttp; 
}

function cargarSeccion(idSeccion)
{
	var ajaxSeccion=nuevoAjax();
	ajaxSeccion.open("GET", "seccion.php?id_Seccion=" + idSeccion, true);
	ajaxSeccion.onreadystatechange=function() 
	{ 
		var pnlDestino = document.getElementById('main');
		
		if (ajaxSeccion.readyState==1)
		{			
			pnlDestino.innerHTML="";
			pnlDestino.innerHTML="<div id='imgCargando'><img src='images/cargando_100x100.gif' /></div>";				
		}
		if (ajaxSeccion.readyState==4)
		{
			var txt=unescape(ajaxSeccion.responseText);
			var txt2=txt.replace(/\+/gi," ");
			pnlDestino.innerHTML="";
			pnlDestino.innerHTML=txt2;
		} 
	}
	ajaxSeccion.send(null);
}

function onclick_seccion(idSeccion, pTitu ,pTempURL)
{
	window.location.href= pTempURL + "?idSec=" + idSeccion + "&sec=" + pTitu;
}

function onclick_item(idItem, pTitu ,pTempURL)
{
	window.location.href= pTempURL + "?idItem=" + idItem + "&sec=" + pTitu;
}

function verNotas(pURL)
{
	window.location.href= pURL;
}



/*FORMS*/

function onlyNumbers(obj){
	obj.value = obj.value.replace(/[^0-9\.]/g,'');
}

function validaCantidadChar(campo,carac) {
	if (campo.value.length > carac)
	 {
		alert('Ha excedido los ' + carac + ' caracteres');
		campo.value = campo.value.substring(0,carac);
		campo.focus()
	}
	campo.form.count.value = parseInt(carac)-parseInt(campo.value.length);
}

var error = false;
var error_message = "";

function check_input(form, field_name, field_size, message) {

  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_radio(form, field_name, message) {
  var isChecked = false;

  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var radio = form.elements[field_name];

    for (var i=0; i<radio.length; i++) {
      if (radio[i].checked == true) {
        isChecked = true;
        break;
      }
    }

    if (isChecked == false) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_select(form, field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_with_confirm_input(form, field_name_1, field_name_2, field_size, message_1, message_2) {

  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var password = form.elements[field_name_1].value;
    var confirmation = form.elements[field_name_2].value;

    if (password.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password != confirmation) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    }
  }
}

function check_password_new(form, field_name_1, field_name_2, field_name_3, field_size, message_1, message_2, message_3, message_4) {
  alert();
  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var password_current = form.elements[field_name_1].value;
    var password_new = form.elements[field_name_2].value;
    var password_confirmation = form.elements[field_name_3].value;

    if (password_current.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;    
    } else if (password_new.length < field_size) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    } else if (password_new != password_confirmation) {
      error_message = error_message + "* " + message_3 + "\n";
      error = true;
    } else if (password_current == password_new) {
	  error_message = error_message + "* " + message_4 + "\n";
      error = true;
    }
  }
}

function validaCorreo(valor) {	 
	var pattern = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
    return pattern.test(valor);	 
}
 
function check_Mail(form, field_mail, field_default, message)
{

	if (form.elements[field_mail] && (form.elements[field_mail].type != "hidden")) {
    var field_value = form.elements[field_mail].value;

    if (!validaCorreo(field_value)) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_confirmaMail(form, field_mail, field_confirma, message)
{

	if (form.elements[field_mail] && (form.elements[field_mail].type != "hidden")) {
    var field_value = form.elements[field_mail].value;
	var field_confirma= form.elements[field_confirma].value;
	
	if (field_value != field_confirma) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }    
  }
}


function check_form() {
  form = document.getElementById('create_account');
  error = false;
  error_message = "Hay errores en su formulario!\nPor favor, haga las siguientes correciones:\n\n";
  
  editMode = document.getElementById("editMode").value;

  //Datos Personales
  check_input(form, "txtNombre", 2, "Su Nombre debe tener al menos 2 letras.");
  check_input(form, "txtApellido", 2, "Su apellido debe tener al menos 2 letras.");
  check_Mail(form, "txtMail", 6, "Su direccion de E-Mail no es valida");
  check_confirmaMail(form, "txtMail", "txtConfirmaMail", "La confirmacion de E-Mail no coinciden con el E-Mail ingresado");

  //Datos Empresa
  check_input(form, "txtEmpresa", 5, "Su empresa debe tener al menos 5 letras");
  check_with_confirm_input(form, "txtIdent", "txtConfirmIdent", 8, "Su DNI/CUIT debe tener al menos 8 digitos", "No coincide el DNI/CUIT ingresado.");
  check_input(form, "txtTelefono", 5, "Su telefono debe tener al menos 6 digitos.");
  check_input(form, "txtDomicilio", 5, "Su direccion debe tener al menos 5 letras.");
  check_input(form, "txtCodigoPostal", 4, "Su codigo postal debe tener al menos 4 letras.");
  check_input(form, "txtCiudad", 2, "Su Ciudad - Provincia debe tener al menos 3 letras.");
  check_input(form, "txtPais", 2, "Su Pais debe tener al menos 2 letras.");
  check_input(form, "txtClaveActual", 5, "Debe ingresar su clave valida");

  if (editMode==""){
      //Datos Clave
      check_with_confirm_input(form, "txtClave", "txtConfirmaClave", 5, "Su clave debe tener al menos 5 letras.", "La confirmacion de la Clave debe ser igual a la clave ingresada.");      
  } 
  else {
  	if (document.getElementById("txtClave").value != "")
  	  	check_with_confirm_input("txtClave", "txtConfirmaClave", 5, "Su clave debe tener al menos 5 letras.", "La confirmaci�n de la Clave debe ser igual a la clave ingresada.");
  }

  if (error) {
    alert(error_message);
  } else {
    form.submit();
  }
}


function check_form_Contacto(form_name) {

  if (submitted == true) {
    alert("Ya ha enviado el formulario. Pulse Aceptar y espere a que termine el proceso.");
    return false;
  }

  error = false;
  form = form_name;
  error_message = "Hay errores en su formulario!\nPor favor, haga las siguientes correciones:\n\n";
  
  //Datos Personales
  check_input("nombre", 5, "Su Nombre debe tener al menos 5 letras.");
  check_Mail("email", 6, "Su direcci�n de E-Mail no es valida");
  check_input("consulta", 1, "Debe ingresar la consulta");
  

  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}


function editarCantidad(idProducto, variacion)
{
	// Creo el nuevo objeto ajaxChange 
	var editarCantidad=nuevoAjax();
	editarCantidad.open("GET", "editarCantidadProducto.php?id="+idProducto+"&variacion="+variacion, true);
	editarCantidad.onreadystatechange=function() 
	{ 		
		var txtProducto=document.getElementById("txtProdId_"+idProducto);
		if (editarCantidad.readyState==4)
		{
			txtProducto.value=parseInt(txtProducto.value) + variacion;
			location.reload();
		} 
	}
	editarCantidad.send(null);	
	
}

function setearCantidad(idProducto, oldValue, newValue)
{
	if (oldValue != newValue)
	{		
		// Creo el nuevo objeto ajaxChange 
		var editarCantidad=nuevoAjax();
		editarCantidad.open("GET", "setearCantidadProducto.php?id="+idProducto+"&cant="+newValue, true);
		editarCantidad.onreadystatechange=function() 
		{ 		
			var txtProducto=document.getElementById("txtProdId_"+idProducto);
			if (editarCantidad.readyState==1)
			{
				//txtProducto.value=".";			
			}
			if (editarCantidad.readyState==4)
			{
				if (editarCantidad.responseText != "OK")
					alert("No se pudo actualizar la cantidad del producto seleccionado");	
			} 
		}
		editarCantidad.send(null);
		
	}
}


function eliminarItemCarrito(idProducto)
{
	// Creo el nuevo objeto ajaxChange 
	var eliminarItem=nuevoAjax();
	eliminarItem.open("GET", "eliminarProducto.php?id="+idProducto, true);
	eliminarItem.onreadystatechange=function() 
	{ 		
		if (eliminarItem.readyState==1)
		{
			// Algo...			
		}
		if (eliminarItem.readyState==4)
		{
			if (eliminarItem.responseText == "OK")
				window.location.href="carritoCompras.php";
			else
				alert("No se pudo eliminar el producto seleccionado");	
		} 
	}
	eliminarItem.send(null);
}


function ConfirmarAccionPedido(action, idPedido)
{
	if (action=="terminar")
		TerminarPedido(idPedido);
	else
		VaciarPedido(idPedido);
}

function TerminarPedido(idPedido)
{
	// Creo el nuevo objeto ajaxChange 
	var terminarPedido=nuevoAjax();
	terminarPedido.open("GET", "terminarPedido.php?id="+idPedido, true);
	terminarPedido.onreadystatechange=function() 
	{ 		
		var pnlMensaje=document.getElementById("resultConfirm");
		
		if (terminarPedido.readyState==1)
		{
			// Algo...		
		}
		if (terminarPedido.readyState==4)
		{
			if (terminarPedido.responseText != "ERROR")
				pnlMensaje.innerHTML = terminarPedido.responseText;	
		} 
	}
	terminarPedido.send(null);
}
function VaciarPedido(idPedido)
{
	// Creo el nuevo objeto ajaxChange 
	var vaciarPedido=nuevoAjax();
	vaciarPedido.open("GET", "vaciarPedido.php?id="+idPedido, true);
	vaciarPedido.onreadystatechange=function() 
	{ 		
		if (vaciarPedido.readyState==1)
		{
			// Algo...		
		}
		if (vaciarPedido.readyState==4)
		{
			if (vaciarPedido.responseText == "OK")
				window.location.href="carritoCompras.php";
			else
				alert("No se pudo vaciat el pedido seleccionado");	
		} 
	}
	vaciarPedido.send(null);
}


var TimeToFade = 300.0;
var imgButton;


function fadeIngresoPortal(eid, pobj){
			
	var element = document.getElementById(eid);
	var obj = document.getElementById(pobj);
	
	if (element.style.zIndex == 0 || element.style.zIndex == -1) {
		element.style.zIndex = 99999999;
		element.style.display='block';
	} else {
		
		setTimeout("document.getElementById('" + eid + "').style.zIndex = -1;document.getElementById('" + eid + "').style.display = 'none';", 500);
	}
	
	var intVar;	
	
	var navegador = navigator.appName;	
	var posIN = 250;
	if (navegador == "Microsoft Internet Explorer")
		posIN = -80;
	else if (navegador == "Netscape")
		posIN = -83;
	
	var posicionLeft = obj.offsetLeft + posIN;
	element.style.left = (posicionLeft) +'px';
	var posicionTop = obj.offsetTop +165;
	element.style.top = (posicionTop) +'px';
	
	if(element == null)
	return;

	if(element.FadeState == null){
		element.FadeState = -2;
	}

	if(element.FadeState == 1 || element.FadeState == -1){
		element.FadeState = element.FadeState == 1 ? -1 : 1;
		element.FadeTimeLeft = TimeToFade - element.FadeTimeLeft;
	}else{
		element.FadeState = element.FadeState == 2 ? -1 : 1;
		element.FadeTimeLeft = TimeToFade;
		setTimeout("animateFade(" + new Date().getTime() + ",'" + eid + "')", 33);
	}				
	
}

function animateFade(lastTick, eid){ 

	var curTick = new Date().getTime();
	var elapsedTicks = curTick - lastTick;

	var element = document.getElementById(eid);

	if(element.FadeTimeLeft <= elapsedTicks){

		element.style.opacity = element.FadeState == 1 ? '1' : '0';
		element.style.filter = 'alpha(opacity = ' + (element.FadeState == 1 ? '100' : '0') + ')';
		element.FadeState = element.FadeState == 1 ? 2 : -2;

		return;
	}

	element.FadeTimeLeft -= elapsedTicks;
	var newOpVal = element.FadeTimeLeft/TimeToFade;
	if(element.FadeState == 1)
		newOpVal = 1 - newOpVal;

	element.style.opacity = newOpVal;
	element.style.filter = 'alpha(opacity = ' + (newOpVal*100) + ')';

	setTimeout("animateFade(" + curTick	+ ",'" + eid + "')", 33);
}

$('.searchProduct').click(function() {
	document.forms['searchProduct'].submit();
});

function openPagina(pagina, alto, ancho){ 
window.open(pagina,'ventana','resizable=no,menubar=no,location=no,toolbar=no,status=no,scrollbars=no,directories=no,width='+ancho+',height='+alto+',left='+(screen.availWidth-'+ancho+')/2+',top='+(screen.availHeight-'+alto+')/2); }

function openPagina(pagina, alto, ancho, scroll){ 
window.open(pagina,'ventana','resizable=no,menubar=no,location=no,toolbar=no,status=no,scrollbars='+scroll+',directories=no,width='+ancho+',height='+alto+',left='+(screen.availWidth-'+ancho+')/2+',top='+(screen.availHeight-'+alto+')/2); }
