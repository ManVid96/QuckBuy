$(document).ready(function(){
	$("#btn_Login").click(function(){
		var user = $("#inp_username").val();
		var pass = $("#inp_password").val();
		var ok = false;

		var nMay = 0, nMin = 0, nNum = 0;
		var t1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ" ;
		var t2 = "abcdefghijklmnopqrstuvwxyz";
		var t3 = "0123456789";
        if (pass.length < 8) {
	        alert("Su password, debe tener almenos 8 elementos"+ pass.length);
        }else {
            //Aqui continua si la variable ya tiene mas de 8 letras
           	for (i=0;i<pass.length;i++) { 
				if ( t1.indexOf(pass.charAt(i)) != -1 ) {nMay++;} 
				if ( t2.indexOf(pass.charAt(i)) != -1 ) {nMin++;} 
				if ( t3.indexOf(pass.charAt(i)) != -1 ) {nNum++;} 
			} 
			if ( nMay>0 && nMin>0 && nNum>0 ) {
				ok = true;
			}
			else { 
				alert("Su password no cumple con tener por lo menos 1 Mayuscula, Minuscula o Numero"); 
				return; 
			}
		}
		if(ok == true){
			Login2();
    	}
	});

	function Login2(){
		$("#formLogin").submit();
	}

	function sendLogin(user2,pass2) {
		var datosEnviar = {
			action: '1',
			text: user2,
			pass: pass2
		};

		$.ajax({
			url:'php_Login.php',
			async: true,
			type: 'POST',
			data: datosEnviar,
			dataType: 'json',
			cache: false,

			success: function(respuestaDelWS){
				alert( respuestaDelWS );
			},
			error: function(x,h,r){
				alert("Error:" + x + h + r);
			}
		});

		//JSon
		//Objeto literal para parcial
		var miObjeto = {
			edad: 21,
			nombre: 'Manuel'
		};

		//Objto convertido a json
		var miObjetoenJSON = JSON.stringify(miObjeto);

		//JSON convertido a Objeto
		var miObjetoRecuperado = JSON.parse(miObjetoenJSON);
	}
});