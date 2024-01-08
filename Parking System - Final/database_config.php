<?php
$__servername = " sql109.epizy.com ";
$__username = "epiz_30912367";
$__password = "DFM88sGcfC8njIm";
$__dbname = "epiz_30912367_examinner";
$__page_error = "";

try {
  $__conn = new mysqli($__servername, $__username, $__password, $__dbname);
}
catch (mysqli_sql_exception $__e) {
    $_redtitle = 'Database Not Connected'; 
    $_redmsg = 'This happend sometime when server is down or database is not operational.'; 
    header("location:./redirect.php?title=$_redtitle&msg=$_redmsg");
    return;
}
?>