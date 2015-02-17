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

function activarCliente(idClie, divContenedor, estado)
{
	// Creo el nuevo objeto ajaxChange 
	var ajaxChange=nuevoAjax();
	ajaxChange.open("GET", "cambiar_estado.php?entidad=clientesportal&campoId=idCliente&id=" + idClie + "&campoEstado=estado&estado=" + estado, true);
	ajaxChange.onreadystatechange=function() 
	{ 
		
		var objDIV=document.getElementById(divContenedor);
		if (ajaxChange.readyState==1)
		{
			// Mientras trabajo cambio "ACTIVO" por "Prosesando..."
			objDIV.innerHTML="Prosesando...";	
		}
		if (ajaxChange.readyState==4)
		{
			
			if (ajaxChange.responseText=="ACTIVO")
				objDIV.innerHTML = "<img src='imagenes/on.png' border=0 style='cursor: pointer;' onclick='activarCliente(\"" + idClie + "\",\"" + divContenedor + "\", 0)' />";
			else
				objDIV.innerHTML = "<img src='imagenes/off.png' border=0 style='cursor: pointer;' onclick='activarCliente(\"" + idClie + "\",\"" + divContenedor + "\", 1)' />";
		} 
	}
	ajaxChange.send(null);
	
}

function activarProducto(idPrd, divContenedor, estado)
{
	// Creo el nuevo objeto ajaxChange 
	var ajaxChange=nuevoAjax();
	ajaxChange.open("GET", "cambiar_estado.php?entidad=productos&campoId=idProducto&id=" + idPrd + "&campoEstado=idEstado&estado=" + estado, true);
	ajaxChange.onreadystatechange=function() 
	{ 
		
		var objDIV=document.getElementById(divContenedor);
		if (ajaxChange.readyState==1)
		{
			// Mientras trabajo cambio "ACTIVO" por "Prosesando..."
			objDIV.innerHTML="Prosesando...";	
		}
		if (ajaxChange.readyState==4)
		{
			
			if (ajaxChange.responseText=="ACTIVO")
				objDIV.innerHTML = "<img src='imagenes/on.png' border=0 style='cursor: pointer;' onclick='activarProducto(\"" + idPrd + "\",\"" + divContenedor + "\", 0)' />";
			else
				objDIV.innerHTML = "<img src='imagenes/off.png' border=0 style='cursor: pointer;' onclick='activarProducto(\"" + idPrd + "\",\"" + divContenedor + "\", 1)' />";
		} 
	}
	ajaxChange.send(null);
	
}
function activarCategoria(idCate, divContenedor, estado)
{
	// Creo el nuevo objeto ajaxChange 
	var ajaxChange=nuevoAjax();
	ajaxChange.open("GET", "cambiar_estado.php?entidad=categoria&campoId=idCategoria&id=" + idCate + "&campoEstado=estado&estado=" + estado, true);
	ajaxChange.onreadystatechange=function() 
	{ 
		
		var objDIV=document.getElementById(divContenedor);
		if (ajaxChange.readyState==1)
		{
			// Mientras trabajo cambio "ACTIVO" por "Prosesando..."
			objDIV.innerHTML="Prosesando...";	
		}
		if (ajaxChange.readyState==4)
		{
			
			if (ajaxChange.responseText=="ACTIVO")
				objDIV.innerHTML = "<img src='imagenes/on.png' border=0 style='cursor: pointer;' onclick='activarCategoria(\"" + idCate + "\",\"" + divContenedor + "\", 0)' />";
			else
				objDIV.innerHTML = "<img src='imagenes/off.png' border=0 style='cursor: pointer;' onclick='activarCategoria(\"" + idCate + "\",\"" + divContenedor + "\", 1)' />";
		} 
	}
	ajaxChange.send(null);
	
}

function activarLinea(idLinea, divContenedor, estado)
{
	// Creo el nuevo objeto ajaxChange 
	var ajaxChange=nuevoAjax();
	ajaxChange.open("GET", "cambiar_estado.php?entidad=lineas&campoId=idLinea&id=" + idLinea + "&campoEstado=idEstado&estado=" + estado, true);
	ajaxChange.onreadystatechange=function() 
	{ 
		
		var objDIV=document.getElementById(divContenedor);
		if (ajaxChange.readyState==1)
		{
			// Mientras trabajo cambio "ACTIVO" por "Prosesando..."
			objDIV.innerHTML="Prosesando...";	
		}
		if (ajaxChange.readyState==4)
		{
			
			if (ajaxChange.responseText=="ACTIVO")
				objDIV.innerHTML = "<img src='imagenes/on.png' border=0 style='cursor: pointer;' onclick='activarLinea(\"" + idLinea + "\",\"" + divContenedor + "\", 0)' />";
			else
				objDIV.innerHTML = "<img src='imagenes/off.png' border=0 style='cursor: pointer;' onclick='activarLinea(\"" + idLinea + "\",\"" + divContenedor + "\", 1)' />";
		} 
	}
	ajaxChange.send(null);
	
}


//-----------------------------------------------------------------------------------------------
<!--
var nav4 = window.Event ? true : false;

function acceptNum(evt){	
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57	
var key = nav4 ? evt.which : evt.keyCode;	
return (key <= 13 || (key >= 48 && key <= 57));
}
//-->
//-----------------------------------------------------------------------------------------------
function mCuitValida(cuit) {
    var vec=new Array(10);
    var cuit_ori = cuit;
    if (cuit.length !=0)
    {
    esCuit=false;
    cuit_rearmado="";
    errors = ''
    for (i=0; i < cuit.length; i++) {   
        caracter=cuit.charAt( i);
        if ( caracter.charCodeAt(0) >= 48 && caracter.charCodeAt(0) <= 57 )     {
            cuit_rearmado +=caracter;
        }
    }
    cuit=cuit_rearmado;
    if ( cuit.length != 11) {  // si no estan todos los digitos
        esCuit=false;
        errors = 'Cuit <11 ';
        alert( "CUIT Menor a 11 Caracteres" );
    } else {
        x=i=dv=0;
        // Multiplico los d�gitos.
        vec[0] = cuit.charAt(  0) * 5;
        vec[1] = cuit.charAt(  1) * 4;
        vec[2] = cuit.charAt(  2) * 3;
        vec[3] = cuit.charAt(  3) * 2;
        vec[4] = cuit.charAt(  4) * 7;
        vec[5] = cuit.charAt(  5) * 6;
        vec[6] = cuit.charAt(  6) * 5;
        vec[7] = cuit.charAt(  7) * 4;
        vec[8] = cuit.charAt(  8) * 3;
        vec[9] = cuit.charAt(  9) * 2;
			                    
        // Suma cada uno de los resultado.
        for( i = 0;i<=9; i++) {
            x += vec[i];
        }
        dv = (11 - (x % 11)) % 11;
        if ( dv == cuit.charAt( 10) ) { 
            esCuit=true;
        } 
    }
    if ( !esCuit ) {
        alert( "CUIT Invalido" );
        document.all['txtCuitCenter'].focus();
        errors = 'Cuit Invalido ';
    } else { mbuscarProductor(cuit_ori) ;}
    }
  //document.MM_returnValue1 = (errors == '');
} 

//-----------------------------------------------------------------------------------------------

function mValidarNumero(fieldName, fieldValue) 
{
    if (fieldName != undefined && fieldName.value != "")
    {
	decallowed = 2;  // indicar los decimales permitidos 0(cero) para no permitirlos

	if (isNaN(fieldValue) || fieldValue == "")
	{
		alert("OJO! No has introducido un numero. Vuelve a intentarlo");
		fieldName.select();
		fieldName.focus();
	}
	else 
	{
		if (fieldValue.indexOf('.') == -1) fieldValue += ".";
		dectext = fieldValue.substring(fieldValue.indexOf('.')+1, fieldValue.length);

		if (dectext.length > decallowed)
		{
			alert ("OJO!! Introduce un numero con " + decallowed + " decimales.  Intentalo de nuevo.");
			fieldName.select();
			fieldName.focus();
      		}		
   	}
    }
}

//-----------------------------------------------------------------------------------------------

function validachar(que,carac) {
	if (que.value.length > carac)
	 {
	  alert('Ha excedido los ' + carac + ' caracteres');
	  que.value = que.value.substring(0,carac);
	  que.focus()
	}
	que.form.count.value = parseInt(carac)-parseInt(que.value.length);
}

//-----------------------------------------------------------------------------------------------
function mConvertirmayuscula(que)
{
	que.value = que.value.toUpperCase(); 
	que.focus()
}

//-----------------------------------------------------------------------------------------------
function openPagina(url,nombre,ancho,alto,sizable) {
	if (window.showModalDialog) {
		window.showModalDialog(url,nombre,"dialogWidth:"+ancho+"px;dialogHeight:"+alto+"px,scrollbars="+sizable);
	} else {
		window.open(url,nombre,'resizable='+sizable+',menubar=no,location=no,toolbar=no,status=no,modal=yes,scrollbars='+sizable+',directories=no,width='+ancho+',height='+alto+',left='+(screen.availWidth-ancho)/2+',top='+(screen.availHeight-alto)/2);
	}
}
//-----------------------------------------------------------------------------------------------
function borra(buscar) {
	if (confirm('�Confirma que desea ELIMINAR este �tem?')==false) {	
		return (false);
		}
return (true);
}

//-----------------------------------------------------------------------------------------------

function mValidarISBN(pObjISBN) 
{
	var salida, plantilla;                   
        
    if (pObjISBN != undefined && pObjISBN.value != "")
    {
	var texto = pObjISBN.value;
        var estructura=true;
        plantilla = new RegExp("^[0-9]{1,5}-[0-9]{1,7}-[0-9]{1,6}-[0-9xX]$"); 
        salida = texto.match(plantilla); 
        if (salida==null)
        {
            estructura=false;
        }
        if (texto.length!=13)
        {
            estructura=false;
        }
        if (!estructura)
        { 
            alert("La estructura del ISBN introducido no coincide con el est�ndar ISBN\n\nEjemplo: 08-436-1072-7\n\n El est�ndar indica esta estructura:\nde 1 a 5 n�meros\ngui�n\nde 1 a 7 n�meros\ngui�n\nde 1 a 6 n�meros\ngui�n\nd�gito de control. de 0 a 9 o \"X\" si el d�gito es 10\nLa longitud total debe ser de 10 d�gitos, m�s los tres guiones.");
	    pObjISBN.select();
	    pObjISBN.focus();
        }
        else
        {
            tt2 = texto.split("-");
            grupo1=new String(tt2[0]);
            grupo2=new String(tt2[1]);
            grupo3=new String(tt2[2]);
            grupo4=new String(tt2[3]);
            total= new Number(0);
            ponderacion=new Number(10);
            for (j= 0; j <grupo1.length; j++) 
            {    
                total+=(parseInt(grupo1.charAt(j))*ponderacion);
                --ponderacion;
            }
            for (j= 0; j <grupo2.length; j++) 
            {    
                total+=(parseInt(grupo2.charAt(j))*ponderacion);
                --ponderacion;
            }    
            for (j= 0; j <grupo3.length; j++) 
            {    
                total+=(parseInt(grupo3.charAt(j))*ponderacion);
                --ponderacion;
            }
            if(grupo4=="X" || grupo4=="x")
            {
                grupo4="10";        
            }
            resto=(total+parseInt(grupo4))%11;
            if (resto!=0)            
            {
                alert("El d�gito de control (�ltimo numero de la serie) no es correcto. ISBN inv�lido.");
		pObjISBN.select();
		pObjISBN.focus();
            }
        }
    }
}


//-----------------------------------------------------------------------------------------------



function mValidarFecha(fecha)
{
    var lbooPasa = true;
    var tipo;
    var numDias=0;
    if (fecha != undefined && fecha.value != "")
    {
        if (!/^\d{2}\/\d{2}\/\d{4}$/.test(fecha.value))
	{
            tipo=1;
            lbooPasa = false;	    
    	}
   	else
    	{
            var dia  =  parseInt(fecha.value.substring(0,2),10);
            var mes  =  parseInt(fecha.value.substring(3,5),10);
            var anio =  parseInt(fecha.value.substring(6),10);
 
    	    switch(mes)
	    {
        	case 1:
        	case 3:
        	case 5:
        	case 7:
        	case 8: 
        	case 10:
        	case 12:
            	    numDias=31;
            	    break;
       		case 4: case 6: case 9: case 11:
            	    numDias=30;
            	    break;
        	case 2:
            	    if (comprobarSiBisisesto(anio)){ numDias=29 }else{ numDias=28};
            	    break;
        	default:
            		lbooPasa = false;				    
    	    }
 
            if ((dia>numDias || dia==0) && (mes > 0 && mes < 13))
	    {
                lbooPasa = false;	    
            }
	}        
    }

    if (!lbooPasa)
    {
	if (tipo==1) 
	{    alert("formato de fecha no v�lido (dd/mm/aaaa)");}
	else
	{    alert("Fecha introducida err�nea");}

        fecha.select();
	fecha.focus();
    }
} 

function comprobarSiBisisesto(anio){
if ( ( anio % 100 != 0) && ((anio % 4 == 0) || (anio % 400 == 0))) {
    return true;
    }
else {
    return false;
    }
} 


//-----------------------------------------------------------------------------------------------
function mAutoTab(pObj, pObjNext, pLenght)
{
	if(pObj.value.length == pLenght)
	{    
		pObjNext.focus();
	}
}

//-----------------------------------------------------------------------------------------------
function mSeleccionar(pObj)
{
	alert(pObj.value);
	pObj.selectionStart = 0;

}
function mSeleccionar(objInput) { 

    var valor_input = objInput.value; 
    var longitud = valor_input.length; 

    if (objInput.setSelectionRange) { 
        objInput.focus(); 
        objInput.setSelectionRange (0, longitud); 
    } 
    else if (objInput.createTextRange) { 
        var range = objInput.createTextRange() ; 
        range.collapse(true); 
        range.moveEnd('character', longitud); 
        range.moveStart('character', 0); 
        range.select(); 
    } 
} 

//-----------------------------------------------------------------------------------------------

function validartexto(cadena){

var exp = /[^A-Za-z0-9_]/;

if (exp.test(cadena)) {
   return 1;
} else {
   return 0;
}

}


// ------------------------------------------------------------------------------------------

function mNavegar(pagina,id, nueva_ventana)
{ 
	
	pagina = pagina + id;
	
	if(pagina != "")
	{ 
            if (nueva_ventana) 
                window.open(pagina); 
            else 
                location.href = pagina; 
        } 
} 



// --------------------------------------------------------------------------------------

function getCookie(name) {
  var cname = name + "=";
  var dc = document.cookie;
  if (dc.length > 0) {
    begin = dc.indexOf(cname);
    if (begin != -1) {
      begin += cname.length;
      end = dc.indexOf(";", begin);
      if (end == -1) end = dc.length;
        return unescape(dc.substring(begin, end));
    }
  }
  return null;
}
// --------------------------------------------------------------------------------------

function setCookie(name,value,days)
{
	// todo expira a un d�a
	days = 1;
	if (days)
	{
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}


// --------------------------------------------------------------------------------------
function delCookie (name,path,domain) {
  if (getCookie(name)) {
    document.cookie = name + "=" +
    ((path == null) ? "" : "; path=" + path) +
    ((domain == null) ? "" : "; domain=" + domain) +
    "; expires=Thu, 01-Jan-70 00:00:01 GMT";
//     cambiaFuente('12', '');
  }
}


//-----------------------------------------------------------------------------------------------


function ahrefThis() {
	strSelection = document.selection.createRange().text
	if (strSelection == "") document.text.text.focus()
	strHref = prompt("Enter the URL of the site you to link:","http://")
	if (strHref == null) return;
	document.selection.createRange().text = "<a href=\"" + strHref + "\" target=\"_blank\" >" + strSelection + "</a>"
	return;
}

function boldThis(from) {
	strSelection = document.selection.createRange().text
	if (strSelection == "") {
		document.text.text.focus()
		if (from == 2) document.text.text.select()
		strSelection = document.selection.createRange().text
		document.selection.createRange().text = strSelection + "<b></b>"
	} else { 
		document.selection.createRange().text = "<b>" + strSelection + "</b>"
	}
return;
}

function clipThis(from) {
	strSelection = document.selection.createRange().text;
	document.text.text.focus();
	var dummy = document.text.text.value;
	document.text.text.value = "";
	if (dummy) {
		document.selection.createRange().text = dummy + "\n\n<i>" + strSelection + "</i>";
	} else {
		document.selection.createRange().text = "<i>" + strSelection + "</i>";
	}
return;
}

function underlineThis() {
	strSelection = document.selection.createRange().text
	if (strSelection == "") {
		document.text.text.focus()
		if (from == 2) document.text.text.select()
		strSelection = document.selection.createRange().text
		document.selection.createRange().text = strSelection + "<u></u>"
	} else {
		document.selection.createRange().text = "<u>" + strSelection + "</u>"
	}
return;
}

function italicThis(from) {
	strSelection = document.selection.createRange().text
	if (strSelection == "") {
		document.text.text.focus()
		if (from == 2) document.text.text.select()
		strSelection = document.selection.createRange().text
		document.selection.createRange().text = strSelection + "<i></i>"
	} else {
		document.selection.createRange().text = "<i>" + strSelection + "</i>"
	}
return;
}



//------------------------------------------------------------------------------
// AJAX ------------------------------------------------------------------------
//------------------------------------------------------------------------------


function mCargarLineas(cmbSeccion)
{
	var urlDestino="cargarLineas.php";
	var idSeccion = cmbSeccion[cmbSeccion.selectedIndex].value;
	var ajaxCargarLinea=nuevoAjax();
	ajaxCargarLinea.open("POST", urlDestino, true);
	ajaxCargarLinea.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajaxCargarLinea.send("idSeccion=" + idSeccion);
	
	ajaxCargarLinea.onreadystatechange=function()
	{
		if (ajaxCargarLinea.readyState==4)
		{
			var selectDestino=document.getElementById('cmbLineas');
			selectDestino.parentNode.innerHTML=ajaxCargarLinea.responseText;  			
		}
	}
}


// Declaro los selects que componen el documento HTML. Su atributo ID debe figurar aqui.
var listadoSelects=new Array();
listadoSelects[0]="cmbSeccion";
listadoSelects[1]="cmbLineas";

function buscarEnArray(array, dato)
{
	// Retorna el indice de la posicion donde se encuentra el elemento en el array o null si no se encuentra
	var x=0;
	while(array[x])
	{
		if(array[x]==dato) return x;
		x++;
	}
	return null;
}

function mCargarLineas(idSelectOrigen)
{
	// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
	var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
	// Obtengo el select que el usuario modifico
	var selectOrigen=document.getElementById(idSelectOrigen);
	// Obtengo la opcion que el usuario selecciono
	var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
	// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."
	if(opcionSeleccionada==0)
	{
		var x=posicionSelectDestino, selectActual=null;
		// Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
		while(listadoSelects[x])
		{
			selectActual=document.getElementById(listadoSelects[x]);
			selectActual.length=0;
			
			var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecciona Opci&oacute;n...";
			selectActual.appendChild(nuevaOpcion);	selectActual.disabled=true;
			x++;
		}
	}
	// Compruebo que el select modificado no sea el ultimo de la cadena
	else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1])
	{
		// Obtengo el elemento del select que debo cargar
		var idSelectDestino=listadoSelects[posicionSelectDestino];
		var selectDestino=document.getElementById(idSelectDestino);
		// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
		var ajax=nuevoAjax();

	    ajax.open("GET", "cargarLineas.php?select="+idSelectDestino+"&opcion="+opcionSeleccionada, true);
	
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
				selectDestino.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
				selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;	
			}
			if (ajax.readyState==4)
			{
				selectDestino.parentNode.innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}

function imprimirPedido(idPedido, estado){
	// Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
	var ajax=nuevoAjax();
    ajax.open("POST", "updateEstadoPedido.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("idPedido="+idPedido+"&estado="+estado);
    ajax.onreadystatechange=function() 
	{ 		
		if (ajax.readyState==4)
		{
			alert(ajax.responseText);
		} 
	}
    window.print();
}

