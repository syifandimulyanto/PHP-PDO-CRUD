<?php 
	include 'head.php'; 

  try {
    $id = $_GET['nrp'];
    $query = "select * from mhs where nrp = '".$id."'";
    $execute =  $my_koneksi->prepare($query);
    $execute->execute();
          
  } catch (PDOException $e) {
    die("Error: ".$e->getMessage());
  }
  $mhs = $execute->fetchAll();


	if($_POST)
	{
		try {

			$qry = 'INSERT INTO mhs (nrp, nama, password, jk, aktif, agama) VALUES (:nrp, :nama, :password, :jk, :status, :agama)'; 
			$s = $my_koneksi->prepare($qry); 
			$s->bindValue(':nrp',$_POST['nrp']); 
      $s->bindValue(':nama',$_POST['nama']); 
      $s->bindValue(':password',$_POST['password']); 
      $s->bindValue(':jk',$_POST['jk']); 
			$s->bindValue(':status', ($_POST['status'] == 'on') ? 1 : 0 ); 
      $s->bindValue(':agama',$_POST['agama']); 

			$rowCount = $s->execute(); 
			$s->closeCursor();

      header('Location: index.php');

		} catch (PDOException $e) {
			die("Error: ".$e->getMessage());
		}
	}
?>

<div class="container">
  <h1>Tambah Mahasiswa</h1>
  <div class="row">
    <div class="col-sm-10">
      <form class="form-horizontal" method="POST" action="">
        <div class="form-group">
          <label for="nrp" class="col-sm-2 control-label">NRP</label>
          <div class="col-sm-10">
            <input type="text" name="nrp" class="form-control" id="nrp" placeholder="Nrp">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" name="nama" class="form-control" id="name" placeholder="Nama">
          </div>
        </div>
        <div class="form-group">
          <label for="agama" class="col-sm-2 control-label">Agama</label>
          <div class="col-sm-10">
            <input type="text" name="agama" class="form-control" id="agama" placeholder="Agama">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <label  class="col-sm-2 control-label">Jenis Kelamin</label>
          <div class="col-sm-10">
            <input type="radio" name="jk" value="l"> Laki - Laki &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="jk" value="p"> Perempuan
          </div>
        </div>
        <div class="form-group">
          <label for="status" class="col-sm-2 control-label">Status</label>
          <div class="col-sm-10">
            <input type="checkbox" name="status" id="status">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-default">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
