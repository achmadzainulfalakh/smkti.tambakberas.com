<?php
/*
file ini digunakan untuk remote database
Nama File: index.php
Path: gallery\index.php
Versi: 1
Email: Kesatrianglungupertama@gmailcom
Deskripsi:
- Api ini akan menampilkan semua nama file foto dari database db_mygallery_api
Database SQL:
Create database db_mygallery_api;
create table mygallery(id int(11) auto_increment primary key,name varchar(100), link varchar(100) );
*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = "localhost";
$user = "root";
$pw = "";
$db = "smkti";

$con = new mysqli($host,$user,$pw,$db);
//$con = mysql_connect($host, $user, $pw) or die("Koneksi ke database gagal!");
//mysql_select_db($db, $con) or die("Tidak ada database yang dipilih!");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
$con->query("SET CHARACTER SET utf8");
$con->query("SET NAMES 'utf8'");

$action = $_GET["action"];
 
switch ($action) 

{
	//menampilkan foto dalam tabel mygallery
	Case "GetPhotos":
		$q = $con->query("SELECT * FROM mygallery");
		$rows = array();
		while($r = mysqli_fetch_assoc($q))
		{
			$rows[] = $r;
		}
		print json_encode($rows);
		$con->close();
	break;
	//menampilkan foto dalam tabel mygallery terpublis
	Case "GetPublishedPhotos":
		$q = $con->query("SELECT * FROM mygallery where publish=1");
		$rows = array();
		while($r = mysqli_fetch_assoc($q))
		{
			$rows[] = $r;
		}
		print json_encode($rows);
		$con->close();
	break;
	//menampilkan foto dalam tabel mygallery tak terpublis
	Case "GetNotPublishedPhotos":
		$q = $con->query("SELECT * FROM mygallery where publish=0");
		$rows = array();
		while($r = mysqli_fetch_assoc($q))
		{
			$rows[] = $r;
		}
		print json_encode($rows);
		$con->close();
	break;
}