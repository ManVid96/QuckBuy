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
    $tipo = 1;
    if(!empty($tipo) || !empty($_GET['date1']) || !empty($_GET['date2']) || !empty($_GET['categorias'])){
            $date1 = $_GET['date1'];
            $date2 = $_GET['date2'];
            $cat = $_GET['categorias'];
            $user = $_SESSION['User'];
            if($tipo == 1 && $date1=='' && $date2=='' && $cat==''){
                $queryR = "call Pro_RC(4,'$user',null,null,null);";
            }else if($date1 !== '' && $date2 !=='' && $cat!==0){
                $date1 = $date1." 00:00:00";
                $date2 = $date2." 23:59:59";
                $queryR = "call Pro_RC(1,'$user','$cat','$date1','$date2');";
            }else if($date1 == '' && $date2 =='' && $cat!==0){
                $queryR = "call Pro_RC(2,'$user','$cat',null,null);";
            }else if($date1 !== '' && $date2 !=='' && $cat==0){
                $date1 = $date1." 00:00:00";
                $date2 = $date2." 23:59:59";
                $queryR = "call Pro_RC(3,'$user',null,'$date1','$date2');";
            }else if($date1 !== '' && $date2 =='' && $cat==0){
                $date1 = $date1." 00:00:00";
                $queryR = "call Pro_RC(5,'$user',null,'$date1',null);";
            }else if($date1 == '' && $date2 !=='' && $cat==0){
                $date2 = $date2." 23:59:59";
                $queryR = "call Pro_RC(6,'$user',null,null,'$date2');";
            }
            $resultR=$link->query($queryR);
        }
    
    $link->close();
?>
<!DOCTYPE html>
<html>
<head>
            <meta charset="utf-8" />
            <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="assets/css/principal.css">
            <link rel="stylesheet" type="text/css" href="CSS/Estilo.css">
            <link rel="stylesheet" type="text/css" href="CSS/EstiloPerfil.css">
             <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
            <script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#btn_Login").click(function(){
                        var user = $("#inp_username").val();
                        var pass = $("#inp_password").val();
                        if(pass==""){
                            alert ("Ingrese una contraseña en el campo");
                        }
                        if(user==""){
                            alert ("Ingrese un usuario en el campo");
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
                    
                    $("#Lat_ReporteC").click(function(){
                        window.open("Perfil.php?reporte=1","_self");
                    });
                });
            </script>
            <title>Perfil</title>
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
                        <button id="Loigout_User" type="button" class="btn btn-secondary" style="margin-right: 5%">Logout</button>
                    </nav>
                
                    <span class="lateral"> 
                        <div id="Lat_Inicio" class="elemento clickeable"> Inicio </div>
                        <div id="Lat_Carrito" class="elemento clickeable"> Mi Carrito </div>
                        <div id="Lat_ReporteC" class="elemento clickeable"> Reporte de Compras </div>
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
		<div>
			<img class="portada" id="portada" src="assets/malza.jpg">
		</div>
		<div>   
			<span> <img src="php/imagenUs.php?id=<?php echo $_SESSION['User']; ?>" class="pp" style="background-color: white" ><h1><?php echo $_SESSION['User']; ?></h1></span>
                        
			<span class="saltolinea">
			</span>
		</div>
		<hr>	
                <hr>
                <form name="form_reporte" method="get" action="PerfilUsuario.php" class="form-inline" style="width: 60%">
                    <a class="btn btn-outline-success my-2 my-sm-0" data-toggle="collapse" href="#collapseFecha" role="button" aria-expanded="false" aria-controls="collapseFecha">
                    Opciones
                    </a>
                    <span class="collapse" id="collapseFecha">
                        <div class="card card-body">
                            De: <input name="date1" type="date"> Hasta: <input name="date2" type="date">
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" name ="categorias"class="form-control">
                                    <option value="0"selected>Categorias</option>
                                    <option value="1">Electronica</option>
                                    <option value="2">Juguetes</option>
                                    <option value="3">Videojuegos</option>
                                    <option value="4">Ropa</option>
                                </select>
                            </div>
                        </div>                        
                    </span>
                    <button id="Reporte" type="submit" class="btn btn-success" data-toggle="modal" data-target="#Login">Hacer Reporte</button>
                </form>
                
		<div>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Articulo</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($rowR = $resultR->fetch_array()){
                            ?>
                            <tr>
                                <th scope="row"><?php echo $rowR['art_nombre'] ?></th>
                                <td><?php echo $rowR['cat_nombre'] ?></td>
                                <td><?php echo $rowR['ca_cant'] ?></td>
                                <td><?php echo $rowR['ch_precio'] ?></td>
                                <td><?php echo $rowR['ca_date'] ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
		</div>
	</span>
</body>
</html>