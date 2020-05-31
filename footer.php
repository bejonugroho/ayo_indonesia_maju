
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="#">Admin XYZ</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/select2/js/select2.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
$(document).ready(function() {
  $('.s2').select2();

  
var s=$("#status").val();

if(s=='1'){
  $("#a").show();
  $("#h").hide();
}else if(s=='2'){
  $("#h").show();
  $("#a").hide();
}else{
  $("#h").hide();
  $("#a").hide();
}

});
</script>

<script>
function myFunction() {
  $("#form").submit();
}


</script>

<script>
$("#status").change(function(){

var s=$(this).val();
var idt=$("#nama_tim").val();

if(s=='1'){
  $("#a").show();
  $("#h").hide();
  $.ajax({
    type:"post",
    url:"jp.php",
    data:{idt:idt},
    success:function(data){
      console.log(data);
      $("#home").val(data);
      $("#away").val(" ");
    }
  });
}else if(s=='2'){
  $("#h").show();
  $("#a").hide();
  $.ajax({
    type:"post",
    url:"jp.php",
    data:{idt:idt},
    success:function(data){
      console.log(data);
      $("#away").val(data);
      $("#home").val(" ");
      
    }
  });
}else{
  $("#h").hide();
  $("#a").hide();

}

});

$("#nama_tim").change(function(){
  var s=$("#status").val();
  var idt=$(this).val();

  if(s=='1'){
    $("#a").show();
    $("#h").hide();
    $.ajax({
      type:"post",
      url:"jp.php",
      data:{idt:idt},
      success:function(data){
        console.log(data);
        $("#home").val(data);
        $("#away").val(" ");
      }
    });
  }else if(s=='2'){
    $("#h").show();
    $("#a").hide();
    $.ajax({
      type:"post",
      url:"jp.php",
      data:{idt:idt},
      success:function(data){
        console.log(data);
        $("#away").val(data);
        $("#home").val(" ");
        
      }
    });
  }else{
    $("#h").hide();
    $("#a").hide();

  }
});
</script>
<script>
$("#id_tim").change(function(){ 

var it=$(this).val();
if(it!==""){
  $("#tp").show();
}else{
  $("#tp").hide();
}
$.ajax({
      type:"post",
      url:"sp.php",
      data:{it:it},
      success:function(data){
       $("#id_pemain").html(data);
      }
    });
});
</script>
<script>
$("#tp").click(function(){
var it=$("#id_tim").val();
window.location="informasi_pemain.php?view=tambah&id_tim="+ it +"";
});
</script>
</body>
</html>
