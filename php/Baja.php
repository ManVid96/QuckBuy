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
    $id = $_POST["id"];
    $query = "call ProcArticulo(2,'$id',null,null,null,null,null,null,null,null,null,null);";
    $resultR=$link->query($query);
    