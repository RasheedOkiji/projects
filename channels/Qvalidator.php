<?php

if(isset($_GET["quote"])){
$quote= $_GET["quote"];

$fq = preg_match("/^[0-9]+\.[0-9]{2}$/", $quote);

if(!$fq) {
  echo "format example: '115.00' ";
}
}
////////
if(isset($_GET["date"])){

$date = $_GET["date"];
$fd = preg_match("/^[0-9]{2}\/([0-9]{2})\/[0-9]{4}$/", $date);
if(!$fd) {
  echo "format:(dd/mm/yyyy)";
}
}
////////
if(isset($_GET["time"])){

$time = $_GET["time"];
$ft = preg_match("/^[0-2]|[1-9]:[0-5][0-9][AaPp][Mm]$/", $time);
if(!$ft) {
  echo "format example: '9:00am'";
}
}
?>