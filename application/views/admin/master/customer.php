<script src="<?php echo base_url() ?>assets/admin_panel/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.responsive.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/responsive.bootstrap4.js"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Data Pelanggan</h2></div>
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
                    <th>Kode Pelanggan</th>
                    <th>Nama pelanggan</th>
                    <th>Phone</th>
                    <th>Alamat</th>
                    <th>Tgl input</th>
                    <th>Dibuat oleh</th>
                    <th>Jumlah Pemesanan</th>
                    <th width="60px"></th>
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
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Pelanggan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" class="form-control form-control-sm" id="customer_name" name="customer_name" placeholder="Tuliskan nama pelanggan">
            </div>
            <div class="form-group">
                <label>Nomor Telphone</label>
                <input type="text" class="form-control form-control-sm" id="customer_phone" name="customer_phone" placeholder="Tuliskan telephone pelanggan">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control form-control-sm" id="customer_address" name="customer_address" placeholder="Tuliskan alamat pelanggan">
            </div>
            <button class="btn btn-primary btn-sm" id="btnSaveCustomer"><span class="fa fa-save"></span> Simpan</button>
        </div>


    </div>
  </div>
</div>

<div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Pelanggan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="hidden" name="" id="customer_id">
                <input type="text" class="form-control form-control-sm" id="customer_name_update" name="customer_name" placeholder="Tuliskan nama pelanggan">
            </div>
            <div class="form-group">
                <label>Nomor Telphone</label>
                <input type="text" class="form-control form-control-sm" id="customer_phone_update" name="customer_phone" placeholder="Tuliskan telephone pelanggan">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control form-control-sm" id="customer_address_update" name="customer_address" placeholder="Tuliskan alamat pelanggan">
            </div>
            <button class="btn btn-primary btn-sm" id="btnUpdateCustomer"><span class="fa fa-save"></span> Simpan</button>
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
        url :"<?php echo admin_url()."master/customer_select_all" ?>", // json datasource
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

$(document).on("click", "#btnSaveCustomer", function(){
    var customer_name = $("#customer_name").val();
    var customer_phone = $("#customer_phone").val();
    var customer_address = $("#customer_address").val();
    btnLoader(this);
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/save_customer',
        method : 'POST',
        data : {customer_name : customer_name,
                customer_phone : customer_phone,
                customer_address : customer_address},
        success : function(jsonData){
          btnRemoveLoader("#btnSaveCustomer",'<span class="fa fa-save"></span> Simpan')
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

$(document).on("click", "#btnUpdateCustomer", function(){
    var customer_id = $("#customer_id").val();
    var customer_name = $("#customer_name_update").val();
    var customer_phone = $("#customer_phone_update").val();
    var customer_address = $("#customer_address_update").val();

    btnLoader(this);
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/update_customer',
        method : 'POST',
        data : {customer_id : customer_id,
                customer_name : customer_name,
                customer_phone : customer_phone,
                customer_address : customer_address},
        success : function(jsonData){

          btnRemoveLoader("#btnUpdateCustomer",'<span class="fa fa-save"></span> Simpan')
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
    $("#customer_id").val(valId);
    showLoader("#modal2 .modal-body");
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/get_customer',
        method : 'POST',
        data : {customer_id : valId},
        success : function(jsonData){
            removeLoader("#modal2 .modal-body");
            var dataObj = JSON.parse(jsonData);
            if (dataObj.status == 'ok') {
                $("#customer_name_update").val(dataObj.data.customer_name);
                $("#customer_phone_update").val(dataObj.data.customer_phone);
                $("#customer_address_update").val(dataObj.data.customer_address);
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
            url : '<?php echo admin_url() ?>' + 'master/delete_customer',
            method : 'POST',
            data : {customer_id : valId},
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