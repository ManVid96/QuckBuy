<?php
    $link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");
    
    if($link->connect_error){
	   die("Connection failed: ". $link->connect_error);
    }
    $nombre = mysqli_real_escape_string($link,$_POST['nombre']);
    $apellidop = mysqli_real_escape_string($link,$_POST['apellidop']);
    $apellidom = mysqli_real_escape_string($link,$_POST['apellidom']);
    $username = mysqli_real_escape_string($link,$_POST['username']);
    $email = mysqli_real_escape_string($link,$_POST['email']);
    $password = mysqli_real_escape_string($link,$_POST['password2']);
    $telefono = mysqli_real_escape_string($link,$_POST['telefono']);
    $direccion = mysqli_real_escape_string($link,$_POST['direccion']);

    if(isset($_FILES['avatar'])){
        $foto=  file_get_contents($_FILES['avatar']['tmp_name']);
        $foto= mysqli_real_escape_string($link, $foto);
    }else{
        echo "la vida te odia:c"; 
    }

    $query = "call Registro_Us ('$nombre','$apellidom','$apellidop','$username','$password','$telefono','$direccion','$foto')";
    $result=$link->query($query);

    if(!$result)
		echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
    else{
        $row = $result->fetch_array();
        
        $_SESSION['User'] = $username;
        $_SESSION['Img'] = $foto;
        $_SESSION['Admin'] = 2; 
        
        $_SESSION['Id'] = $row['us_id']; 
        
        $link->close();
    
        $link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");

        if($link->connect_error){
               die("Connection failed: ". $link->connect_error);
        }

        $id = $_SESSION['Id'];
        $query2 = "call CrearChat('$id');";
        $result=$link->query($query2);

        $row3 = $result->fetch_array();
        $chatid = $row3['@var2'];
        $_SESSION['IdChat'] = $chatid;
        echo '<script>window.close();</script>';
    }
    $link->close();
?>