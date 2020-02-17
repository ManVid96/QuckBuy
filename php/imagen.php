<?php
$link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");

if($link->connect_error){
    die("Connection failed: ". $link->connect_error);
}
$cosas = 1;
$id= $_REQUEST['id'];
$query = "call Ob_Imagen('$id');";
$result=$link->query($query);
$row = $result->fetch_array();

if (!$row){
    header('Status: 404 Not Found');
}else{
    $img=$row['img_datos'];
    header("Content-type:image/jpg");
    print $img;
}

//<img id="img_card1" class="card-img-top" style="width:268px; height:180px;" src="php/imagen.png?id=<?php echo $row['Img_Id']; ?>" alt="Card image cap">
