<?php 
	include 'head.php'; 


  if(!empty($_GET['nrp']))
  {

    try {
      $query = "select * from mhs where nrp = :nrp";
      $execute =  $my_koneksi->prepare($query);
      $execute->bindValue(':nrp',$_GET['nrp']); 
      $execute->execute();

    } catch (PDOException $e) {
      die("Error: ".$e->getMessage());
    }
    $mhs = $execute->fetch();

  }

	if($_POST)
	{

    if(empty($_GET['nrp']))
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
    }else{
      try {
        $qry = 'UPDATE mhs SET         
                        nama = :nama,        
                        password = :password,    
                        jk = :jk,     
                        aktif = :aktif,    
                        agama = :agama    
                WHERE nrp = :nrp'; 
        $s = $my_koneksi->prepare($qry); 
        $s->bindValue(':nama',$_POST['nama']); 
        $s->bindValue(':password',$_POST['password']); 
        $s->bindValue(':jk',$_POST['jk']); 
        $s->bindValue(':aktif', ($_POST['status'] == 'on') ? 1 : 0 ); 
        $s->bindValue(':agama',$_POST['agama']); 
        $s->bindValue(':nrp',$_POST['nrp']); 

        $rowCount = $s->execute(); 
        $s->closeCursor();

        header('Location: index.php');

      } catch (PDOException $e) {
        die("Error: ".$e->getMessage());
      }

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
            <input type="text" name="nrp" <?php echo (!empty($mhs['nrp'])) ? "readonly": ""; ?> value="<?php echo (!empty($mhs['nrp'])) ? $mhs['nrp'] : ""; ?>" class="form-control" id="nrp" placeholder="Nrp">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" name="nama" value="<?php echo (!empty($mhs['nama'])) ? $mhs['nama'] : ""; ?>" class="form-control" id="name" placeholder="Nama">
          </div>
        </div>
        <div class="form-group">
          <label for="agama" class="col-sm-2 control-label">Agama</label>
          <div class="col-sm-10">

            <select name="agama" class="form-control" id="agama">
                <option>Pilih salah satu</option>
                <option <?php echo (!empty($mhs['agama']) && $mhs['agama'] == "Islam") ? "selected" : ""; ?> value="Islam">Islam</option>
                <option <?php echo (!empty($mhs['agama']) && $mhs['agama'] == "Kristen") ? "selected" : ""; ?> value="Kristen">Kristen</option>
                <option <?php echo (!empty($mhs['agama']) && $mhs['agama'] == "Hindu") ? "selected" : ""; ?> value="Hindu">Hindu</option>
                <option <?php echo (!empty($mhs['agama']) && $mhs['agama'] == "Budha") ? "selected" : ""; ?> value="Budha">Budha</option>
            </select>

          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" name="password" value="<?php echo (!empty($mhs['password'])) ? $mhs['password'] : ""; ?>" class="form-control" id="password" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <label  class="col-sm-2 control-label">Jenis Kelamin</label>
          <div class="col-sm-10">
            <input type="radio" name="jk" value="l" <?php echo (!empty($mhs['jk']) && $mhs['jk'] == "l") ? "checked" : ""; ?>> Laki - Laki &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="jk" value="p" <?php echo (!empty($mhs['jk']) && $mhs['jk'] == "p") ? "checked" : ""; ?>> Perempuan
          </div>
        </div>
        <div class="form-group">
          <label for="status" class="col-sm-2 control-label">Status</label>
          <div class="col-sm-10">
            <input type="checkbox" name="status" id="status" <?php echo (!empty($mhs['aktif']) && $mhs['aktif'] == 1) ? "checked" : ""; ?>>
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
