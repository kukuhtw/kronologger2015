<script>
<?
$host="http://localhost/";
$hostfoldername="ruasjalan_apikronologger";
$hostAPI_updateKron = "http://localhost/kronologger2015/API/updateKron";
$url_refresh="index.php";
$appid="1";
$secretkey="Demo";

$cookies_php_lat = $_COOKIE['latitude-cookies'];
$cookies_php_lon = $_COOKIE['longitude-cookies'];
 if ($cookies_php_lat=="" && $cookies_php_lon=="") {
        ?>
      window.location = "<?php echo $url_refresh ?>"
       <?
      }
?>
</script>
<?
   $mode=$_POST['mode'];
  ;



   if ($mode=="updatestatus") {


     $contentKron=$_POST['content'];
    $passwordcode=$_POST['passwordcode'];
    $fileUpload =  $_FILES['fileUpload'];


    $fileUpload = array(
    basename($_FILES['fileUpload']['name']),
    $_FILES['fileUpload']['type'],
    $_FILES['fileUpload']['tmp_name'],
    $_FILES['fileUpload']['error'],
    $_FILES['fileUpload']['size']
    );

   // $encodedData = array('document[attached_file]' => "@$_FILES['fileUpload']['tmp_name']", 'document[file_name]'=>$_FILES['fileUpload']['name']);

    $headers = array("Content-Type:multipart/form-data");
    echo "<br>fileUpload_empty = ".empty($fileUpload);
    echo "<br>fileupload[name] = ".  basename($_FILES['fileUpload']['name']);
    echo "<br>fileupload[type] = ".  $_FILES['fileUpload']['type'];
    echo "<br>fileupload[tmp_name] = ".  $_FILES['fileUpload']['tmp_name'];
    echo "<br>fileupload[error] = ".  $_FILES['fileUpload']['error'];
    echo "<br>fileupload[size] = ".  $_FILES['fileUpload']['size'];
    echo "<br>fileUpload = ".  $fileUpload;

             $dataupdateKron= array("appid" => "$appid",
      "secretkey" => "$secretkey" ,
        "lat" => "$cookies_php_lat" ,
         "lon" => "$cookies_php_lon" ,
        "contentKron" => "$contentKron" ,
         "passwordInput" => "$passwordcode" ,
        "fileUpload" =>  $fileUpload
       );

      echo "<br>dataupdateKron = ".$dataupdateKron;



      $ch_updatestatus = curl_init($hostAPI_updateKron);
       curl_setopt($ch_updatestatus, CURLOPT_HEADER, true);
       curl_setopt($ch_updatestatus, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch_updatestatus, CURLOPT_FILETIME, true);
       curl_setopt($ch_updatestatus, CURLOPT_URL, $hostAPI_updateKron);
       curl_setopt($ch_updatestatus, CURLOPT_POST, 1);
        curl_setopt($ch_updatestatus, CURLOPT_CUSTOMREQUEST, "POST");
       curl_setopt($ch_updatestatus, CURLOPT_POSTFIELDS, $dataupdateKron);
        curl_setopt($ch_updatestatus, CURLOPT_ENCODING, '');
        curl_setopt($ch_updatestatus, CURLOPT_RETURNTRANSFER, true);

        $result_updatestatus = curl_exec($ch_updatestatus);
        echo "<br>result2 = ".  $result_updatestatus;
        $json_updatestatus = json_decode($result_updatestatus,true);
        echo "<br>json2 = ".  $json_updatestatus;

          /*
        $output_updatestatus="";
         foreach ($json_updatestatus as $result_updatestatus) {
          $status = $result_updatestatus['status'];
          $msg = $result_updatestatus['msg'];
           $output_updatestatus .= "<br>";
           $output_updatestatus .= "<br>Status : ".$status;
           $output_updatestatus .= "<br>Messages : ".$msg;
         }
         */

   } // tutup if mode=updatestatus

   echo $output_updatestatus;

?>
<p>&nbsp;</p>
<br>Lat : <? echo $cookies_php_lat ?>
<br>Lon : <? echo $cookies_php_lon ?>
<form  enctype="multipart/form-data" name="posting" role="form" method="post" action="" class="form-horizontal" >
<a name="formpost"></a>
  <div class="panel panel-info">
            <div class="panel-heading"><h5 class="panel-title">
             Posting New Messages</h5>
            </div>

              <div class="panel-body">
                    <p><label for="textArea">
                    As a Location Based Sevices for MarketPlace, FileSharing and BulletinBoard,
                    <br>all you can post/write/share here is only will viewable within radius 1 kilometres away</label>
                    <p><textarea name="content" class="form-control" rows="8" cols="30"  id="textArea"></textarea>
           <p>Read This : Type File Attachment allowed are :
           <br><b>image jpg/png/gif ,
           video mp4  , audio mp3, Zip File,
           document pdf/xls/doc/txt/ppt
           <br>Maximum file only 5Mb: </b>
           <br>
           <input class="btn btn-sm btn-default" name="fileUpload" type="file" />

           <p>Do you need password for this file Attachment ?
           <br>if you put password, someone needs to entry password to open this file attachment
           <br>Entry your password here : <input type="password" name="passwordcode">
            <br>Let it blank, if you dont need to protect your file attachment
  </div>

    <input type="hidden" name="mode" value="updatestatus">
<?php
$cookies_php_lat = $_COOKIE['latitude-cookies'];
$cookies_php_lon = $_COOKIE['longitude-cookies'];
    if ($cookies_php_lat==""  || $cookies_php_lon=="") {
      ?>
      <p><a href="index.php">Sorry, button Submit is not available, Please Allow me to detect your location and click this link, or refresh !</a></p>
      <?

    }
    else {

?>

    <p><button type="submit" class="btn btn-primary">Post/Sharing your Info</button></p>
<p>&nbsp;</p>

<?php
    } // tutup if cookies kosong
?>

      </div>

    </form>

