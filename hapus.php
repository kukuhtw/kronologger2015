<?
include("db.php");
include("function.php");

$sql = " delete from shout where lat_shout like '0.00000%' and lon_shout like '0.0000%'";
 $execute1 = mysql_query($sql) or die('Error, pada waktu kirim posting');
               $errorUpload="<script>alert('hapus !!!!')</script>";
                 echo $errorUpload;
?>