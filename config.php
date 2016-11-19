<?php
	$alamat_server = 'localhost';
	$nama_database = 'stiki';
	$user_database = 'root';
	$pass_database = '';
	$data_server   = "mysql:host=$alamat_server;".
					 "dbname=$nama_database";
	try {
		$my_koneksi = new PDO($data_server,$user_database,$pass_database);	
		$my_koneksi->setAttribute(
			PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}  catch (PDOException $e) {		
		echo "Error: ".$e->getMessage();
		die();
	}
?>