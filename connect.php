<?php
date_default_timezone_set('Asia/Karachi');
// connection  with database
$connect=mysqli_connect("localhost","root","","health_care");
if(!$connect) {
    die("Not Connected With Database");
}
?>