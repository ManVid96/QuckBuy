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
    $cantidad = mysqli_real_escape_string($link,$_POST['cantidad']);
    $idart = mysqli_real_escape_string($link,$_POST['idart']);
    $id = $_SESSION['Id'];

    $query2 = "call CrearChat('$id');";
    $result=$link->query($query2);
    
    $row3 = $result->fetch_array();
    $chatid = $row3['@var2'];
    $link->close();
    
    $link = mysqli_connect("localhost", "u319225328_alekz", "inframundo96", "u319225328_quick");
    
    if($link->connect_error){
	 die("Connection failed: ". $link->connect_error);
    }
        
    $query = "call AgregaCarrito('$id','$idart', '$cantidad','$chatid')";  

    $result2 = $link->query($query);
    

    if(!$result2)
        echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
    else{
        
        $_SESSION['ChatId'] = $chatid; 
        echo "alert('Todo salio bien');";
        echo '<script>window.close();</script>';
    }
    $link->close();
?>