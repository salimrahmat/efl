<?php
/**
 * Created by PhpStorm.
 * User: Yumna Salimrahmat
 * Date: 8/12/2018
 * Time: 10:24 AM
 */

include "../../utility/connection.php";
include "../../utility/function.php";

$idTrans=$_POST['id_trans'];
$jobDetail="'".$_POST['job_detail']."'";
$jobDesc="'".$_POST['job_descript']."'";
$comDestina="'".$_POST['comp_destination']."'";
$startPosition="'".$_POST['start_position']."'";
$timeGo="'".format_tanggal($_POST['time_go'])."'";
$user = "'".$_POST['user']."'";
//echo $idTrans;
$sql="update mst_transaction
        set job_detail=$jobDetail,
            job_description=$jobDesc,
            company_designation=$comDestina,
            start_position=$startPosition,
            start_time=$timeGo,
            update_date=sysdate(),
            user=$user
     where transaction_id=$idTrans";
$hasil = $conn->query($sql);
if($hasil===false){
    $error = trigger_error("query salah" . $conn->error, E_USER_ERROR);;
    header("location:../../order.php?modul=input&id=$error");
}else{
    header("location:../../order.php?modul=input");
}

?>