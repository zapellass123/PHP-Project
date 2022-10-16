<?php

    include_once "../config/dbconnect.php";
    
    $id=$_POST['record'];
    $query="DELETE FROM sizes where size_id='$id'";

    $data=mysqli_query($conn,$query);

    if($data){
        echo"Size Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>