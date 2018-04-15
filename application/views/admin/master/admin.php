<script src="<?php echo base_url() ?>assets/admin_panel/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.responsive.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/responsive.bootstrap4.js"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Data Admin</h2></div>
          <div class="col-md-6">
            <button id="btnAdd" class="btn btn-primary" style="float:right;"><span class="fa fa-plus"></span> Tambah Baru</button>
          </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->
<div class="container-fluid top-bottom">
    <div class="row">
        <div class="col-md-12">
          <div class="block-space">

              <table class="table" id="lookup" style="margin-top: 50px;">
                <thead>
                  <th>Nama</th>
                  <th>Foto</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Level</th>
                  <th>Last Login</th>
                  <th></th>
                </thead>
                <tbody></tbody>
              </table>

          </div>
        </div>
    </div>
</div>

<div id="modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Admin</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>


        <form id="formAdd" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Admin</label>
                <input type="text" class="form-control form-control-sm" id="first_name" name="first_name" placeholder="Tuliskan nama Admin">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Tuliskan Username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control form-control-sm" id="password" name="password" placeholder="Tuliskan Password">
            </div>
            <select class="custom-select" id="level" name="level">
              <option>1</option>
              <option>2</option>
            </select>
            <div class="form-group">
                <label>Foto</label><br>
                <input type="file" name="picture_init" id="picture_init"><br>
                <input type="hidden" name="admin_foto" id="admin_foto">
            </div>
            <button class="btn btn-primary btn-sm" id="btnAddForm"><span class="fa fa-save"></span> Simpan</button>
        </div>
        </form>


    </div>
  </div>
</div>


<div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Update Admin</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>


        <form id="formUpdate" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Admin</label>
                <input type="hidden" name="admin_id" id="admin_id_update">
                <input type="text" class="form-control form-control-sm" id="first_name_update" name="first_name" placeholder="Tuliskan nama Admin">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control form-control-sm" id="username_update" name="username" placeholder="Tuliskan Username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control form-control-sm" id="password_update" name="password" placeholder="Tuliskan Password">
            </div>
            <select class="custom-select" id="level_update" name="level">
              <option value="1">1</option>
              <option value="2">2</option>
            </select>
            <div class="form-group">
                <label>Foto</label><br>
                <input type="file" name="picture_init" id="picture_init_update"><br>
                <input type="hidden" name="admin_foto" id="admin_foto_update">
            </div>
            <button class="btn btn-primary btn-sm" id="btnUpdateForm"><span class="fa fa-save"></span> Simpan</button>
        </div>
        </form>


    </div>
  </div>
</div>
<script type="text/javascript">
  var dataTable = $('#lookup').DataTable( {
  "processing": true,
  "serverSide": true,
  "searching": true,
  "responsive": true,
  "ajax":{
      url :"<?php echo admin_url()."master/admin_select_all" ?>",
      type: "POST",  // method  , by default get
      error: function(){  // error handling
          $(".lookup-error").html("");
          $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
          $("#lookup_processing").css("display","none");
          
      }
    }
});
$("#lookup_length select").addClass("custom-select").css('height','35px');







function deleteResImage(selector, callback){

  $(document).on("click", ".imgDel", function(){
    $(".src").val('');
    $(selector).val('');
    $(".imgRes").remove();
    if(callback) 
      callback();
  }) 
}

function showImage(selector,path,image){
  $(".imgRes").remove();
  if (image !== "") {
    $(selector).after('<div class="imgRes"><img style="width:100%" src="'+path+image+'"><br><a href="#" class="imgDel">Hapus</a></div>');
  }
}


$(document).on("click", "#btnAdd", function(){
  $("#modal1").modal("show");
})


deleteResImage("#admin_foto");
deleteResImage("#admin_foto_update");

$(document).on("change","#picture_init", function(){


  var xhrTarget = "<?php echo admin_url()."master/admin_generate_picture" ?>";

  sendImage("#formAdd", '#picture_init', xhrTarget,function(result){
    if (result.status == 'ok') {
        $(".imgRes").remove();
        $("#picture_init").after('<div class="imgRes"><img style="width:100%" src="<?php echo base_url() ?>assets/img/admin/'+result.data+'"><br><a href="#" class="imgDel">Hapus</a></div>');
        $("#admin_foto").val(result.data);
        
      }
      else{
        swal('File Tidak Falid !!!');
      }
  })
})


$(document).on("change","#picture_init_update", function(){

  var xhrTarget = "<?php echo admin_url()."master/admin_generate_picture" ?>";

  sendImage("#formUpdate", '#picture_init_update', xhrTarget,function(result){
    if (result.status == 'ok') {
        $(".imgRes").remove();
        $("#picture_init_update").after('<div class="imgRes"><img style="width:100%" src="<?php echo base_url() ?>assets/img/admin/'+result.data+'"><br><a href="#" class="imgDel">Hapus</a></div>');
        $("#admin_foto_update").val(result.data);
        
      }
      else{
        swal('File Tidak Falid !!!');
      }
  })
})



$(document).on("submit","#formAdd", function(e){

    e.preventDefault();

    btnLoader("#btnAddForm");

    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/add_admin',
        method : 'POST',
        data : new FormData(this),
        contentType : false,
        processData : false,
        success : function(data){
        
        btnRemoveLoader("#btnAddForm",'<span class="fa fa-save"></span> Simpan');

            var dataObj = JSON.parse(data);
            if (dataObj.status == 'ok') {
                $("#modal1").modal('hide');
                dataTable.ajax.reload();
            }
            if (dataObj.status == 'validate') {
                validateForm("#modal1 .modal-body",dataObj.message);
            }
            if (dataObj.status == 'required') {
                validateForm("#modal1 .modal-body",dataObj.message);
            }
        }
    })
})

$(document).on("submit","#formUpdate", function(e){

    e.preventDefault();

    btnLoader("#btnUpdateForm");

    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/update_admin',
        method : 'POST',
        data : new FormData(this),
        contentType : false,
        processData : false,
        success : function(data){
      
        btnRemoveLoader("#btnUpdateForm",'<span class="fa fa-save"></span> Simpan');
            var dataObj = JSON.parse(data);
            if (dataObj.status == 'ok') {
                $("#modal2").modal('hide');
                dataTable.ajax.reload();
            }
            if (dataObj.status == 'validate') {
                validateForm("#modal2 .modal-body",dataObj.message);
            }
            if (dataObj.status == 'required') {
                validateForm("#modal2 .modal-body",dataObj.message);
            }
        }
    })
})


$(document).on("click", ".bEdit", function(){
  var bEdit = $(".bEdit");
  var index = bEdit.index(this);
  var valId = bEdit.eq(index).attr('data-value');
  var path = '<?php echo base_url() ?>'+'assets/img/admin/';

  $("#admin_id_update").val(valId);
  $("#modal2").modal("show");
  $("#level_update option").removeAttr("selected");

  showLoader("#modal2 .modal-body");


  $.ajax({
    url : '<?php echo admin_url() ?>'+'master/get_admin',
    method : 'POST',
    data : {admin_id : valId},
    success : function(jsonData){

      removeLoader("#modal2 .modal-body");

      var dataObj = JSON.parse(jsonData);
      var data = dataObj.data;

      $("#first_name_update").val(data.first_name);
      $("#username_update").val(data.username);
      $("#password_update").val(data.password);
      $("#level_update option[value="+data.level+"]").attr("selected","");
      $("#admin_foto_update").val(data.admin_foto);
      showImage("#picture_init_update",path,data.admin_foto);
    }
  })
})

$(document).on("click",".bDelete",function(){


  var bDelete = $(".bDelete");
  var index = bDelete.index(this);
  var valId = bDelete.eq(index).attr('data-value');
  var alertObj = {
    title : 'Apakah Yakin Ingin Menghapus ?',
    text : "Data akan terhapus dari DATABASE !!"
  }
  dataAlert(alertObj, function(){
    $.ajax({
      url : '<?php echo admin_url() ?>' + 'master/delete_admin/',
      method : 'POST',
      data : {admin_id : valId},
      success : function(jsonData){
        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          dataTable.ajax.reload();
        }
      }
    })
  })

})

</script>