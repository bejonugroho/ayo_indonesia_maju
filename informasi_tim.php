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
            <h1>Informasi Team</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Informasi Team</li>
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
                <h3 class="card-title">Informasi Tim Sepak Bola</h3>
              </div>
              <!-- /.card-header -->
              <div class="col-3">
              <div class="card-footer">
                  <a href="informasi_tim.php?view=tambah">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                    </a>
                </div>
            </div>
              <div class="card-body">
              <?php
                $sql='SELECT * FROM tbl_informasi_tim ORDER BY id ASC';
                $query=mysqli_query($konek,$sql);
                ?>
             
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Tim</th>
                    <th>Logo Tim</th>
                    <th>Tahun Berdiri</th>
                    <th>Alamat Markas Tim</th>
                    <th>Kota Markas Tim</th>
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
                    <td>'.$row['nama_tim'].'</td>
                    <td><img src="image/'.$row['logo_tim'].'" style="width:50px;height:50px;"></td>
                    <td>'.$row['tahun_berdiri'].'</td>
                    <td>'.$row['alamat_markas'].'</td>
                    <td>'.$row['kota_markas'].'</td>
                    <td><a href="informasi_tim.php?view=edit&id='.$row['id'].'" class="btn btn-warning">Edit </a><a href="action.php?act=delete&id='.$row['id'].'" class="btn btn-primary">Delete </a>
                    <a href="informasi_pemain.php?id='.$row['id'].'" class="btn btn-success">Details </a></td>
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
            <h1>Informasi Team</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Informasi Team</li>
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
                <h3 class="card-title">Informasi Tim Sepak Bola</h3>
              </div>
              <!-- /.card-header -->
            
              <div class="card-body">
              <!-- form start -->
              <form role="form" action="action.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="type" value="tambah_informasi">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputNamaTim">Nama Tim</label>
                    <input type="text" class="form-control" id="nama_tim" placeholder="Masukan nama tim" name="nama_tim">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Logo Tim</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="logo_tim" name="logo_tim">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputtahun">Tahun Berdiri</label>
                    <input type="number" class="form-control" id="tahun_berdiri" placeholder="YYYY" name="tahun_berdiri">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAlamat">Alamat Markas</label>
                    <input type="text" class="form-control" id="alamat_markas" placeholder="masukan alamat markas" name="alamat_markas">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputKota">Kota Markas</label>
                    <input type="text" class="form-control" id="kota_markas" placeholder="masukan kota markas" name="kota_markas">
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
        
    $data = mysqli_query($konek,"SELECT * FROM  tbl_informasi_tim WHERE id=".$_GET['id']."");
    $row=mysqli_fetch_array($data);

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Informasi Team</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Informasi Team</li>
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
                <h3 class="card-title">Informasi Tim Sepak Bola</h3>
              </div>
              <!-- /.card-header -->
            
              <div class="card-body">
              <!-- form start -->
              <form role="form" action="action.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="type" value="update_informasi">
              <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputNamaTim">Nama Tim</label>
                    <input type="text" class="form-control" id="nama_tim" placeholder="Masukan nama tim" name="nama_tim" value="<?php echo $row['nama_tim'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Logo Tim</label>
                    <?php
                            $image=$row['logo_tim'];
                            $filepath='image/'.$image.'';
                            echo '<img src="'.$filepath.'" style=height:150px;width:150px;>'
                        ?>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="hidden" name="nama_file" value="<?php echo $image; ?>">
                        <input type="file" class="custom-file-input" id="logo_tim" name="logo_tim" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputtahun">Tahun Berdiri</label>
                    <input type="number" class="form-control" id="tahun_berdiri" placeholder="YYYY" name="tahun_berdiri" value="<?php echo $row['tahun_berdiri'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAlamat">Alamat Markas</label>
                    <input type="text" class="form-control" id="alamat_markas" placeholder="masukan alamat markas" name="alamat_markas" value="<?php echo $row['alamat_markas'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputKota">Kota Markas</label>
                    <input type="text" class="form-control" id="kota_markas" placeholder="masukan kota markas" name="kota_markas" value="<?php echo $row['kota_markas'];?>">
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
