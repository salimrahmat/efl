<?php
/**
 * Created by PhpStorm.
 * User: Yumna Salimrahmat
 * Date: 8/12/2018
 * Time: 3:00 PM
 */
include "../../utility/connection.php";
include "../../utility/function.php";

$nama = "'".$_POST['nama']."'";
$pass = "'".$_POST['password']."'";
$iduse= $_POST['iduser'];




$sql="update lst_user
        set nama_user=$nama,
            password=md5($pass)
      where id_user=$iduse";

$hasil = $conn->query($sql);

if($hasil===false){
    $error = trigger_error("query salah" . $conn->error, E_USER_ERROR);;
    header("location:../../order.php?modul=input&act=$error");
}else{
    header("location:../../profile.php?modul=update");
}


?>