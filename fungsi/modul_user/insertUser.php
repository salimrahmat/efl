<?php
/**
 * Created by PhpStorm.
 * User: Yumna Salimrahmat
 * Date: 8/13/2018
 * Time: 9:11 PM
 */

include "../../utility/connection.php";
include "../../utility/function.php";

$nama = "'".$_POST['nama_lengkap']."'";
$email = $_POST['email'];
$password=$_POST['password'];
$levelUser=$_POST['lvl_user'];




if(check_email($email)==0){
    header("location:../../user.php?modul=tambah&error=email tidak valid");
}elseif (strlen($password) < 6 || strlen($password) >12){
    header("location:../../user.php?modul=tambah&error=Passworad Minimal 6 karakter dan Maksimal 12");
}
else{
    $email = "'".$_POST['email']."'";
    $password="'".$_POST['password']."'";
    $sql="insert into lst_user (id_level_user,nama_user,password,status,email)
          values ($levelUser,$nama,md5($password),1,$email)";
    $hasil = $conn->query($sql);
    if($hasil===false){
        $error = trigger_error("query salah" . $conn->error, E_USER_ERROR);;
        header("location:../../user.php?modul=tambah&error=$error");
    }else{
        header("location:../../user.php");
    }

}

?>