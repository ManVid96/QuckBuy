<?php 
if(isset($_SESSION)){
        echo 'Hay session';
    }else{
        session_start();
    }
    $link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");
    
    function formatoFecha($fecha){
        return date('g:i a', strtotime($fecha));
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="CSS/Estilo.css">
        <link href="https://fonts.googleapis.com/css?family=Mukta+Vaani&display=swap" rel="stylesheet"> 
        <script type="text/javascript">
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
    </head>
    <body onload="ajax();">
        <div id="contendor">
            <div id="caja-chat">
                <div id="chat">
                    
                </div>
            </div>
            <form method="POST" action="chat.php">
                <input type="text" name="nombre" placeholder="Ingresa tu nombre">
                <textarea name="mensaje" placeholder="ingresa tu mensaje"></textarea>
                <button type="submit" name="enviar" value="Enviar"></button>
            </form>
            <?php
                if(isset($_POST['enviar'])){
                    $nombre = $_POST['nombre'];
                    $mensjae = $_POST['mensaje'];
                    
                    $consulta = "insert into mensajes (nombre,mensaje)values('$nombre','$mensjae')";
                    $ejecutar = $link->query($consulta);
                }
            ?>
        </div>
    </body>
</html>
