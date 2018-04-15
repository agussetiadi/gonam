<script src="<?php echo base_url() ?>assets/admin_panel/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.responsive.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/responsive.bootstrap4.js"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Configurasi Notif</h2></div>
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
                  <th>Jenis Notif</th>
                  <th>Target</th>
                  <th>Status</th>
                  <th></th>
                </thead>
                <tbody></tbody>
              </table>

          </div>
        </div>
    </div>
</div>


<!-- modal -->

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
                <label>Nama Type</label>
                <select class="custom-select" id="notif_type" name="notif_type">
                  <option>email</option>
                  <option>phone</option>
                </select>
            </div>
            <div class="form-group">
                <label>Notif Target</label>
                <input type="text" class="form-control form-control-sm" id="notif_target" name="notif_target" placeholder="Tuliskan Target Pemberitahuan : email/nomor telephone">
            </div>
            <select class="custom-select" id="is_active" name="is_active">
              <option value="1">AKTIF</option>
              <option value="0">TIDAK AKTIF</option>
            </select>
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
          <h4 class="modal-title">Update Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>


        <form id="formUpdate" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Type</label>
                <input type="hidden" id="config_notif_id" name="config_notif_id">
                <select class="custom-select" id="notif_type_update" name="notif_type">
                  <option value="email">email</option>
                  <option value="phone">phone</option>
                </select>
            </div>
            <div class="form-group">
                <label>Notif Target</label>
                <input type="text" class="form-control form-control-sm" id="notif_target_update" name="notif_target" placeholder="Tuliskan Target Pemberitahuan : email/nomor telephone">
            </div>
            <select class="custom-select" id="is_active_update" name="is_active">
              <option value="1">AKTIF</option>
              <option value="0">TIDAK AKTIF</option>
            </select>
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
        url :"<?php echo admin_url()."config/notif" ?>",
        type: "POST",  // method  , by default get
        error: function(){  // error handling
            $(".lookup-error").html("");
            $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            $("#lookup_processing").css("display","none");
            
        }
      }
  });
  $("#lookup_length select").addClass("custom-select").css('height','35px');

  $(document).on("click","#btnAdd", function(){
    $("#modal1").modal("show");
  })

  $(document).on("submit", "#formAdd", function(e){
    e.preventDefault();

    btnLoader("#btnAddForm");

    var formValue = $("#formAdd")[0];
    $.ajax({
      url : '<?php echo admin_url() ?>' + 'config/add_notif',
      method : 'POST',
      data : new FormData(formValue),
      contentType : false,
      processData : false,
      success : function(jsonData){

        btnRemoveLoader("#btnAddForm",'<span class="fa fa-save"> </span> Simpan');

        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          dataTable.ajax.reload();
          $("#modal1").modal('hide');
        }
        if (dataObj.status == 'failed') {
          validateForm("#modal1 .modal-body",dataObj.data)
        }
      }
    })
  })


  $(document).on("submit", "#formUpdate", function(e){
    e.preventDefault();

    btnLoader("#btnUpdateForm");

    var formValue = $("#formUpdate")[0];
    $.ajax({
      url : '<?php echo admin_url() ?>' + 'config/update_notif',
      method : 'POST',
      data : new FormData(formValue),
      contentType : false,
      processData : false,
      success : function(jsonData){

        btnRemoveLoader("#btnUpdateForm",'<span class="fa fa-save"> </span> Simpan');

        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          dataTable.ajax.reload();
          $("#modal2").modal('hide');
        }
        if (dataObj.status == 'failed') {
          validateForm("#modal2 .modal-body",dataObj.data)
        }
      }
    })
  })


  $(document).on('click', ".bEdit", function(){
    $("#modal2").modal('show');

    var bEdit = $(".bEdit");
    var index = bEdit.index(this);
    var valId = bEdit.eq(index).attr('data-value');
    showLoader("#modal2 .modal-body");
    $("#notif_type_update option").removeAttr('selected');
    $("#is_active_update option").removeAttr('selected');

    $.ajax({
      url : '<?php echo admin_url() ?>' + 'config/get_update_notif',
      method : 'POST',
      data : {config_notif_id : valId},
      success : function(jsonData){
        removeLoader("#modal2 .modal-body");
        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          var data = dataObj.data;
          $("#notif_type_update option[value="+data.notif_type+"]").attr("selected","");
          $("#is_active_update option[value="+data.is_active+"]").attr("selected","");
          
          $("#notif_target_update").val(data.notif_target);
          $("#config_notif_id").val(data.config_notif_id);

        }

      }
    })
  })

  $(document).on("click",".bDelete",function(){
    var alertObj = {
      title : "Yakin Ingin Menghapus ?",
      text : "Data akan terhapus dari DATABASE"
    }

    var bDelete = $(".bDelete");
    var index = bDelete.index(this);
    var valId = bDelete.eq(index).attr('data-value');
    dataAlert(alertObj, function(){

      
      

      $.ajax({
        url : '<?php echo admin_url() ?>' + 'config/delete_notif',
        method : 'POST',
        data : {config_notif_id : valId},
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