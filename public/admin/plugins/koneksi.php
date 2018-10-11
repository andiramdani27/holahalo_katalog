<?php
$server		=	"mysql.idhostinger.com";
$username	=	"u787757767_ukm";
$password	=	"2431andi";
$database	=	"u787757767_ukm";

//koneksi dan memilih database di server

mysql_connect($server,$username,$password) or die ("koneksi gagal");
mysql_select_db($database) or die ("Database tidak bisa dibuka");

?>