<?php
    if(isset($_SESSION)){
        echo 'Hay session';
    }else{
        session_start();
    }
    $link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");
    
    if($link->connect_error){
        die("Connection failed: ". $link->connect_error);
    }
    
    function formatoFecha($fecha){
        return date('g:i a', strtotime($fecha));
    }
    if(! empty($_GET)){
        $id = $_SESSION['Id'];
        $idchat = $_SESSION['IdChat'];
        
        $querybtn = "call Marca(2,'$idchat')";
        $result2=$link->query($querybtn);
        
        $query = "call Carrito('$id')";
        $result=$link->query($query);
        $link->close();
    }else{
        $id = $_SESSION['Id'];
        $query = "call Carrito('$id')";
        $result=$link->query($query);
        $link->close();
    }
?>
<!DOCTYPE html>
<html>
	<head>
            <meta charset="utf-8" />
            <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="assets/css/principal.css">
            <link rel="stylesheet" type="text/css" href="CSS/Estilo.css">
            <link href="https://fonts.googleapis.com/css?family=Mukta+Vaani&display=swap" rel="stylesheet">
            <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
            <script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
            <script type="text/javascript">
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
                            $("#formLogin").submit();
                            location.reload();
                        }
                    });

                    $("#Lat_Inicio").click(function(){
                        window.open("index.php","_self");
                    });

                    $("#Lat_Carrito").click(function(){
                        window.open("Carrito.php","_self");
                    });

                    $("#Lat_Publi").click(function(){
                        window.open("Subir.php","_self");
                    });
                    
                    $("#Lat_Cat1").click(function(){
                        window.open("index.php?cat=1","_self");
                    });
                    
                    $("#Lat_Cat2").click(function(){
                        window.open("index.php?cat=2","_self");
                    });
                    
                    $("#Lat_Cat3").click(function(){
                        window.open("index.php?cat=3","_self");
                    });
                    
                    $("#Lat_Cat4").click(function(){
                        window.open("index.php?cat=4","_self");
                    });
                    
                    $("#option1").click(function(){
                        window.open("Carrito.php?Marca=1","_self");
                    });

                    $("#btn_enviar").click(function(){
                        var texto = $("#FormControlTextarea1").val();
                        texto = '+'+texto + $("#inputText").val()+ " \n ";
                        $("#FormControlTextarea1").val(texto);
                        $("#inputText").val('');
                    });
                    
                    $("#btn_Ok").click(function(){
                            window.open("Carrito.php?Marca=1","_self");
                    });
                    
                    $("#btn_Back").click(function(){
                            $("#defaultCheck1").attr('checked', false);
                    });
                    
                    $('#Logout').click(function(){
                        $.ajax({
                                url:'php/Logout.php',
                                async: true,
                                type: 'POST',

                                success: function(respuestaDelWS){
                                        alert( "Funcionjo?" );
                                },
                                error: function(x,h,r){
                                        alert("Error:" + x + h + r);
                                }
                        });
                    });
                    
                    $("#Perfil").click(function(){
                        <?php
                        if($_SESSION['Admin']==1){
                        ?>
                        window.open("Perfil.php","_self");
                        <?php
                        }else{
                        ?>
                        window.open("PerfilUsuario.php","_self");
                        <?php
                        }
                        ?>
                    });
                    
                });
                
                function ajax(){
                    var req = new XMLHttpRequest();

                    req.onreadystatechange = function(){
                        if(req.readyState == 4 && req.status==200){
                            document.getElementById('chat').innerHTML = req.responseText;
                        }
                    }
                    req.open('GET', 'php/chat2.php', true);
                    req.send();
                }
                //hace el refresh de la pagina cada segundo
                setInterval(function(){ajax();},1000);
            </script>
            <title>Carrito y chat</title>
	</head>
	<body onload="ajax();">
            <main>
                    <nav class="navbar navbar-light bg-light" style="color:greenyellow">
                        <a class="navbar-brand">QuickBuy</a>
                        <form class="form-inline" style="width: 60%">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"style="width: 60%; margin-left: 5%">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                            <a class="btn btn-outline-success my-2 my-sm-0" data-toggle="collapse" href="#collapseFecha" role="button" aria-expanded="false" aria-controls="collapseFecha">
                                Por fecha
                            </a>
                            <span class="collapse" id="collapseFecha">
                                <div class="card card-body">
                                De: <input type="date"> Hasta: <input type="date">
                                </div>
                            </span>
                        </form>
                        <?php
                    if(isset($_SESSION['User'])){
                ?>
                    <button id="Perfil" type="button" class="btn btn-success" data-toggle="modal"><?php echo $_SESSION['User']; ?></button>
                    <button id="Logout" type="button" class="btn btn-secondary" data-toggle="modal" style="margin-right: 5%">Logout</button>               
                <?php
                    }else{
                ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Login">Iniciar Sesion</button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#Registro" style="margin-right: 5%">Registrarse</button>
                <?php
                    }
                ?>
                    </nav>
                    <!-- Modal Login -->
                    <div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalCenterTitle"> Login </h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-container" target="_blank" method="post" id="formLogin" action="php/Login.php">
                                <div class="form-group">
                                    <label for="username">Nombre de usuario</label>
                                    <input type="text" class="form-control" name="username" id="inp_username" aria-describedby="textHelp" placeholder="Ingresa tu nombre de usuario">
                                   <small id="textHelp" class="form-text text-muted">También puedes ingresar tu correo.</small>
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" name="password" class="form-control" id="inp_password" placeholder="Ingresa tu contraseña.">
                                </div>
                                <div class="form-group form-check">
                                    
                                    <label class="form-check-label" for="remembercheck">Recuérdame</label>
                                </div>
                                <button id="btn_Login" type="button" class="btn btn-success btn-block">Login</button>
                                <small id="registerHelp" class="form-text text-muted">Registro</small>
                            </form>
                        </div>
                    </div>
                </div>
                 
                    <!-- Modal Registro -->
                    <div class="modal fade" id="Registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Registro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form class="form-container" action="none.php" target="_blank" method="post" id="formLogin" enctype="multipart/form-data" onsubmit="return validate()">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="textHelp" size="10" maxlength="30" pattern="[A-Za-z]{3,30}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input type="text" class="form-control" name="apellido" id="apellido" aria-describedby="textHelp" size="10" maxlength="30" pattern="[A-Za-z]{3,30}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Nombre de usuario</label>
                                        <input type="text" class="form-control" name="username" id="username" aria-describedby="textHelp" placeholder="ejemplo45" size="10" maxlength="30" pattern="[A-Za-z]{3,30}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Correo electrónico</label>
                                        <input type="email" class="form-control" name="email" id="email" aria-describedby="textHelp" size="10" maxlength="60" pattern="[A-Za-z]{3,30}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña.">
                                    </div>
                                    <div class="form-group">
                                        <label for="cmfpsw">Confirmar contraseña</label>
                                        <input type="password" class="form-control" id="cmfpsw" placeholder="Reingresa tu contraseña.">    				
                                        <small id="textHelp" class="form-text text-muted">Las contraseñas deben de coincidir.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="telephone" class="form-control" name="telefono" id="telefono" aria-describedby="textHelp" size="10" maxlength="14">
                                    </div>
                                    <div class="form-group form-check">
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" name="direccion" id="direccion" aria-describedby="textHelp" size="10" maxlength="60">
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar">Avatar</label>
                                        <input type="file" class="form-control" name="avatar" id="avatar" >
                                    </div>
                                    <div class="form-group">
                                        <label for="portada">Portada</label>
                                        <input type="file" class="form-control" name="portada" id="portada" >
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Registro</button>
                                        <small id="loginHelp" class="form-text text-muted">¿Ya tienes cuenta?</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- -->
                
                    <span class="lateral"> 
                        <div id="Lat_Inicio" class="elemento clickeable"> Inicio </div>
                        <div id="Lat_Carrito" class="elemento clickeable"> Mi Carrito </div>
                        <hr>
                        <div class="elemento"> Categorías </div>
                        <hr>
                        <div id="Lat_Cat1" class="elemento clickeable">  Muebles </div>
                        <div id="Lat_Cat2" class="elemento clickeable">  Linea Blanca </div>
                        <div id="Lat_Cat3" class="elemento clickeable">  Electronica </div>
                        <div id="Lat_Cat4" class="elemento clickeable">  Jardin </div>
                        <div id="Lat_Cat5" class="elemento clickeable">  Ropa </div>
                    </span>

                    <span class="dashboard">
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Line Total</th>
                                            <th scope="col">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = $result->fetch_array()){
                                            ?>
                                        <tr>
                                            <th scope="row"><img height="50" width="80"src="php/imagen.php?id=<?php echo $row['art_id'];?>" class="thumb"></th>
                                            <td><?php echo $row['art_nombre'];?></td>
                                            <td><?php echo $row['ca_cant'];?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                            <?php
                                                }
                                            ?>
                                        <tr>
                                            <th scope="row">Shipping & Tax</th>
                                            <td colspan="2" class="light"></td>
                                            <td></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th class="light" scope="row">Total:</th>
                                            <td colspan="2">&nbsp;</td>
                                            <td colspan="2"><span class="thick"></span></td>
                                        </tr>
                                        <tr class="checkoutrow">
                                        <td colspan="5" class="checkout"></td>
                                        </tr>			
                                        <div class="title">
                                            Shopping Bag
                                        </div>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-3">
                                <div id="contendor">
                                    <div id="caja-chat">
                                        <div id="chat">

                                        </div>
                                    </div>
                                    <form method="POST" action="Carrito.php">
                                        <textarea name="mensaje" placeholder="ingresa tu mensaje"></textarea>
                                        <button id="btn_enviar" type="submit" name="enviar" value="Enviar" class="btn btn-primary">Enviar</button>
                                        <button id="btn_Ok" type="button" class="btn btn-success btn-lg">Confirmar Compra</button>
                                 
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-secondary active">
                                                <input type="radio" name="options" id="option1" value="1" autocomplete="off" > De acuerdo
                                            </label>
                                            <label class="btn btn-secondary">
                                                <input type="radio" name="options" id="option2" value="2" autocomplete="off" checked> No de momento
                                            </label>
                                        </div>
                                    </form>
                                    <?php
                                        if(isset($_POST['enviar'])){
                                            $link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");

                                            if($link->connect_error){
                                                die("Connection failed: ". $link->connect_error);
                                            }
                                            $nombre = $_SESSION['User'];
                                            $mensjae = $_POST['mensaje'];
                                            $IdChat = $_SESSION['IdChat'];
                                            
                                            $consulta = "call NuevoMensj(2,'$nombre','$mensjae','$IdChat',null)";
                                            $ejecutar = $link->query($consulta);
                                            $link->close();
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </span>
            </main>
	</body>	
</html>