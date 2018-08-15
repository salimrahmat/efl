<?php
/**
 * Created by PhpStorm.
 * User: Yumna Salimrahmat
 * Date: 8/13/2018
 * Time: 10:36 PM
 */
include "../../utility/connection.php";
include "../../utility/function.php";

$nama = "'".$_POST['nama_lengkap']."'";
$email = $_POST['email'];
$password=$_POST['password'];
$levelUser=$_POST['lvl_user'];
$idUser=$_POST['idUser'];
if(check_email($email)==0){
    header("location:../../user.php?modul=tambah&error=email tidak valid");
}elseif (strlen($password) < 6 || strlen($password) >12){
    header("location:../../user.php?modul=tambah&error=Passworad Minimal 6 karakter dan Maksimal 12");
}else{
    $email = "'".$_POST['email']."'";
    $password="'".$_POST['password']."'";
    $sql="update lst_user
            set  id_level_user=$levelUser,
                 nama_user=$nama,
                 password=md5($password),
                 email=$email
          where id_user=$idUser";
    $hasil = $conn->query($sql);
    if($hasil===false){
        $error = trigger_error("query salah" . $conn->error, E_USER_ERROR);;
        header("location:../../user.php?modul=tambah&error=$error");
    }else{
        header("location:../../user.php");
    }
}


?>