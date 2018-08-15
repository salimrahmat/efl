<?php
function sendLupaMail ($email,$userid){
    include "koneksi.php";
    $pathImage="";
    $query  = "select descript from tbl_path where no_path=4";
    $hasil =$konek->query($query );
    $path  = mysqli_query($konek, $query);
    $ketemu = mysqli_num_rows($path);
    $r= mysqli_fetch_array($path);
    $pathImage= $r['descript'];

    $to = $email;
    $subject = '[Notifikasi]Reset Password Admin';
    $message = '<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta charset="utf-8">
						<!--[if lt IE 9]>
						  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
						  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
						<![endif]-->
						<style rel="stylesheet"> 
						 back{padding:1em 0;border-top:1px solid #eee;text-align:right;font-size:11px;}
						</style>
					</head>
					</html>
					<body style="margin: 0; padding: 0; background:#eee; margin-top:50 ">
					 <table align="center" cellpadding="0" cellspacing="0" width="800" style="border-collapse: collapse;  margin-top:50">
					  <tr>
					   <td> 
					        <div class="jumbotron"><img src="'.$pathImage.'" alt="GisthaShop" style="display:bock;" /> </div>
					   </td>
					 </tr>
					 </table>
					 <table align="center" border="0" cellpadding="0" cellspacing="0" width="800" style="border-collapse: collapse;  margin-top:50; background-color:#fff">
					  <tr >
						<td bgcolor="#ffffff" style="padding: 10px 10px 10px 10px;">
						 <table border="0" cellpadding="0" cellspacing="0" width="100%">
						  <tr>
						   <td style="font:1em arial, arial, sans-serif; font-weight:bold; border=1">
							   <p>Konfirmasi Lupa Password</p>
						   </td>
						  </tr> 	  
						  <tr>
						   <td style="padding-top:10px;font:1em arial, arial, sans-serif;">
							   <p>Kepada  '.$email.',</p>
				   <p>Sepertinya Anda lupa password Anda. Tidak apa-apa, Anda dapat megubah password '.$userid;
    $message .='. Jika Anda ingin bertanya, 
					  silahkan hubungi kami! Karena prioritas utama Kami adalah untuk melayani Anda.
				   </p>
				   <table width="100%">
						<tr><td style="padding-top:15px;">Dengan Hormat,</td></tr><tr><td >GisthaOnilineShop</td></tr>
				   </table>
			   </td>
			   </tr>
			 </table>
			</td>
		  </tr>
		  <tr>
			<td style="padding-top:20px;border-top:1px solid #eee;text-align:center">
				  <table  width="100%">
					 <tr><td style="text-align:center;font:0.8em arial, arial, sans-serif">Copyright &copy; 2017 by GisthaShop</td></tr>
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
    //untuk mengirim html email, header Content-type harus diset
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    // Additional header
    $headers .= 'From:gisthaShop@localhost' . "\r\n";
    $headers .= 'Cc: gisthaShop@localhost' . "\r\n";

    $pMail = mail($to, $subject, $message, $headers);
    if($pMail){
        return "succes";
    }else{
        return "error";
    }
}

?>