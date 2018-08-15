<?php
/**
 * Created by PhpStorm.
 * User: Yumna Salimrahmat
 * Date: 8/12/2018
 * Time: 11:35 AM
 */

include "../../utility/connection.php";
include "../../utility/function.php";
if(isset($_GET['transid'])){
    $idTrans="'".$_GET['transid']."'";

    $sql="update mst_transaction
        set end_time=sysdate()
     where transaction_id=$idTrans";
    $hasil = $conn->query($sql);
    if($hasil===false){
        $error = trigger_error("query salah" . $conn->error, E_USER_ERROR);;
        header("location:../../statusOrder.php?modul=update&id=$error");
    }else{
        header("location:../../statusOrder.php?modul=update");
    }
}else{
    $error = 2;
    header("location:../../statusOrder.php?modul=update&id=$error");
}


?>