<?php
/**
 * Created by PhpStorm.
 * User: Yumna Salimrahmat
 * Date: 8/12/2018
 * Time: 4:19 PM
 */

include "../../utility/connection.php";
include "../../utility/function.php";

$idTrans=$_GET['id_trans'];

$id=isset($_GET['reject']);

if(isset($_GET['reject'])){
    $sql="update mst_transaction
        set approve_date=sysdate(),
            id_status=3
     where transaction_id=$idTrans";
}else{
	$sql="update mst_transaction
        set approve_date=sysdate(),
            id_status=2
    where transaction_id=$idTrans";
}


$hasil = $conn->query($sql);
 if($hasil===false){
   $error = trigger_error("query salah" . $conn->error, E_USER_ERROR);;
        header("location:../../statusOrder.php?modul=approval&id=$error");
    }elseif ($id==0){
     //approvew
     $sql="select b.email,a.transaction_id,b.nama_user
             from mst_transaction a
                  inner join lst_user b
                      on a.id_user = b.id_user
           where a.transaction_id=$idTrans";
     $hasil = $conn->query($sql);
     $r = mysqli_fetch_array($hasil);

     $id_trans=$r['transaction_id'];
     $email=$r['email'];
     $nama=$r['nama_user'];

     error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
     require "../../phpmailer/PHPMailerAutoload.php";
     $message = '<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta charset="utf-8">
						<style rel="stylesheet"> 
						 back{padding:1em 0;border-top:1px solid #eee;text-align:right;font-size:11px;}
						</style>
					</head>
					</html>
					<body >
					 <table align="center" cellpadding="0" cellspacing="0" width="800" style="border-collapse: collapse; ">
					  <tr>
					   <td> 
					        <div class="jumbotron"><img src="http://efl.sayts.com/vendors/images/logo_update.png" alt="Efl"  /> </div>
					   </td>
					 </tr>
					 </table>
					 <table align="center" border="0" cellpadding="0" cellspacing="0" width="800" style="border-collapse: collapse;   background-color:#fff">
					  <tr >
						<td bgcolor="#ffffff" style="padding: 10px 10px 10px 10px;">
						 <table border="0" cellpadding="0" cellspacing="0" width="100%">
						  <tr>
						   <td style="font:1em arial, arial, sans-serif; font-weight:bold; border=1">
							   <p>Approval Order '.$id_trans.'</p>
						   </td>
						  </tr> 	  
						  <tr>
						   <td style="padding-top:10px;font:1em arial, arial, sans-serif;">
							   <p>Kepada '.$nama.' ,</p>
				   <p>Order dengan no Transaksi '.$id_trans.' sudah di approve, silahkan proses ke tahap pengiriman</p>
				   <table width="100%">
						<tr><td style="padding-top:15px;">Dengan Hormat,</td></tr><tr><td >EFL Logistic</td></tr>
				   </table>
			   </td>
			   </tr>
			 </table>
			</td>
		  </tr>
		  <tr>
			<td style="padding-top:20px;border-top:1px solid #eee;text-align:center">
				  <table  width="100%">
					 <tr><td style="text-align:center;font:0.8em arial, arial, sans-serif">Copyright &copy;  EFL Logistic</td></tr>
					 <tr><td style="text-align:center;font:0.8em arial, arial, sans-serif">Jl. Kh Taisi Gang Harun II Rt 03 Rw 03</td></tr>
					 <tr><td style="text-align:center;font:0.8em arial, arial, sans-serif;padding-bottom:10px;">
							 Kelurahan Palmerah Kecamatan Palmerah Jakarta Barat 11480
					 </td></tr>
				  </table>	  
			</td>
		  </tr>
		 </table>
		 </body>
		</html>';

// membuat obyek phpmailer
     $mail = new PHPMailer(true);

// memberitahu class untuk menggunakan SMTP
     $mail->IsSMTP();

// mengaktifkan debug SMTP (untuk pengujian) atur 0 untuk menonaktifkan mode debugging, 1 untuk menampilkan hasil debug
     $mail->SMTPDebug = 0;

// mengaktifkan otentikasi SMTP
     $mail->SMTPAuth = true;

// menetapkan prefix ke server
     $mail->SMTPSecure = 'tsl';

// atur Gmail sebagai server SMTP
     $mail->Host = 'smtp.gmail.com';

// atur server SMTP untuk server Gmail
     $mail->Port = 587;

// alamat gmail kamu
     $mail->Username = 'msg.efl@gmail.com';

// password Anda harus disertakan dalam tanda kutip tunggal
     $mail->Password = 'jangandibuka...';

// tambahkan subjek
     $mail->Subject = 'Approval Order ';


// alamat email pengirim dan nama
     $mail->SetFrom('msg.efl@gmail.com', 'Approval Order');

// alamat email penerima
     $mail->AddAddress($email);

// jika kamu mengirim ke beberapa orangg, tambahkan baris ini lagi
//$mail->AddAddress('tosend@domain.com');

// jika kamu ingin mengirim Carbon copy (Cc)
//$mail->AddCC('onthazuke@gmail.com');

// jika kamu ingin mengirim Blind carbon copy (Bcc)
//$mail->AddBCC('tosend@domain.com');

// tambahkan isi pesan
     $mail->MsgHTML($message);

// tambahkan lampiran jika ada
//$mail->AddAttachment('time.png');

     try {
         // kirim email
         $mail->Send();
         $msg = "Silahkan check email";
         header("location:../../statusOrder.php?modul=approval");
     } catch (phpmailerException $e) {
         $msg = $e->getMessage();
         echo $msg;
     } catch (Exception $e) {
         $msg = $e->getMessage();
         echo $msg;
     }
 } elseif($id==1){
     //approvew
     $sql="select b.email,a.transaction_id,b.nama_user
             from mst_transaction a
                  inner join lst_user b
                        on a.id_user = b.id_user
           where a.transaction_id=$idTrans";
     $hasil = $conn->query($sql);
     $r = mysqli_fetch_array($hasil);

     $id_trans=$r['transaction_id'];
     $email=$r['email'];
     $nama=$r['nama_user'];

     error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
     require "../../phpmailer/PHPMailerAutoload.php";
     $message = '<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta charset="utf-8">
						<style rel="stylesheet"> 
						 back{padding:1em 0;border-top:1px solid #eee;text-align:right;font-size:11px;}
						</style>
					</head>
					</html>
					<body >
					 <table align="center" cellpadding="0" cellspacing="0" width="800" style="border-collapse: collapse; ">
					  <tr>
					   <td> 
					        <div class="jumbotron"><img src="http://efl.sayts.com/vendors/images/logo_update.png" alt="Efl"  /> </div>
					   </td>
					 </tr>
					 </table>
					 <table align="center" border="0" cellpadding="0" cellspacing="0" width="800" style="border-collapse: collapse;   background-color:#fff">
					  <tr >
						<td bgcolor="#ffffff" style="padding: 10px 10px 10px 10px;">
						 <table border="0" cellpadding="0" cellspacing="0" width="100%">
						  <tr>
						   <td style="font:1em arial, arial, sans-serif; font-weight:bold; border=1">
							   <p>Reject Order '.$id_trans.'</p>
						   </td>
						  </tr> 	  
						  <tr>
						   <td style="padding-top:10px;font:1em arial, arial, sans-serif;">
							   <p>Kepada '.$nama.' ,</p>
				   <p>Order dengan no Transaksi '.$id_trans.' tidak disetujui atau di reject. silahkan input ulang</p>
				   <table width="100%">
						<tr><td style="padding-top:15px;">Dengan Hormat,</td></tr><tr><td >EFL Logistic</td></tr>
				   </table>
			   </td>
			   </tr>
			 </table>
			</td>
		  </tr>
		  <tr>
			<td style="padding-top:20px;border-top:1px solid #eee;text-align:center">
				  <table  width="100%">
					 <tr><td style="text-align:center;font:0.8em arial, arial, sans-serif">Copyright &copy;  EFL Logistic</td></tr>
					 <tr><td style="text-align:center;font:0.8em arial, arial, sans-serif">Jl. Kh Taisi Gang Harun II Rt 03 Rw 03</td></tr>
					 <tr><td style="text-align:center;font:0.8em arial, arial, sans-serif;padding-bottom:10px;">
							 Kelurahan Palmerah Kecamatan Palmerah Jakarta Barat 11480
					 </td></tr>
				  </table>	  
			</td>
		  </tr>
		 </table>
		 </body>
		</html>';

// membuat obyek phpmailer
     $mail = new PHPMailer(true);

// memberitahu class untuk menggunakan SMTP
     $mail->IsSMTP();

// mengaktifkan debug SMTP (untuk pengujian) atur 0 untuk menonaktifkan mode debugging, 1 untuk menampilkan hasil debug
     $mail->SMTPDebug = 0;

// mengaktifkan otentikasi SMTP
     $mail->SMTPAuth = true;

// menetapkan prefix ke server
     $mail->SMTPSecure = 'tsl';

// atur Gmail sebagai server SMTP
     $mail->Host = 'smtp.gmail.com';

// atur server SMTP untuk server Gmail
     $mail->Port = 587;

// alamat gmail kamu
     $mail->Username = 'msg.efl@gmail.com';

// password Anda harus disertakan dalam tanda kutip tunggal
     $mail->Password = 'jangandibuka...';

// tambahkan subjek
     $mail->Subject = 'Reject Order ';


// alamat email pengirim dan nama
     $mail->SetFrom('msg.efl@gmail.com', 'Reject Order');

// alamat email penerima
     $mail->AddAddress($email);

// jika kamu mengirim ke beberapa orangg, tambahkan baris ini lagi
//$mail->AddAddress('tosend@domain.com');

// jika kamu ingin mengirim Carbon copy (Cc)
//$mail->AddCC('onthazuke@gmail.com');

// jika kamu ingin mengirim Blind carbon copy (Bcc)
//$mail->AddBCC('tosend@domain.com');

// tambahkan isi pesan
     $mail->MsgHTML($message);

// tambahkan lampiran jika ada
//$mail->AddAttachment('time.png');

     try {
         // kirim email
         $mail->Send();
         $msg = "Silahkan check email";
         header("location:../../statusOrder.php?modul=approval");
     } catch (phpmailerException $e) {
         $msg = $e->getMessage();
         echo $msg;
     } catch (Exception $e) {
         $msg = $e->getMessage();
         echo $msg;
     }


 }


?>