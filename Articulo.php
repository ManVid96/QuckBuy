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
    $id = $_GET['cat'];
    
    $query = "call ArtVentana('$id')";
    $result=$link->query($query);
    $row = $result->fetch_array();
    $link->close();
?>
<!DOCTYPE html>
<html>
	<head>
            <meta charset="utf-8" />
            <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="assets/css/principal.css">    
            <link rel="stylesheet" type="text/css" href="CSS/Estilo.css">
            <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
            <script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){

                    $(".card-img-top").click(function(){
                        window.open("Articulo.php","_self");
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
                    
                    $('body').on('click', '.card', function() {
                        var id = $(this).attr("id");
                        window.open("Articulo.php?cat="+id,"_self");
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
            </script>
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

                    $("#btn_Reistro").click(function(){
                        var pass = $("#password2").val();
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
                            $("#formRegistro").submit();
                            location.reload();
                        }
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
            </script>
            <title>Home</title>
	</head>
	<body>
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
                        <form class="form-container" action="php/Registro.php" target="_blank" method="post" id="formRegistro" enctype="multipart/form-data" onsubmit="return validate()">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="textHelp" size="10" maxlength="30" pattern="[A-Za-z]{3,30}" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido Pat</label>
                                <input type="text" class="form-control" name="apellidop" id="apellidop" aria-describedby="textHelp" size="10" maxlength="30" pattern="[A-Za-z]{3,30}" required>
                            </div>
                             <div class="form-group">
                                <label for="apellido">Apellido Mat</label>
                                <input type="text" class="form-control" name="apellidom" id="apellidom" aria-describedby="textHelp" size="10" maxlength="30" pattern="[A-Za-z]{3,30}" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Nombre de usuario</label>
                                <input type="text" class="form-control" name="username" id="username" aria-describedby="textHelp" placeholder="ejemplo45" size="10" maxlength="30" pattern="[A-Za-z]{3,30}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico</label>
                                <input type="text" class="form-control" name="email" id="email" aria-describedby="textHelp" size="10" >
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password2" class="form-control" id="password2" placeholder="Ingresa tu contraseña.">
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
                                <input type="file" class="form-control" name="avatar" id="avatar" accept="image/jpeg">
                            </div>
                            <div class="form-group">
                                <button type="button" id="btn_Reistro" class="btn btn-success btn-block">Registro</button>
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
                    <?php
                    if($_SESSION['Admin']==1){
                    ?>
                    <div id="Lat_Publi" class="elemento clickeable"> Publicar Articulo </div>
                    <?php
                    }
                    ?>
                    <hr>
                    <div class="elemento"> Categorías </div>
                    <hr>
                    <div id="Lat_Cat1" class="elemento clickeable">  Electronica </div>
                    <div id="Lat_Cat2" class="elemento clickeable">  Juguetes </div>
                    <div id="Lat_Cat3" class="elemento clickeable">  Videojuegos </div>
                    <div id="Lat_Cat4" class="elemento clickeable">  Ropa </div>
                </span>
            
            <span class="dashboard">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" ></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                            
                            $idArt = $row['art_id'];
                            $link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");
                            
                            if($link->connect_error){
                                die("Connection failed: ". $link->connect_error);
                            }
                            $query2 = "call TodasImg('$id')";
                            $result3=$link->query($query2);
                            while($row3 = $result3->fetch_array()){
                        ?>
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="php/imagen.php?id= <?php echo $row3['Img_Id']; ?>" height="400" width="400" alt="First slide">
                      </div>
                        
                        
                        <?php
                            }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
                <div>
                    <video align="center" width ="720" height ="480" controls="controls">
                        <source src ="<?php echo $row['art_video']; ?>" type ="video/mp4"/>
                    </video>
                </div>
                
                <div class="span4">
                    <form class="form-container" action="php/AgregaCarrito.php" target="_blank" method="post" id="formLogin" enctype="multipart/form-data" onsubmit="return validate()">
                        <div class="form-group">
                       
                        <input type="hidden" id="disabledTextInput" readonly class="form-control" name="idart" value="<?php echo $id; ?>">
                       
                        <h2><?php echo $row['Art_Desc']; ?></h2>
                        <label for="descripción"></label>
                        <label for="categoria>" class="lbl_cat"><?php echo $row['cat_nombre']; ?></label>
                        </div>
                        <div class="form-group">
                        <br>
                        <input type="number" name="cantidad" id="cantidad" maxlength="3">
                        <label for="unidades">Unidades</label>
                        <br><br>
                        <button type="submit" class="btn btn-success btn-block">Comprar</button>
                        </div>
                    </form>
                </div>
                <textarea rows="4" cols="50">
                        Ingresa aqui tu comentario.
                </textarea>
                <button type="button">👍</button>
                <button type="button">👎</button>
                <br><br>
	</span>		
        </main>
    </body>	
</html>