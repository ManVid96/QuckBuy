<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");
    
    if($link->connect_error){
	   die("Connection failed: ". $link->connect_error);
    }
    $usuario = mysqli_real_escape_string($link,$_POST['username']);
    $contra = mysqli_real_escape_string($link,$_POST['password']);
    //$query = "call Login('$usuario', '$contra')";
    $query = "call Loging ('$usuario','$contra')";
    $result=$link->query($query);

    if($row = $result->fetch_array()){
        $link->close();
        $_SESSION['User'] = $row['Us_UserName'];
        $_SESSION['Img'] = $row['Us_ImgPerfil'];
        $_SESSION['Admin'] = $row['Us_Admin'];
        $_SESSION['Id'] = $row['Us_Id']; 
        
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
    }
    //header("location:../index.php");
    echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
    $link->close();
?>