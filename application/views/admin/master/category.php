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
                    <th>Nama Kategori</th>
                    <th>Dibuat Oleh</th>
                    <th>Tanggal Input</th>
                    <th>Jumlah Product terkait</th>
                    <th>Status</th>
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
          <h4 class="modal-title">Tambah Kategori</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" class="form-control form-control-sm" id="category_name" name="category_name" placeholder="Tuliskan nama kategori">
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" name="is_publish_add" value="1" class="custom-control-input" id="is_publish1"> <label class="custom-control-label" for="is_publish1">Publikasikan di Halaman Pengunjung</label>
            </div>
            <div class="custom-control custom-radio">
                <input checked="" type="radio" name="is_publish_add" value="0" class="custom-control-input" id="is_publish2"> <label class="custom-control-label" for="is_publish2">Hanya Tampil di Halaman Admin</label>
            </div>
            <hr>
            <button class="btn btn-primary btn-sm" id="btnSaveCategory"><span class="fa fa-save"></span> Simpan</button>
        </div>


    </div>
  </div>
</div>

<div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Kategori</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="hidden" name="" id="category_id"> 
                <input type="text" class="form-control form-control-sm" id="category_name_update" name="category_name" placeholder="Tuliskan nama kategori">
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" name="is_publish_update" value="1" class="custom-control-input" id="is_publish3"> <label class="custom-control-label" for="is_publish3">Publikasikan di Halaman Pengunjung</label>
            </div>
            <div class="custom-control custom-radio">
                <input checked="" type="radio" name="is_publish_update" value="0" class="custom-control-input" id="is_publish4"> <label class="custom-control-label" for="is_publish4">Hanya Tampil di Halaman Admin</label>
            </div>
            <hr>
            <button class="btn btn-primary btn-sm" id="btnUpdateCategory"><span class="fa fa-save"></span> Simpan</button>
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
        url :"<?php echo admin_url()."master/category_select_all" ?>", // json datasource
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

$(document).on("click", "#btnSaveCategory", function(){
    var category_name = $("#category_name").val();
    var is_publish1 = $("#is_publish1").prop('checked');
    var is_publish2 = $("#is_publish2").prop('checked');
    
    if (is_publish1 == true) {
        var is_publish = 1;
    }
    else{
        var is_publish = 0;
    }

    btnLoader('#btnSaveCategory');

    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/save_category',
        method : 'POST',
        data : {category_name : category_name, is_publish : is_publish},
        success : function(jsonData){
          
          btnRemoveLoader('#btnSaveCategory','<span class="fa fa-save"></span> Simpan');

            var dataObj = JSON.parse(jsonData);
            if (dataObj.status == 'ok') {
                dataTable.ajax.reload();
                $("#modal1").modal("hide");
            }
            if (dataObj.status == 'required') {
                validateForm("#modal1 .modal-body",dataObj.message)
            }
        }
    })
})

$(document).on("click", "#btnUpdateCategory", function(){
    var category_name = $("#category_name_update").val();
    var category_id = $("#category_id").val();
    var is_publish3 = $("#is_publish3").prop('checked');
    var is_publish4 = $("#is_publish4").prop('checked');
    
    if (is_publish3 == true) {
        var is_publish = 1;
    }
    else{
        var is_publish = 0;
    }

    btnLoader('#btnUpdateCategory');

    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/update_category',
        method : 'POST',
        data : {category_name : category_name, category_id : category_id, is_publish : is_publish},
        success : function(jsonData){

          btnRemoveLoader('#btnUpdateCategory','<span class="fa fa-save"></span> Simpan');

            var dataObj = JSON.parse(jsonData);
            if (dataObj.status == 'ok') {
                dataTable.ajax.reload();
                $("#modal2").modal("hide");
            }
            if (dataObj.status == 'required') {
                validateForm("#modal2 .modal-body",dataObj.message)
            }
        }
    })
})


$(document).on("click",".bEdit", function(){
    $("#modal2").modal("show");

    var bEdit = $(".bEdit");
    var index = bEdit.index(this);
    var valId = bEdit.eq(index).attr("data-value");
    $("#category_id").val(valId);
    showLoader("#modal2 .modal-body");
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/get_category',
        method : 'POST',
        data : {category_id : valId},
        success : function(jsonData){
            removeLoader("#modal2 .modal-body");
            var dataObj = JSON.parse(jsonData);
            if (dataObj.status == 'ok') {
                $("#category_name_update").val(dataObj.data.category_name);

                $("is_publish_update").removeAttr('checked');
                if (dataObj.data.is_publish == 1) {
                    $("#is_publish3").attr('checked','');
                }
                if (dataObj.data.is_publish == 0) {
                    $("#is_publish4").attr('checked','');
                }
                console.log(dataObj.is_publish)
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
            url : '<?php echo admin_url() ?>' + 'master/delete_category',
            method : 'POST',
            data : {category_id : valId},
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