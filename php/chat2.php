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
    
    $IdChat = $_SESSION['IdChat'];

    $consulta = "call ShowMensj('$IdChat');";
    $ejecutar = $link->query($consulta);

    while($fila = $ejecutar->fetch_array()):
?>
    <div id="datos-chat">
        <span style="color: #1c62c4;"><?php echo $fila['nombre'];?>: </span>
        <span style="color: #848484;"><?php echo $fila['mensaje'];?></span>
        <span style="float: right"><?php echo formatoFecha($fila['fecha']);?></span>
    </div>
<?php                    endwhile;
?>