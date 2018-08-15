<?php
/**
 * Created by PhpStorm.
 * User: Yumna Salimrahmat
 * Date: 8/13/2018
 * Time: 9:56 PM
 */
include "../../utility/connection.php";
include "../../utility/function.php";


if(isset($_GET['stat'])){
    $status=$_GET['stat'];
    $id = $_GET['id'];
    if($status==1){
        $sql="update lst_user
                set status=0
              where id_user=$id";
    }else{
        $sql="update lst_user
                set status=1
              where id_user=$id";
    }

    $hasil = $conn->query($sql);
    if($hasil===false){
        $error = trigger_error("query salah" . $conn->error, E_USER_ERROR);;
    }else{
        header("location:../../user.php");
    }

}

?>