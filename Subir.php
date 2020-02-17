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
                    <form class="form-container" action="php/SubirArt.php" target="_blank" method="post" id="formArt" enctype="multipart/form-data">
                        <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="textHelp" size="10" maxlength="30"" required>
                        </div>
                        <div class="form-group">
                        <label for="descripcion">Descripción del artículo</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="textHelp" size="10" maxlength="150" required>
                        </div>
                        <div class="form-group">
                                <h5>Categoría</h5>
                        <select name="categoria">
                                        <option value="1">Electronica</option>
                                        <option value="2">Juguete</option>
                                        <option value="3">Videojuegos</option>
                                        <option value="4">Ropa</option>
                                </select>
                        </div>
                        <div class="form-group">
                        <label for="unidades">Unidades</label>
                        <input type="number" class="form-control" name="unidades" id="unidades" aria-describedby="textHelp" size="10" maxlength="2"required>
                        </div>
                        <div class="form-group">
                        <label for="imagenes">Imagenes</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="img1" class="custom-file-input" id="inputGroupFile01" accept="image/jpeg">
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="img2" class="custom-file-input" id="inputGroupFile02" accept="image/jpeg">
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="img3" class="custom-file-input" id="inputGroupFile03" accept="image/jpeg">
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                        <label for="video_articulo">Video</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="video" class="custom-file-input" id="inputGroupFile04" accept="video/mp4">
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                            </div>
                        </div>
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
                    <button id="btn_subir" type="submit" class="btn btn-primary btn-lg btn-block">Agregar</button>
                </form>
            </div>
        </div>
    </main>
</body>	
</html>