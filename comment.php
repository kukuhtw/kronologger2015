<?
$sqlcomment ="";
$sqlcomment = " select   commentid , msgid, contentcomment, commentdate ";
$sqlcomment = $sqlcomment. " from comment ";
$sqlcomment = $sqlcomment. " where 1=1 ";
$sqlcomment = $sqlcomment. " and msgid='$msgid' ";
$sqlcomment = $sqlcomment. " order by commentid asc ";
//echo "<br>sql = ".$sqlcomment;
$execute_1 = mysql_query($sqlcomment) or die('Error, pada waktu retrieve data!');
      $jumlahcomment=0;
      while($rowcomment = mysql_fetch_array($execute_1))
      {
          $jumlahcomment=$jumlahcomment+1;
          $commentid=$rowcomment['commentid'];
          $contentcomment=$rowcomment['contentcomment'];
          $commentdate=$rowcomment['commentdate'];
          $month_comment = substr($commentdate,5,2);
          $day_comment = substr($commentdate,8,2);
          $year_comment = substr($commentdate,0,4);
          $hour_comment = substr($commentdate,11,2);
          $minute_comment = substr($commentdate,14,2);
          $second_comment= substr($commentdate,17,2);
          $tt_comment=floor((time()-mktime($hour_comment,$minute_comment,$second_comment,$month_comment,$day_comment,$year_comment))/1);
          $keteranganwaktu_comment = time_left($tt_comment);
          $zonawaktujakarta_comment = tampilkanconverzonawaktu($commentdate);
?>
<p class="animated infinite shake" align="right"><i>
<? echo $contentcomment ?></i>
<br><small><? echo $keteranganwaktu_comment ?></small>
</p>
      <?
      }
    if ($jumlahcomment<=15) {
?>
<form method="post" action="#msgid<? echo $msgid ?>">
<p align="right">
 Comment : <input type="text" name="commentuser" maxlength="140" size="20" >
 <input type="hidden" name="idpesan" value="<? echo $msgid ?>">
 <input type="hidden" name="mode" value="postcomment">
 <button type="submit" class="btn btn-primary">Post Comment</button>
 </form>
 <?
    } // tutup if jumlahcomment
    else {
    ?>
    <p align="right">Now, Comments is closed, Sorry, Maximum Comment is only 15 comments;
    <?
    }
?>