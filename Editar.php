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
    $id = $_GET['id'];
    
    $query = "select art_nombre, art_desc, arc_catid, art_cant from articulo inner join cat_art on art_id= arc_artid where art_id ='$id'";
    $result=$link->query($query);
    $row = $result->fetch_array();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/gestion.css">        
    <script type="text/javascript" src="assets/js/gestion.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
    <title>Agregar artículo</title>
    <script type="text/javascript">
       
        $(document).ready(function(){
            $("#btn_subir").click(function(){
                    alert("Entro");
            });
        });
    </script>
</head>
<body>
    <main>
            <div class="container-fluid bg">
                <div class="span4">
                    <h1>Agregar artículo</h1>
                    <form class="form-container" action="php/Modificar.php" target="_blank" method="post" id="formArt">
                        <input type="hidden" class="form-control" name="id" id="id_art" size="10" value="<?php echo $id; ?>" hidden="">
                        <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="textHelp" size="10" maxlength="30" value="<?php echo $row['art_nombre']; ?>" required>
                        </div>
                        <div class="form-group">
                        <label for="descripcion">Descripción del artículo</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="textHelp" size="10" maxlength="150" value="<?php echo $row['art_desc']; ?>" required>
                        </div>
                        <div class="form-group">
                        <label for="unidades">Unidades</label>
                        <input type="number" class="form-control" name="unidades" id="unidades" aria-describedby="textHelp" value="<?php echo $row['art_cant']; ?>" size="10" maxlength="2"required>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary">
                                <input type="radio" name="options" id="option1" autocomplete="off" value="2"> Privado
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="options" id="option2" autocomplete="off" value="1" checked> Publico
                            </label>
                        </div>
                    <br><br>
                    <button id="btn_subir" type="submit" class="btn btn-primary btn-lg btn-block">Modificar</button>
                </form>
            </div>
        </div>
    </main>
</body>	
</html>