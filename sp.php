<?php  include 'inc/koneksi.php';

$it=$_POST['it'];
$sel=mysqli_query($konek,"SELECT id,nama_pemain FROM tbl_pemain WHERE id_tim=".$it." ");

while ($sel2=mysqli_fetch_assoc($sel)){

    echo "<option value=".$sel2['id'].">".$sel2['nama_pemain']."</option>";
}

 


?>