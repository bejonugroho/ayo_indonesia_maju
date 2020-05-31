<?php
error_reporting(0);
include "inc/koneksi.php";
session_start();
if($_POST['type']=='login'){
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $p    = md5($pass);

        if($email == ''&& $pass==''){
        ?>
        <div class="alert alert-warning"><b>Warning!</b>Form Anda Belum Lengkap</div>
        <?php
        }else{

        $sqlLogin = mysqli_query($konek,"SELECT * FROM tbl_user WHERE email='$email' AND password='$p'");
        $jml = mysqli_num_rows($sqlLogin);
        $d = mysqli_fetch_array($sqlLogin);

        if($jml > 0){

        $_SESSION['login']			= TRUE;
        $_SESSION['id']				= $d['id'];
        $_SESSION['email']	    	= $d['email'];
        $_SESSION['level']	        = $d['level'];

        echo "<script>
        window.location='index.php';
        </script>";
        }else{
        ?>
        <div class="alert alert-danger"><b>ERROR</b>Username dan Password Anda Salah !</div>
        <?php
        }

        }

    }
}
//tambah informasi tim
if($_POST['type']=='tambah_informasi'){
    if(isset($_POST['nama_tim'])){
        $nama_tim =str_replace(" ","",strtoupper($_POST['nama_tim']));
        $nama_file = $nama_tim.".jpg";
        $file_tmp = $_FILES['logo_tim']['tmp_name'];
        move_uploaded_file($file_tmp, 'image/'.$nama_file);	
        $tahun_berdiri = $_POST['tahun_berdiri'];
        $alamat_markas = $_POST['alamat_markas'];
        $kota_markas = $_POST['kota_markas'];

        if($nama_tim == '' && $tahun_berdiri=='' && $alamat_markas=='' && $kota_markas==''){
        ?>
        <div class="alert alert-warning"><b>Warning!</b>Form Anda Belum Lengkap</div>
        <?php
        }else{
            $query =mysqli_query($konek,"INSERT INTO  tbl_informasi_tim (nama_tim,logo_tim,tahun_berdiri,alamat_markas,kota_markas) 
            VALUES('$nama_tim','$nama_file','$tahun_berdiri','$alamat_markas','$kota_markas')");
           
        echo "<script>
        window.location='informasi_tim.php';
       </script>";
       
        }

    }
}
//update informasi tim

if($_POST['type']=='update_informasi'){
    if(isset($_POST['nama_tim'])){
        $id = $_POST['id'];
        $nama_tim =str_replace(" ","",strtoupper($_POST['nama_tim']));
        if(empty($_FILES['logo_tim']['tmp_name'])){
            $nama_file=$_POST['nama_file'];
         }
        else{
        $nama_file = $nama_tim.".jpg";
        $file_tmp = $_FILES['logo_tim']['tmp_name'];
        move_uploaded_file($file_tmp, 'image/'.$nama_file);	
        }
        $tahun_berdiri = $_POST['tahun_berdiri'];
        $alamat_markas = $_POST['alamat_markas'];
        $kota_markas = $_POST['kota_markas'];

        if($nama_tim == '' && $tahun_berdiri=='' && $alamat_markas=='' && $kota_markas==''){
        ?>
        <div class="alert alert-warning"><b>Warning!</b>Form Anda Belum Lengkap</div>
        <?php
        }else{
            
            $query =mysqli_query($konek,"UPDATE tbl_informasi_tim set nama_tim='$nama_tim',logo_tim='$nama_file',tahun_berdiri='$tahun_berdiri',alamat_markas='$alamat_markas',kota_markas='$kota_markas' WHERE id='$id'");
            
        echo "<script>
        window.location='informasi_tim.php';
       </script>";
       
        }

    }
}
//delete informasi tim
if($_GET['act']=='delete'){
$id = $_GET['id'];
$hapus="DELETE FROM tbl_informasi_tim WHERE id='$id'";
mysqli_query($konek,$hapus);

echo "<script>
window.location='informasi_tim.php';
</script>";

}


//tambah detail pemain

function CekNo($konek,$nomor_punggung,$id_tim){
    $sql="SELECT nomor_punggung FROM tbl_pemain WHERE nomor_punggung='$nomor_punggung' AND id_tim='$id_tim'";
    $sql2=mysqli_query($konek,$sql);
    $sql3=mysqli_num_rows($sql2);
    if($sql3==1){
        return true;
    }else{
        return false;
    }
}

if($_POST['type']=='tambah_pemain'){
    if(isset($_POST['nama_pemain'])){
        $id_tim = $_POST['id_tim'];
        $nama_pemain = $_POST['nama_pemain'];
        $berat_badan = $_POST['berat_badan'];
        $tinggi_badan = $_POST['tinggi_badan'];
        $posisi_pemain = $_POST['posisi_pemain'];
        $nomor_punggung = $_POST['nomor_punggung'];



        if($nama_pemain == '' && $berat_badan=='' && $tinggi_badan=='' && $posisi_pemain=='' && $nomor_punggung='' ){
        ?>
        <div class="alert alert-warning"><b>Warning!</b>Form Anda Belum Lengkap</div>
        <?php
        }else{
            if(Cekno($konek,$_POST['nomor_punggung'],$_GET['id_tim'])){             
                echo "<script>
            alert('Maaf no punggung tersebut sudah digunakan !');
            window.location='informasi_pemain.php?view=tambah&id_tim=".$id_tim."';
            </script>";
            }else{
                $nomor_punggung=$_POST['nomor_punggung'];
                //$email=EscapeString($email);
                $query =mysqli_query($konek,"INSERT INTO  tbl_pemain (id_tim,nama_pemain,berat_badan,tinggi_badan,posisi_pemain,nomor_punggung) 
                VALUES('$id_tim','$nama_pemain','$berat_badan','$tinggi_badan','$posisi_pemain','$nomor_punggung')");
               
           echo "<script>
           window.location='informasi_pemain.php?id=".$id_tim."';
           </script>";
           
            }
           
        }

    }
}
//update pemain

if($_POST['type']=='update_pemain'){
    if(isset($_POST['nama_pemain'])){
        $id = $_POST['id'];
        $id_tim = $_POST['id_tim'];
        $nama_pemain = $_POST['nama_pemain'];
        $tinggi_badan = $_POST['tinggi_badan'];
        $berat_badan = $_POST['berat_badan'];
        $posisi_pemain = $_POST['posisi_pemain'];
        $nomor_punggung = $_POST['nomor_punggung'];

        if($nama_pemain == '' && $tinggi_badan=='' && $berat_badan=='' && $posisi_pemain=='' && $nomor_punggung==''){
        ?>
        <div class="alert alert-warning"><b>Warning!</b>Form Anda Belum Lengkap</div>
        <?php
        }else{
            if(Cekno($konek,$_POST['nomor_punggung'])){             
                echo "<script>
            alert('Maaf no punggung tersebut sudah digunakan !');
            window.location='informasi_pemain.php?view=edit&id=".$id."';
            </script>";
            }else{
                $nomor_punggung=$_POST['nomor_punggung'];
                //$email=EscapeString($email);
                $query =mysqli_query($konek,"UPDATE tbl_pemain set id_tim='$id_tim',nama_pemain='$nama_pemain',tinggi_badan='$tinggi_badan',berat_badan='$berat_badan',posisi_pemain='$posisi_pemain',nomor_punggung='$nomor_punggung' WHERE id='$id'");
               
           echo "<script>
           window.location='informasi_pemain.php?id=".$id_tim."';
           </script>";
           
            }
        }

    }
}

//delete pemain
if($_GET['act']=='delete_pemain'){
    $id_tim= $_GET['id_tim'];
    $id = $_GET['id'];
    $hapus="DELETE FROM tbl_pemain WHERE id='$id'";
    mysqli_query($konek,$hapus);
    
    echo "<script>
    window.location='informasi_pemain.php?id=".$id_tim."';
    </script>";
    
    }
    

//tambah jadwal pertandingan

if($_POST['type']=='tambah_jadwal'){
    if(isset($_POST['tgl'])){
        $tgl = $_POST['tgl'];
        $id_tim = $_POST['id_tim'];
        $status = $_POST['status'];
        $home = str_replace(" ","",strtoupper($_POST['home']));
        $away = str_replace(" ","",strtoupper($_POST['away']));
        if($status==1){
            $nt=$away;
        }else{
            $nt=$home;
        }
        $select=mysqli_query($konek,"SELECT id FROM tbl_informasi_tim WHERE nama_tim='$nt'");
        $select2=mysqli_num_rows($select);
        $sel3=mysqli_fetch_assoc($select);
        if($select2==0){
            $insert=mysqli_query($konek,"INSERT INTO tbl_informasi_tim (nama_tim)VALUES ('$nt')");
            $select1=mysqli_query($konek,"SELECT id from tbl_informasi_tim WHERE nama_tim='$nt'");
            $select33=mysqli_fetch_assoc($select1);
            $id_tim_2=$select33['id'];
        }else{
            $id_tim_2=$sel3['id'];
        }
        

        if($tgl == '' && $home=='' && $away==''){
        ?>
        <div class="alert alert-warning"><b>Warning!</b>Form Anda Belum Lengkap</div>
        <?php
        }else{
            
                $query =mysqli_query($konek,"INSERT INTO  jadwal (tgl_pertandingan,id_tim,id_tim_2,status,home,away) 
                VALUES('$tgl','$id_tim','$id_tim_2','$status','$home','$away')");
           
          echo "<script>
           window.location='jadwal_pertandingan.php';
           </script>";
           
            
           
        }

    }
}

//update jadwal pertandingan

if($_POST['type']=='update_jadwal'){
    if(isset($_POST['tgl_pertandingan'])){
        $id = $_POST['id'];
        $id_tim = $_POST['id_tim'];
        $tgl_pertandingan = $_POST['tgl_pertandingan'];
        $status = $_POST['status'];
        $home = str_replace(" ","",strtoupper($_POST['home']));
        $away = str_replace(" ","",strtoupper($_POST['away']));
        if($status==1){
            $nt=$away;
        }else{
            $nt=$home;
        }
        $select=mysqli_query($konek,"SELECT id FROM tbl_informasi_tim WHERE nama_tim='$nt'");
        $select2=mysqli_num_rows($select);
        $sel3=mysqli_fetch_assoc($select);
        if($select2==0){
            $insert=mysqli_query($konek,"INSERT INTO tbl_informasi_tim (nama_tim)VALUES ('$nt')");
            $select1=mysqli_query($konek,"SELECT id from tbl_informasi_tim WHERE nama_tim='$nt'");
            $select33=mysqli_fetch_assoc($select1);
            $id_tim_2=$select33['id'];
        }else{
            $id_tim_2=$sel3['id'];
        }
        

        if($tgl_pertandingan == '' && $home=='' && $away==''){
        ?>
        <div class="alert alert-warning"><b>Warning!</b>Form Anda Belum Lengkap</div>
        <?php
        }else{
                $query =mysqli_query($konek,"UPDATE jadwal set id_tim='$id_tim',id_tim_2='$id_tim_2',tgl_pertandingan='$tgl_pertandingan',status='$status',home='$home',away='$away' WHERE id='$id'");
               
               
           echo "<script>
           window.location='jadwal_pertandingan.php?id=".$id_tim."';
           </script>";
           
        
        }

    }
}


//delete jadwal
if($_GET['act']=='delete_jadwal'){
    $id_tim= $_GET['id_tim'];
    $id = $_GET['id'];
    $hapus="DELETE FROM jadwal WHERE id='$id'";
    mysqli_query($konek,$hapus);
    
    echo "<script>
    window.location='jadwal_pertandingan.php?id=".$id_tim."';
    </script>";
    
    }
  
    
//tambah detail pertandingan

if($_POST['type']=='tambah_detail_pertandingan'){
    if(isset($_POST['skor'])){
        $id_jadwal= $_POST['id'];
        $skor = $_POST['skor'];
        $id_tim = $_POST['id_tim'];
        $id_pemain = $_POST['id_pemain'];
        $waktu_gol = $_POST['waktu_gol'];
       

        if($skor == '' && $id_pemain=='' && $waktu_gol==''){
        ?>
        <div class="alert alert-warning"><b>Warning!</b>Form Anda Belum Lengkap</div>
        <?php
        }else{
            
                $query =mysqli_query($konek,"INSERT INTO  detail_jadwal (id_jadwal,id_tim,skor,gol,waktu_gol) 
                VALUES('$id_jadwal','$id_tim','$skor','$id_pemain','$waktu_gol')");
           
          echo "<script>
          window.location='detail_pertandingan.php?id=".$id_jadwal."';
          </script>";
           
            
           
        }

    }
}


//update jadwal pertandingan

if($_POST['type']=='update_skor'){
    if(isset($_POST['skor'])){
        $id = $_POST['id'];
        $id_jadwal = $_POST['id_jadwal'];
        $id_tim=$_POST['id_tim'];
        $skor = $_POST['skor'];
        $id_pemain = $_POST['id_pemain'];
        $waktu_gol = $_POST['waktu_gol'];
       

        if($skor == '' && $id_pemain=='' && $waktu_gol==''){
        ?>
        <div class="alert alert-warning"><b>Warning!</b>Form Anda Belum Lengkap</div>
        <?php
        }else{
                $query =mysqli_query($konek,"UPDATE detail_jadwal set id_jadwal='$id_jadwal',id_tim='$id_tim',skor='$skor',gol='$id_pemain',waktu_gol='$waktu_gol' WHERE id='$id'");
               
               
           echo "<script>
          window.location='detail_pertandingan.php?id=".$id_jadwal."';
          </script>";
           
        
        }

    }
}



//delete skor
if($_GET['act']=='delete_skor'){
    $id_jadwal = $_GET['id_jadwal'];
    $id = $_GET['id'];
    $hapus="DELETE FROM detail_jadwal WHERE id='$id'";
    mysqli_query($konek,$hapus);
    
    echo "<script>
    window.location='detail_pertandingan.php?id=".$id_jadwal."';
    </script>";
    
    }
  
?>