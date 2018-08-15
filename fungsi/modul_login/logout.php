<?php
/**
 * Created by PhpStorm.
 * User: Yumna Salimrahmat
 * Date: 8/10/2018
 * Time: 11:20 PM
 */
include "../../utility/connection.php";
  session_start();
  session_destroy();
  mysqli_close($conn);

  header("location:../../index.php");
  //echo "<script>alert('Anda telah keluar dari halaman administrator'); window.location = '../'</script>";

?>