<?php

    include_once "../config/dbconnect.php";
   
    $order_id=$_POST['record'];
    //echo $order_id;
    $sql = "SELECT order_status from orders where order_id='$order_id'"; 
    $result=$conn-> query($sql);
  //  echo $result;

    $row=$result-> fetch_assoc();
    
   // echo $row["pay_status"];
    
    if($row["order_status"]==0){
         $update = mysqli_query($conn,"UPDATE orders SET order_status=1 where order_id='$order_id'");
    }
    else if($row["order_status"]==1){
         $update = mysqli_query($conn,"UPDATE orders SET order_status=0 where order_id='$order_id'");
    }
    
        
 
    // if($update){
    //     echo"success";
    // }
    // else{
    //     echo"error";
    // }
    
?>