<?php
$link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");

if($link->connect_error){
    die("Connection failed: ". $link->connect_error);
}
$cosas = 1;
$id= $_REQUEST['id'];
$query = "select us_imgperfil from usuario where us_username = '$id';";
$result=$link->query($query);
$row = $result->fetch_array();

if (!$row){
    header('Status: 404 Not Found');
}else{
    $link->close();
    $img=$row['us_imgperfil'];
    header("Content-type:image/jpg");
    print $img;
}