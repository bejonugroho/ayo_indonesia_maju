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
                <h3 class="card-title">Informasi Detail Pemain Sepak Bola</h3>
              </div>
              <!-- /.card-header -->
              <div class="col-3">
              <div class="card-footer">
                  <a href="informasi_pemain.php?view=tambah&id_tim=<?php echo $_GET['id']; ?>">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                    </a>
                </div>
            </div>
              <div class="card-body">
              <?php
              $id = $_GET['id'];
                $sql="SELECT tbl_informasi_tim.nama_tim,tbl_pemain.* FROM tbl_informasi_tim inner join tbl_pemain on tbl_informasi_tim.id=tbl_pemain.id_tim WHERE tbl_pemain.id_tim='$id'
                ORDER BY tbl_pemain.id ASC";
                $query=mysqli_query($konek,$sql);
                ?>
             
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Tim</th>
                    <th>Nama Pemain</th>
                    <th>Tinggi Badan</th>
                    <th>Berat Badan</th>
                    <th>Posisi Pemain</th>
                    <th>Nomor Punggung</th>
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
                    <td>'.$row['nama_pemain'].'</td>
                    <td>'.$row['tinggi_badan'].'</td>
                    <td>'.$row['berat_badan'].'</td>
                    <td>'.$row['posisi_pemain'].'</td>
                    <td>'.$row['nomor_punggung'].'</td>
                    <td><a href="informasi_pemain.php?view=edit&id='.$row['id'].'" class="btn btn-warning">Edit </a><a href="action.php?act=delete_pemain&id_tim='.$row['id_tim'].'&id='.$row['id'].'" class="btn btn-primary">Delete </a>
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
              <li class="breadcrumb-item active">Informasi Pemain</li>
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
                <h3 class="card-title">Informasi Pemain Tim Sepak Bola</h3>
              </div>
              <!-- /.card-header -->
            
              <div class="card-body">
              <!-- form start -->
              <form role="form" action="action.php" method="post" >
              <input type="hidden" name="id_tim" value="<?php echo $_GET['id_tim'];?>">    
              <input type="hidden" name="type" value="tambah_pemain">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputNamaTim">Nama Pemain</label>
                    <input type="text" class="form-control" id="nama_pemain" placeholder="Masukan nama pemain" name="nama_pemain">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputtahun">Tinggi Badan</label>
                    <input type="number" class="form-control" id="tinggi_badan" placeholder="Masukan tinggi badan" name="tinggi_badan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAlamat">Berat Badan</label>
                    <input type="number" class="form-control" id="berat_badan" placeholder="masukan berat badan" name="berat_badan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputKota">Posisi Pemain</label>
                    <select name="posisi_pemain" id="posisi_pemain" class="form-control">
                      <option value="Penyerang">Penyerang</option>
                      <option value="Gelandang">Gelandang</option>
                      <option value="Bertahan">Bertahan</option>
                      <option value="Penjaga Gawang">Penjaga Gawang</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputKota">Nomor Punggung</label>
                    <input type="number" class="form-control" id="nomor_punggung" placeholder="masukan nomor punggung" name="nomor_punggung">
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
        
    $data = mysqli_query($konek,"SELECT * FROM  tbl_pemain WHERE id=".$_GET['id']."");
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
              <li class="breadcrumb-item active">Informasi Pemain</li>
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
                <h3 class="card-title">Informasi Pemain Sepak Bola</h3>
              </div>
              <!-- /.card-header -->
            
              <div class="card-body">
              <!-- form start -->
              <form role="form" action="action.php" method="post" >
              <input type="hidden" name="type" value="update_pemain">
              <input type="hidden" name="id" value="<?php echo $row['id'];?>">
              <input type="hidden" name="id_tim" value="<?php echo $row['id_tim'];?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputNamaTim">Nama Pemain</label>
                    <input type="text" class="form-control" id="nama_pemain" placeholder="Masukan nama pemain" name="nama_pemain" value="<?php echo $row['nama_pemain'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputtahun">Tinggi Badan</label>
                    <input type="number" class="form-control" id="tinggi_badan" placeholder="YYYY" name="tinggi_badan" value="<?php echo $row['tinggi_badan'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAlamat">Berat Badan</label>
                    <input type="text" class="form-control" id="berat_badan" placeholder="masukan alamat markas" name="berat_badan" value="<?php echo $row['berat_badan'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputKota">Posisi Pemain</label>
                    <select name="posisi_pemain" id="posisi_pemain" class="form-control">
                      <option <?php if($row['posisi_pemain'] == "Penyerang" ){ echo "selected";} ?> value="Penyerang">Penyerang</option>
                      <option <?php if($row['posisi_pemain'] == "Gelandang" ){ echo "selected";} ?> value="Gelandang">Gelandang</option>
                      <option <?php if($row['posisi_pemain'] == "Bertahan" ){ echo "selected";} ?> value="Bertahan">Bertahan</option>
                      <option <?php if($row['posisi_pemain'] == "Penjaga Gawang" ){ echo "selected";} ?> value="Penjaga Gawang">Penjaga Gawang</option>
                    </select>
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputKota">Nomor Punggung</label>
                    <input type="text" class="form-control" id="nomor_punggung" placeholder="masukan kota markas" name="nomor_punggung" value="<?php echo $row['nomor_punggung'];?>">
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
