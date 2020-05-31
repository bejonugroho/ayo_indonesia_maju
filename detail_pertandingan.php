<?php
include 'header.php';
include 'sidebar.php';

$view = isset($_GET['view'])? $_GET['view']:null;
switch($view){
    default;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Hasil pertandingan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Hasil Pertandingan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail Hasil Pertandingan</h3>
              </div>
              <?php
              $id = $_GET['id'];
                $sql="SELECT id_tim,id_tim_2 from jadwal where id='$id'";
                $query=mysqli_query($konek,$sql);
                $row1 = mysqli_fetch_array($query);
                ?>
              <!-- /.card-header -->
              <div class="col-3">
              <div class="card-footer">
                  <a href="detail_pertandingan.php?view=tambah&id=<?php echo $_GET['id']; ?>&id_tim=<?php echo $row1['id_tim']; ?>&id_tim_2=<?php echo $row1['id_tim_2']; ?>">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                    </a>
                </div>
            </div>
              <div class="card-body">
              <?php
              $id = $_GET['id'];
                $sql="SELECT detail_jadwal.*,tbl_pemain.nama_pemain,tbl_informasi_tim.nama_tim FROM detail_jadwal inner join tbl_pemain on tbl_pemain.id = detail_jadwal.gol inner join tbl_informasi_tim on tbl_informasi_tim.id = detail_jadwal.id_tim WHERE detail_jadwal.id_jadwal='$id' 
                ORDER BY id ASC";
                $query=mysqli_query($konek,$sql);
            
                ?>
             
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Skor</th>
                    <th>Gol</th>
                    <th>Tim</th>
                    <th>Waktu Gol</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php
                    $no=1;
                while ($row = mysqli_fetch_array($query)){
                 
                  echo'    
                 <tr>
                    <td>'.$no.'</td>
                    <td>'.$row['skor'].'</td>
                    <td>'.$row['nama_pemain'].'</td>
                    <td>'.$row['nama_tim'].'</td>
                    <td>'.$row['waktu_gol'].'</td>
                    <td><a href="detail_pertandingan.php?view=edit&id='.$row['id'].'&id_tim='.$row1['id_tim'].'&id_tim_2='.$row1['id_tim_2'].'" class="btn btn-warning">Edit </a><a href="action.php?act=delete_skor&id_jadwal='.$row['id_jadwal'].'&id='.$row['id'].'" class="btn btn-primary">Delete </a>
                   </td>
                  </tr>';
                  $no++;
                }
         
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <?php
	  break;	  
	  case "tambah":
	  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Informasi Pemain</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Pertandingan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail hasil Pertandingan Tim Sepak Bola</h3>
              </div>
              <!-- /.card-header -->
            
              <div class="card-body">
              <!-- form start -->
              <form role="form" action="action.php" method="post" >
              <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">    
              <input type="hidden" name="type" value="tambah_detail_pertandingan">
             
                <div class="card-body">
                <div class="form-group">
                  <label for="nama_tim">Nama Tim</label>
                    <select name="id_tim" id="id_tim" class="form-control s2" >
                    <option value="">-Pilih-</option>
                    <?php 
                    $idt=$_GET['id_tim'];
                    $idt2=$_GET['id_tim_2'];
                    $sql=mysqli_query($konek,"SELECT nama_tim,id FROM tbl_informasi_tim WHERE id='$idt' OR id='$idt2'");
                    while($data=mysqli_fetch_array($sql)){
                    ?>
                      <option value="<?=$data['id'] ?>"><?=$data['nama_tim'] ?></option>
                      <?php
                    }
                    ?>
                    </select>
                    
                </div>
                
                  <div class="form-group">
                    <label for="exampleInputNamaTim">Skor</label>
                    <input type="text" class="form-control" id="skor" placeholder="Masukan hasil skor" name="skor">
                  </div>

                <div class="form-group">
                  <label for="nama_tim">Nama Pencetak Gol</label>&nbsp;<a href="javascript:void(0);" style="display:none;" id="tp" class="btn btn-primary">Tambah Pemain</a>
                    <select name="id_pemain" id="id_pemain" class="form-control s2">
                    
                    </select>
                    </div>
                
                  <div class="form-group">
                    <label for="exampleInputKota">Waktu Gol Tercipta</label>
                    <input type="number" class="form-control" id="waktu_gol" placeholder="masukan menit tercipta gol" name="waktu_gol">
                  </div>
                 </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
	  break;	  
      case "edit":
        
    $data = mysqli_query($konek,"SELECT * FROM  detail_jadwal WHERE id=".$_GET['id']."");
    $row=mysqli_fetch_array($data);

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Informasi Detail pertandingan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Petandingan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Informasi Detail Pertandingan</h3>
              </div>
              <!-- /.card-header -->
            
              <div class="card-body">
              <!-- form start -->
              <form role="form" action="action.php" method="post" >
              <input type="hidden" name="type" value="update_skor">
              <input type="hidden" name="id" value="<?php echo $row['id'];?>">
              <input type="hidden" name="id_jadwal" value="<?php echo $row['id_jadwal'];?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputNamaTim">Skor</label>
                    <input type="text" class="form-control" id="skor" placeholder="Masukan skor" name="skor" value="<?php echo $row['skor'];?>">
                  </div>
                  <div class="form-group">
                  <label for="nama_tim">Nama Tim</label>
                    <select name="id_tim" id="id_tim" class="form-control s2" >
                    <option value="">-Pilih-</option>
                    <?php 
                    $idt=$_GET['id_tim'];
                    $idt2=$_GET['id_tim_2'];
                    $sql=mysqli_query($konek,"SELECT nama_tim,id FROM tbl_informasi_tim WHERE id='$idt' OR id='$idt2'");
                    while($data=mysqli_fetch_array($sql)){
                    ?>
                      <option <?php if($data['id'] == $row['id'] ){ echo "selected";} ?> value="<?=$data['id'] ?> "><?=$data['nama_tim'] ?></option>
                      <?php
                    }
                    ?>
                    </select>
                    
                </div>
                <div class="form-group">
                  <label for="nama_tim">Nama Pencetak Gol</label>&nbsp;<a href="javascript:void(0);" style="display:none;" id="tp" class="btn btn-primary">Tambah Pemain</a>
                    <select name="id_pemain" id="id_pemain" class="form-control s2">
                    
                    </select>
                    </div>
                 
                  <div class="form-group">
                    <label for="exampleInputKota">Waktu Gol tercipta</label>
                    <input type="text" class="form-control" id="waktu_gol" placeholder="masukan waktu" name="waktu_gol" value="<?php echo $row['waktu_gol'];?>">
                  </div>
                 </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
	  break;
	  }

include 'footer.php';
?>  
