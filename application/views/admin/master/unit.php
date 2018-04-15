<script src="<?php echo base_url() ?>assets/admin_panel/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.responsive.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/responsive.bootstrap4.js"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Data Satuan Product</h2></div>
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
              <table id="lookup" class="table">
                <thead>
                    <th>No.</th>
                    <th>Nama Satuan</th>
                    <th>Dibuat Oleh</th>
                    <th>Tanggal Input</th>
                    <th>Jumlah Product terkait</th>
                    <th width="50px"></th>
                </thead>
                <tbody>
                
                </tbody>
            </table>


          </div>
        </div>
    </div>
</div>


<!-- modal -->

<div id="modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Satuan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label>Nama Satuan</label>
                <input type="text" class="form-control form-control-sm" id="unit_name" name="unit_name" placeholder="Tuliskan nama satuan">
            </div>
            <button class="btn btn-primary btn-sm" id="btnSaveUnit"><span class="fa fa-save"></span> Simpan</button>
        </div>


    </div>
  </div>
</div>

<div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Update Satuan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label>Nama Satuan</label>
                <input type="hidden" id="unit_id">
                <input type="text" class="form-control form-control-sm" id="unit_name_update" name="unit_name_update" placeholder="Tuliskan nama satuan">
            </div>
            <button class="btn btn-primary btn-sm" id="btnUpdateUnit"><span class="fa fa-save"></span> Simpan</button>
        </div>


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
        url :"<?php echo admin_url()."master/unit_select_all" ?>", // json datasource
        type: "POST",  // method  , by default get
        error: function(){  // error handling
            $(".lookup-error").html("");
            $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            $("#lookup_processing").css("display","none");
            
        }
    }
});
$("#lookup_length select").addClass("custom-select").css('height','35px');


$(document).on("click", "#btnAdd", function(){
  $("#modal1").modal("show");
})


$(document).on("click", "#btnSaveUnit", function(){
    var unit_name = $("#unit_name").val();
    btnLoader(this);
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/save_satuan',
        method : 'POST',
        data : {unit_name : unit_name},
        success : function(jsonData){
          
          btnRemoveLoader("#btnSaveUnit", '<span class="fa fa-save"></span> Simpan');

            var dataObj = JSON.parse(jsonData);
            if (dataObj.status == 'ok') {
                dataTable.ajax.reload();
                $("#modal1").modal("hide");
            }
            if (dataObj.status == 'required') {
                validateForm(dataObj.message,"#modal1")
            }
        }
    })
})

$(document).on("click", "#btnUpdateUnit", function(){
    var unit_name = $("#unit_name_update").val();
    var unit_id = $("#unit_id").val();

    btnLoader(this);
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/update_satuan',
        method : 'POST',
        data : {unit_name : unit_name,unit_id : unit_id},
        success : function(jsonData){

          btnRemoveLoader('#btnUpdateUnit','<span class="fa fa-save"></span> Simpan');

            var dataObj = JSON.parse(jsonData);
            if (dataObj.status == 'ok') {
                dataTable.ajax.reload();
                $("#modal2").modal("hide");
            }
            if (dataObj.status == 'required') {
                validateForm(dataObj.message,"#modal2")
            }
        }
    })
})

$(document).on("click",".bEdit", function(){
    $("#modal2").modal("show");
    var bEdit = $(".bEdit");
    var index = bEdit.index(this);
    var valId = bEdit.eq(index).attr("data-value");
    $("#unit_id").val(valId);
    showLoader("#modal2 .modal-body");
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/get_unit',
        method : 'POST',
        data : {unit_id : valId},
        success : function(jsonData){
            removeLoader("#modal2 .modal-body");
            var dataObj = JSON.parse(jsonData);
            if (dataObj.status == 'ok') {
                $("#unit_name_update").val(dataObj.data.unit_name);
            }            
        }
    })
})


$(document).on("click", ".bDelete", function(){
    var bDelete = $(".bDelete");
    var index = bDelete.index(this);
    var valId = bDelete.eq(index).attr("data-value");

    var alertObj = {
        title : "Apakah Kakin Ingin Menghapus ? ",
        text  : "Data akan terhapus daris system"
    }
    dataAlert(alertObj, function(){
        $.ajax({
            url : '<?php echo admin_url() ?>' + 'master/delete_unit',
            method : 'POST',
            data : {unit_id : valId},
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