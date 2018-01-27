<?php

session_start();
if(isset($_SESSION['usuario'])){
	header("Location: control/index.php");

}
?>

<!doctype html>
<html>
<head>
	<meta charset ="utf-8"> <!-- para que los caractres en español como la ñ aparezcan bien -->
	<title>
		Formulario de Acceso
	</title>
</head>
<body>
	<form name="forma " id="forma" >
		
		<fieldset>
			<legend>
				Formulario de acceso
			</legend>
			<label for ="usuario">Usuario </label>   <!-- el for se usa para el regresar el foco a donde le de click --> 
			<input type="text" id ="usuario"><br>
			<label for ="pass">Contraseña </label>
			<input type="password" id ="pass"><br>
			<input id="btnEnviar" type ="button" value="Acceder">
		</fieldset>

	</form>
	<script src="scripts/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(   // llamando al jquery
			function() {
				$('#btnEnviar').click(
					function(){
							try{
								var myUsuario = new Object ();
								obj = document.getElementById('usuario');	
								if(obj.value==""){

									alert("Campo usuario vacio");
									obj.focus();
									return;
									}
									myUsuario.usuario= obj.value;
									
									obj = document.getElementById('pass');
									if(obj.value == ""){
									alert("Campo contraseña vacio");
									obj.focus();
									return	
									}
									myUsuario.pass= obj.value;

									var json= JSON.stringify(myUsuario);
									//alert(json);
									//va a ocurrir el evento pos que indica la url donde mandaremos los datos y las funciones
									$.post(
											"http://localhost/curso/servicio/login.php", json, function (responseText, status){
												try{
													if(status == "success"){

														resultado = JSON.parse(responseText);
														if(resultado.estado == "OK"){
															alert("Pudiste entrar");
															//verifica si pasamos por el logeo
															window.location.href="index.php";
														}else{
															alert(resultado.estado);
														}
													}
												}catch (e){
													alert("Error en la peticion" + e)
												}

											}//fin de funcin del responsetext

										);//ciere pos
									

							}catch(e){

								alert("Error :" + e);
							}		
																//alert("Hola JUEGA DARK SOUL"); //mensaje que deseas que muestre
					}
				); //se hace refeencia a un identificador
			}
			);
	</script>
</body>
</html>