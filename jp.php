<?php include 'inc/koneksi.php';

$idt=$_POST['idt'];
$sel=mysqli_query($konek,"SELECT nama_tim FROM tbl_informasi_tim WHERE id=".$idt." ");
$sel2=mysqli_fetch_assoc($sel);
echo $sel2['nama_tim'];

?>