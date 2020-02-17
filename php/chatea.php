<?php
    if(!isset($_SESSION)){
        session_start();
    }
  	$link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");
        $idchat = $_SESSION['ChatId'];
    
    if($link->connect_error){
	   die("Connection failed: ". $link->connect_error);
    }
    if($_SESSION['Admin']==1){
        $texto = mysqli_real_escape_string($link,$_POST['areatxt']);
        $contra = mysqli_real_escape_string($link,$_POST['dinero']);
        $query = "call Up_Chat(1,'$texto',null,'$contra','$idchat')";
    }else{
        $texto = mysqli_real_escape_string($link,$_POST['areatxt']);
        $acuerdo = mysqli_real_escape_string($link,$_POST['options']);
        $query = "call Up_Chat(2,'$texto','$acuerdo',null,'$idchat')";
    }
    if($result=$link->query($query)){
        echo 'Ok';
    }
    
    
    