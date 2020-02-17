<?php
    $link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");
    if($link->connect_error){
	   die("Connection failed: ". $link->connect_error);
    }
    
    echo $nombre = mysqli_real_escape_string($link,$_POST['nombre']);
    echo $Desc = mysqli_real_escape_string($link,$_POST['descripcion']);
    echo $cat = mysqli_real_escape_string($link,$_POST['categoria']);
    echo $unidades = mysqli_real_escape_string($link,$_POST['unidades']);
    echo $estado = mysqli_real_escape_string($link,$_POST['options']);
    
    if(isset($_FILES['img1'])){
        $foto=  file_get_contents($_FILES['img1']['tmp_name']);
        $foto= mysqli_real_escape_string($link, $foto);
    }else{
        echo "la vida te odia:c"; 
    }
    if(isset($_FILES['img2'])){
        $foto2=  file_get_contents($_FILES['img2']['tmp_name']);
        $foto2= mysqli_real_escape_string($link, $foto2);
    }else{
        echo "la vida te odia:c"; 
    }
    if(isset($_FILES['img2'])){
        $foto2=  file_get_contents($_FILES['img2']['tmp_name']);
        $foto2= mysqli_real_escape_string($link, $foto2);
    }else{
        echo "la vida te odia:c"; 
    }
    $fecha=strftime( "%Y-%m-%d-%H-%M-%S", time() );
    
    $uploads_dir = '../Videos/';
    $uploads_dir2 = 'Videos/';
    if($_FILES['video']['error']==UPLOAD_ERR_OK){
    //video name y path
    $archivoRecibido1 = $_FILES['video']['tmp_name'];
    $nameVideo=basename($_FILES['video']['name']);
    $type = $_FILES["video"]["type"];
    
    if(move_uploaded_file($archivoRecibido1, $uploads_dir.$fecha.$nameVideo)){
        echo 'Listo video';
        $dirVideo = $uploads_dir2.$fecha.$nameVideo;
    }
    
    $query = "call ProcArticulo (1,null,'$nombre','$Desc','$cat','$unidades','$estado','$dirVideo', 1,'$foto','$foto2','$foto')";
    $result=$link->query($query);
    
    if(!$result)
        echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
    else{
        echo '<script>window.open("../index.php","_self");</script>';
    }
    $link->close();
    
    }