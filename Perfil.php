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
        //vista 0 para productos 
        $date1 = isset($_GET['date1']) ? $_GET['date1'] : '';
        $date2 = isset($_GET['date2']) ? $_GET['date2'] : '';
        $tipo = isset($_GET['reporte']) ? $_GET['reporte'] : '';
        $cat = isset($_GET['categorias']) ? $_GET['categorias'] : '';
        if($tipo!=='' || $date1!=='' || $date2!=='' || $cat!==''){
            $vista = 1;
            if($tipo == 1 && $date1=='' && $date2=='' && $cat==''){
                $queryR = "call Pro_RV(4,null,null,null);";
            }else if($date1 !== '' && $date2 !=='' && $cat!==0){
                $date1 = $date1." 00:00:00";
                $date2 = $date2." 23:59:59";
                $queryR = "call Pro_RV(1,'$cat','$date1','$date2');";
            }else if($date1 == '' && $date2 =='' && $cat!==0){
                $queryR = "call Pro_RV(2,'$cat',null,null);";
            }else if($date1 !== '' && $date2 !=='' && $cat==0){
                $date1 = $date1." 00:00:00";
                $date2 = $date2." 23:59:59";
                $queryR = "call Pro_RV(3,null,'$date1','$date2');";
            }else if($date1 !== '' && $date2 =='' && $cat==0){
                $date1 = $date1." 00:00:00";
                $queryR = "call Pro_RV(5,null,'$date1',null);";
            }else if($date1 == '' && $date2 !=='' && $cat==0){
                $date2 = $date2." 23:59:59";
                $queryR = "call Pro_RV(6,null,null,'$date2');";
            }else if($date1 !== '' && $date2 =='' && $cat!==0){
                $date1 = $date1." 00:00:00";
                $queryR = "call Pro_RV(5,'$cat','$date1',null);";
            }else if($date1 == '' && $date2 !=='' && $cat!==0){
                $date2 = $date2." 23:59:59";
                $queryR = "call Pro_RV(6,'$cat',null,'$date2');";
            }
            $resultR=$link->query($queryR);
        }else{
            $vista = 0;
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
                    
                    $("#Lat_Reporte").click(function(){
                        window.open("Perfil.php?reporte=1","_self");
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
                        window.open("index.php","_self");
                });
                
                $('body').on('click', '.btn-secondary', function() {
                    var id = $(this).attr("name");
                    alert("Valor"+id);
                    $.ajax({
                                url:'php/Baja.php',
                                async: true,
                                type: 'POST',
                                data: {id:id},

                                success: function(respuestaDelWS){
                                        alert( "Articulo borrado" );
                                },
                                error: function(x,h,r){
                                        alert("Error:" + x + h + r);
                                }
                        });
                });
                
                $('body').on('click', '.btn-primary', function() {
                    var id = $(this).attr("name");
                    window.open("Editar.php?id="+id);
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
                        <button id="Logout" type="button" class="btn btn-secondary" style="margin-right: 5%">Logout</button>
                    </nav>
                
                    <span class="lateral"> 
                        <div id="Lat_Inicio" class="elemento clickeable"> Inicio </div>
                        <div id="Lat_Publi" class="elemento clickeable"> Publicar Articulo </div>
                        <div id="Lat_Reporte" class="elemento clickeable"> Reportes </div>
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
			<span> <img src="assets/user.png" class="pp" style="background-color: white" ><h1><?php echo $_SESSION['User']; ?></h1></span>
                        
			<span class="saltolinea">
			</span>
		</div>
		<hr>	
                <hr>

		<div>
                    <?php
                    if($vista==0){
                        $link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");
                        if($link->connect_error){
                            die("Connection failed: ". $link->connect_error);
                        }
                        $query = "call Vista_Admin()";
                        $cont = 3;
                        $resultB=$link->query($query);
                        $link->close();
                        while($rowB = $resultB->fetch_array()){
                    ?>
                    <?php
                    if($cont==3){
                    ?>
                    <div class="card-deck" style="margin-top: 10%">
                    <?php
                    }
                    ?>
                        <div id="<?php echo $rowB['art_id']; ?>" class="card">
                          <img class="card-img-top" src="php/imagen.php?id= <?php echo $rowB['Img_Id']; ?>" alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $rowB['Art_Nombre']; ?></h5>
                            <p class="card-text"><?php echo $rowB['Art_Desc']; ?></p>
                            <p class="card-text">Cantidad: <?php echo $rowB['Art_Cant']; ?><hr></p>
                          </div>
                          <button type="button" name="<?php echo $rowB['art_id']; ?>" class="btn btn-primary btn-sm">Editar</button>
                          <button type="button" name="<?php echo $rowB['art_id']; ?>" class="btn btn-secondary btn-sm">Eliminar</button>
                          <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                          </div>
                        </div>
                    <?php
                            if($cont == 3){
                    ?>
                    </div>
                    <?php
                                $cont--;
                            }
                            if($cont==0){
                               $cont=3; 
                            }
                        }
                    }else{
                    ?>
                    <form name="form_reporte" method="get" action="Perfil.php" class="form-inline" style="width: 60%">
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
                    
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Articulo</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Comprador</th>
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
                                <th scope="row"><?php echo $rowR['art_Nombre'] ?></th>
                                <td><?php echo $rowR['cat_nombre'] ?></td>
                                <td><?php echo $rowR['Comprador'] ?></td>
                                <td><?php echo $rowR['ca_cant'] ?></td>
                                <td><?php echo $rowR['ca_precio'] ?></td>
                                <td><?php echo $rowR['ca_date'] ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    }
                    ?>
		</div>
	</span>
</body>
</html>