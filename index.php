<?php 
	include 'head.php'; 
	
  if(!empty($_GET['nrp']))
  {
    try {
      $query = 'DELETE FROM mhs WHERE nrp = :nrp';
      $execute =  $my_koneksi->prepare($query);
      $execute->bindValue(':nrp',$_GET['nrp']); 
      $execute->execute();
      
      header('Location: index.php');

    } catch (PDOException $e) {
      die("Error: ".$e->getMessage());
    }

  }else{
    try {
      $query = "select * from mhs";
      $execute =  $my_koneksi->prepare($query);
      $execute->execute();
            
    } catch (PDOException $e) {
      die("Error: ".$e->getMessage());
    }

    $mhs = $execute->fetchAll();
  }


?>

<div class="container">
  <h1>Data Mahasiswa</h1>
  <div class="row">
    <div class="col-sm-12">
        <a href="create.php" class="btn btn-primary pull-right">Tambah Mahasiswa</a>
        <br> <br>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>NRP</th>
              <th>Nama</th>
              <th>Agama</th>
              <th>Jenis Kelamin</th>
              <th>Password</th>
              <th>Aktif</th>
              <th>Aksi</th>
            </th<>
          </thead>
          <tbody>
            <?php 
              $no = 1;
              foreach ($mhs as $data): 
                $jk     = "";
                $aktif  = "";
                if($data['jk'] == 'l'){
                  $jk = "Laki - Laki";
                }else{
                  $jk = "Perempuan";
                }
                if($data['aktif'] == 1){
                  $aktif = "Iya";
                }else{
                  $aktif = "Tidak";
                }
            ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data['nrp']; ?></td>
                <td><?php echo ucwords($data['nama']); ?></td>
                <td><?php echo $data['agama']; ?></td>
                <td><?php echo $jk; ?></td>
                <td><?php echo $data['password']; ?></td>
                <td><?php echo $aktif; ?></td>
                <td>
                  <a href="<?php echo  'create.php?nrp='.$data['nrp']; ?>" class="btn btn-warning"> Edit </a>
                  <a href="<?php echo  'index.php?nrp='.$data['nrp']; ?>" class="btn btn-success"> Hapus </a>
                </td>
              </tr>
            <?php 
              $no++;
              endforeach; 
            ?>
          </tbody>
        </table>

    </div>
  </div>
</div>
