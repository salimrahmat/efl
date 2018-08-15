<?php
/**
 * Created by PhpStorm.
 * User: Yumna Salimrahmat
 * Date: 8/11/2018
 * Time: 9:52 PM
 */

function get_Date($no){
    $date='';
    if($no==1){
        $date = date('d F Y');
        return $date;
    }elseif ($no==2){
        $date = date('d F Y h:i:s a');
        return $date;
    }
    return $date;
}
//date('D F Y' ,timetostr('2018-08-12 09:29:33'))

function validate_email($email)
{
    if (!preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email)) {
        return "email tidak valid";
    } else {
        return "email valid";
    }
}

function get_Error($no){
    $error="";
    if($no){
        $error="Username or Password Salah";
    }

    return $error;
}

function get_transmission_id($conn){
    $transid="";

    if(date('d')=="30" or date('d')=="31" or date('dm')=="2802"){
        $sql="alter table mst_transaction AUTO_INCREMENT = 1";
        $hasil = $conn->query($sql);
        if($hasil===false){
            echo "gagal";
        }
    }


    $sql="select AUTO_INCREMENT 
            from information_schema.TABLES 
          where TABLE_SCHEMA='saytscom_efl_db' and TABLE_NAME='mst_transaction'";

    $hasil = $conn->query($sql);
    $r = mysqli_fetch_array($hasil);
    $transid = $r['AUTO_INCREMENT'];

    $query="select concat(date_format(sysdate(),'%Y%m'),right(concat('00000000',$transid),7) ) transmission
            from dual";
    $hasil = $conn->query($query);
    $r = mysqli_fetch_array($hasil);
    $transid =$r['transmission'];

    return $transid;
}


function format_tanggal($date){
    return date('Y-m-d h:i:s',strtotime($date));
}


function check_email($email)
{
    if (!preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email)) {
        return "0";
    } else {
        return "1";
    }
}

    ?>