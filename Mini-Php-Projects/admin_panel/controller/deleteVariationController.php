<?php

    include_once "../config/dbconnect.php";
    
    $id=$_POST['record'];
    $query="DELETE FROM product_size_variation where variation_id='$id'";

    $data=mysqli_query($conn,$query);

    if($data){
        echo"variation Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>