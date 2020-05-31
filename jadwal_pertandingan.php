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
            <h1>Informasi Jadwal Pertandingan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Jadwal Pertandingan</li>
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
                <h3 class="card-title">Informasi Jadwal Pertandingan</h3>
              </div>
              <!-- /.card-header -->
              <div class="col-3">
              <div class="card-footer">
                  <a href="jadwal_pertandingan.php?view=tambah">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                    </a>
                </div>
                <div class="card-footer">
                <form method="post" action="jadwal_pertandingan.php" id="form">
                    <select name="nama_tim" id="nama_tim" class="form-control"  onchange="myFunction()">
                    <option value="">Pilih</option>
                    <?php 
                    $sql=mysqli_query($konek,"SELECT id,nama_tim FROM tbl_informasi_tim ORDER BY id ASC");
                    while($data=mysqli_fetch_array($sql)){
                    ?>
                      <option value="<?=$data['id'] ?>"><?=$data['nama_tim'] ?></option>
                      <?php
                    }
                    ?>
                    </select>
                    </form>
                </div>
            </div>
              <div class="card-body">
              <?php

                if(isset($_POST['nama_tim'])){

                    $tambah="where id_tim=".$_POST['nama_tim'];

                }else{
                    $tambah="where id_tim=''";
                }

                $sql='SELECT * FROM jadwal '.$tambah.' ORDER BY id ASC';
                $query=mysqli_query($konek,$sql);
                ?>
             
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tgl Pertandingan</th>
                    <th>Home</th>
                    <th>Away</th>
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
                    <td>'.$row['tgl_pertandingan'].'</td>
                    <td>'.$row['home'].'</td>
                    <td>'.$row['away'].'</td>
                    
                    <td><a href="jadwal_pertandingan.php?view=edit&id='.$row['id'].'" class="btn btn-warning">Edit </a><a href="action.php?act=delete_jadwal&id='.$row['id'].'" class="btn btn-primary">Delete </a>
                    <a href="detail_pertandingan.php?id='.$row['id'].'" class="btn btn-success">Details </a></td>
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
            <h1>Jadwal Pertandingan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Jadwal Pertandingan</li>
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
                <h3 class="card-title">Jadwal Pertandingan Tim Sepak Bola</h3>
              </div>
              <!-- /.card-header -->
            
              <div class="card-body">
              <!-- form start -->
              <form role="form" action="action.php" method="post" >
              <input type="hidden" name="type" value="tambah_jadwal">
                <div class="card-body">
                  <div class="form-group">
                    <label for="tgl">Tanggal Pertandingan</label>
                    <input type="text" class="form-control" id="tgl" name="tgl" placeholder="yyyy-mm-dd hh:mm:ss">
                  </div>
                  
                  <div class="form-group">
                  <label for="nama_tim">Nama Tim</label>
                    <select name="id_tim" id="nama_tim" class="form-control s2"  onchange="myFunction()">
                    <?php 
                    $sql=mysqli_query($konek,"SELECT id,nama_tim FROM tbl_informasi_tim ORDER BY id ASC");
                    while($data=mysqli_fetch_array($sql)){
                    ?>
                      <option value="<?=$data['id'] ?>"><?=$data['nama_tim'] ?></option>
                      <?php
                    }
                    ?>
                    </select>
                    
                </div>
                <div class="form-group">
                <label for="tgl">Status</label>
                <select name="status" id="status" class="form-control">
                      <option value="">Pilih</option>
                      <option value="1">Home</option>
                      <option value="2">Away</option>
                    </select>
                    </div>
                  <div class="form-group" style="display:none;" id="h">
                    <label for="exampleInputtahun">Home Tim</label>
                    <input type="text" class="form-control" id="home" placeholder="Masukan tim home" name="home">
                  </div>
                  <div class="form-group" style="display:none;" id="a">
                    <label for="exampleInputAlamat">Away Tim</label>
                    <input type="text" class="form-control" id="away" placeholder="masukan tim away" name="away">
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
        
    $data = mysqli_query($konek,"SELECT * FROM  jadwal WHERE id=".$_GET['id']."");
    $row=mysqli_fetch_array($data);

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jadwal Pertandingan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Jadwal Pertandingan</li>
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
                <h3 class="card-title">Jadwal Pertandingan Tim Sepak Bola</h3>
              </div>
              <!-- /.card-header -->
            
              <div class="card-body">
              <!-- form start -->
              <form role="form" action="action.php" method="post">
              <input type="hidden" name="type" value="update_jadwal">
              <input type="hidden" name="id" value="<?php echo $row['id'];?>">
              <input type="hidden" name="id_tim" id="nama_tim" value="<?php echo $row['id_tim'];?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputNamaTim">Tanggal Pertandingan</label>
                    <input type="text" class="form-control" id="tgl_pertandingan" placeholder="Masukan tanggal pertandingan" name="tgl_pertandingan" value="<?php echo $row['tgl_pertandingan'];?>">
                  </div>
                  <div class="form-group">
                <label for="tgl">Status</label>
                <select name="status" id="status" class="form-control">
                      <option value="">Pilih</option>
                      <option value="1" <?php if ($row['status']==1){echo "selected"; } ?>>Home</option>
                      <option value="2" <?php if ($row['status']==2){echo "selected"; } ?>>Away</option>
                    </select>
                    </div>
                  <div class="form-group" id="h">
                    <label for="exampleInputtahun">Home Tim</label>
                    <input type="text" class="form-control" id="home" name="home" value="<?php echo $row['home']; ?>">
                  </div>
                  <div class="form-group" id="a">
                    <label for="exampleInputAlamat">Away Tim</label>
                    <input type="text" class="form-control" id="away" placeholder="masukan alamat markas" name="away" value="<?php echo $row['away'];?>">
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
