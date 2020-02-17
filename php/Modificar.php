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
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $Desc = $_POST['descripcion'];
    $unid = $_POST['unidades'];
    $estado = $_POST['options'];
    
    $query = "call ProcArticulo(3,'$id','$nombre','$Desc',null,'$unid','$estado',null,null,null,null,null)";
    $result=$link->query($query);
    $link->close();
    echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
?>