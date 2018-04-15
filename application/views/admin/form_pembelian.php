<script type="text/javascript" src="<?php echo base_url()."assets/admin_panel/js/table-data.js" ?>"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Tambah Pembelian</h2></div>
        <div class="col-md-6">
          
          
        </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->

<div class="container-fluid top-bottom">
  <div class="row">
    <div class="col-md-12">
      <div class="block-space">
        <div class="row">
          <div class="col-md-6">

              <table style="width: 100%;">
                <tr>
                  <td width="30%"><label>Nomor Transaksi</label></td>
                  <td>:</td>
                  <td>
                  <input type="hidden" class="" name="" id="pembelian_id" class="pembelian_id" value="<?php echo $pembelian_id ?>">
                  <input type="text" name="no_trx" id="no_trx" class="form-control form-control-sm" placeholder="Auto" disabled="">
                  </td>
                  
                </tr>
                <tr>
                  <td><label>Supplier</label></td>
                  <td>:</td>
                  <td>
                  <input type="hidden" name="" id="supplier_id">
                  <input type="text" name="" class="form-control form-control-sm" id="renderSup" disabled="">
                  <a href="#" data-target="#modal1" data-toggle="modal">Edit Supplier</a>
                  </td>
                </tr>
              </table>

          </div>


          <div class="col-md-6">

              <table style="width: 100%;">
                <tr>
                  <td width="30%"><label>Tanggal Pembelian</label></td>
                  <td>:</td>
                  <td>
                  <input type="text" class="form-control form-control-sm datepicker" id="date_trx" value="<?php echo date("Y-m-d") ?>">
                  </td>
                  
                </tr>
                <tr>
                  <td>No. Terima</td>
                  <td>:</td>
                  <td>
                    <input type="text" class="form-control form-control-sm" id="no_terima" name="" placeholder="Nomor faktur supplier">
                  </td>
                </tr>
              </table>

          </div>

        </div>

        <hr>
        <div class="row">
          <div class="col-md-12">
            <table class="table" id="tableDetail">
              <thead>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th></th>
              </thead>
              <tbody></tbody>
            </table>
            <button class="btn btn-success btn-sm" data-target="#modal3" data-toggle="modal"><span class="fa fa-plus"></span> Tambah Item</button>

          </div>
        </div>
        <hr>

        <table style="width: 100%">
            <tr>
              <td>
                <h3>Total</h3>
              </td>
              <td><h3>:</h3></td>
              <td> <h3 id="total">Rp. 0,-</h3></td>
            </tr>
            <tr>
              <td><h3>Dibayar</h3></td>
              <td><h3> : </h3></td>
              <td><input type="text" id="total_paid" class="number form-control form-control-sm" name="" placeholder="Tulisakan total yang telah dibayar"></td>
            </tr>
          </table>

        <hr>
        <button class="btn btn-sm btn-info" id="btnSave1"><span class="fa fa-print"></span> Simpan & Print</button>
        <button class="btn btn-sm btn-info" id="btnSave2"><span class="fa fa-save"></span> Simpan</button>
      </div>
    </div>
  </div>
</div>


<!-- MODAL BOOTSTRAP -->
<div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Supplier</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <label>Filter</label>
              <input type="text" name="" id="searchModal1" class="form-control form-control-sm" placeholder="Cari berdasarkan nama">

              

            </div>
            <div class="col-md-3">
              <label>Tampilkan</label>
              <select id="lengthModal1" class="custom-select">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
              </select>
            </div>
            <div class="col-md-3">
              <label>Tambah</label>
              <button class="btn btn-primary" data-target="#modal2" data-toggle="modal">Supplier Baru</button>
            </div>
          </div>
          <table id="supplierLookup" class="table">
            <thead>
              <th>No</th>
              <th>Nama Supplier</th>
              <th>Telp</th>
              <th>Alamat</th>
              <th>Action</th>
            </thead>
            <tbody></tbody>
          </table>  
        </div>


    </div>
  </div>
</div>



<div id="modal2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Supplier</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <form method="POST" action="<?php echo admin_url()."pembelian/add_supplier" ?>" class="ajax_form">


        <div class="modal-body">
            <div class="form-group">
              <label>Nama Supplier</label>
              <input type="text" name="supplier_name" id="supplier_name" class="form-control form-control-sm onClear" placeholder="(Required)">
            </div>
            <div class="form-group">
              <label>Nomor Telephone</label>
              <input type="text" name="supplier_phone" class="form-control form-control-sm onClear" placeholder="(Required)">
            </div>
            <div class="form-group">
              <label>Alamat Lengkap</label>
              <textarea class="form-control form-control-sm  onClear" name="supplier_address" placeholder="(Opsional)"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary btn-ajax-process"><span class="fa fa-save"></span> Simpan</button>
        </div>
        </form>


    </div>
  </div>
</div>


<div id="modal3" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Item Barang</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <form method="POST" action="<?php echo admin_url()."pembelian/add_detail" ?>" id="formAddDetail">
        <div class="modal-body">
            <input type="hidden" name="pembelian_id" class="pembelian_id">
            <table style="width: 100%">

              <tr>
                <td>Nama Barang</td>
                <td>
                  <input type="text" name="nama_barang" class="form-control form-control-sm onClear" placeholder="Nama Barang">
                </td>
              </tr>
              <tr>
                <td>Jumlah Barang</td>
                <td>
                  <input type="number" name="jumlah_barang" class="form-control form-control-sm onClear" placeholder="Jumlah Barang">
                </td>
              </tr>
              <tr>
                <td>Satuan</td>
                <td>
                  <input type="text" name="satuan_barang" class="form-control form-control-sm onClear" placeholder="Jenis Satuan : Ekor/Buah/Pcs/dll">
                </td>
              </tr>
              <tr>
                <td>Harga</td>
                <td>
                  <input type="number" name="harga_barang" class="form-control form-control-sm onClear" placeholder="Harga Satuan">
                </td>
              </tr>
            </table>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-ajax-process" id="btnAddProduct"><span class="fa fa-save"></span> Tambahkan</button>
        </div>
        </form>


    </div>
  </div>
</div>


<div id="modal4" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Edit Detail Barang</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <form method="POST" action="<?php echo admin_url()."pembelian/edit_detail" ?>" id="formEditDetail">
        <div class="modal-body">
             <input type="hidden" name="pembelian_id" class="pembelian_id">
            <table style="width: 100%">

              <tr>
                <td>Nama Barang</td>
                <td>
                  <input type="text" name="nama_barang" id="nama_barang_edit" class="form-control form-control-sm onClear">
                </td>
              </tr>
              <tr>
                <td>Jumlah Barang</td>
                <td>
                  <input type="number" name="jumlah_barang" id="jumlah_barang_edit" class="form-control form-control-sm onClear">
                </td>
              </tr>
              <tr>
                <td>Satuan</td>
                <td>
                  <input type="text" name="satuan_barang" id="satuan_barang_edit" class="form-control form-control-sm onClear">
                </td>
              </tr>
              <tr>
                <td>Harga</td>
                <td>
                  <input type="number" name="harga_barang" id="harga_barang_edit" class="form-control form-control-sm onClear">
                </td>
              </tr>
            </table>

        </div>
        <div class="modal-footer">
          <input type="hidden" value="" id="pembelian_detail_id" name="pembelian_detail_id">
          <button class="btn btn-primary btn-ajax-process" type="submit" id="btnUpdateProduct"><span class="fa fa-save"></span> Update</button>
        </div>
        </form>


    </div>
  </div>
</div>

<script type="text/javascript">
    var dataSupplier = new tableData({
    table : '#supplierLookup',
    url : '<?php echo admin_url() ?>' + 'pembelian/load_supplier',
    method : 'POST',
    search : '#searchModal1',
    length : '#lengthModal1',
    defaultSort : ['supplier_id','DESC']
  })

  dataSupplier.render();




$(document).on("submit", ".ajax_form", function(e){

  e.preventDefault();
  $(".btn-ajax-process").html("Processing ...");
  $(".btn-ajax-process").attr("disabled","");
  var path = $(this).attr("action");
  var get_method = $(this).attr("method");

  $.ajax({
    url : path,
    method : get_method,
    data : new FormData(this),
    contentType : false,
    processData : false,
    success:function(data){
      $(".btn-ajax-process").html("Simpan");
      $(".btn-ajax-process").removeAttr("disabled");
      jsonData = JSON.parse(data);
      if (jsonData.action) {
        $('#modal2').modal('hide');
        dataSupplier.reload();
        $(".ajax_form .onClear").val("");
      }
      else if (jsonData.msg) {
        swal(jsonData.required+" Harus terisi","warning");
      }
    }
  })
})

$(document).on("click", ".btn-sup", function(){
  var btnSup = $(".btn-sup"); 
  var index = btnSup.index(this);
  var dataValue = btnSup.eq(index).attr("data-value");
  $("#modal1").modal("hide");
  $("#supplier_id").val(dataValue);
  renderSupplier(dataValue);

})


function renderSupplier(supplier_id){
  var renderSup = $("#renderSup");
  $.ajax({
    url : '<?php echo admin_url() ?>' + 'pembelian/render_supplier',
    method : 'POST',
    data : {supplier_id : supplier_id},
    success:function(data){
      var dataObj = JSON.parse(data);
      if (dataObj.status == 'success') {
        renderSup.val(dataObj.data.supplier_name);
      }
    }
  })
}


var renderPembelianDetail = (pembelian_id)=>{
      $.ajax({
      url : '<?php echo admin_url() ?>' + 'pembelian/render_detail',
      method : 'POST',
      data : {pembelian_id : pembelian_id},
      success : function(resultJson){
      var result = JSON.parse(resultJson);
      var jsonData = result.data;


          var num = jsonData.length;
          var container = $("#tableDetail tbody");
          

          var tr = "";

          for (var i = 0; i < num; i++) {

            var frontTr = '<tr>';
            var backTr = '</tr>';

            var nested = jsonData[i];
            var numNested = nested.length;
            var td = "";
              for (var b = 0; b < numNested; b++) {
                td += '<td>'+nested[b]+'</td>';
              }
            tr += frontTr+td+backTr;
          }
          container.html(tr);
      }
    })
}

$(document).on("submit", "#formAddDetail", function(e){
    var path = $(this).attr("action");
    var get_method = $(this).attr("method");
    e.preventDefault();

    btnLoader("#btnAddProduct");

    $.ajax({
      url : path,
      method : get_method,
      data : new FormData(this),
      contentType : false,
      processData : false,
      success:function(jsonData){

        btnRemoveLoader("#btnAddProduct",'<span class="fa fa-save"></span> Tambahkan')

        var dataObj = JSON.parse(jsonData);
        var pembelian_id = dataObj.pembelian_id;
        var total = dataObj.total;

        if (dataObj.status == 'ok') {
          $("#modal3").modal("hide");
          renderPembelianDetail(pembelian_id);
          $(".pembelian_id").val(pembelian_id);
          $("#pembelian_id").val(pembelian_id);
          $("#formAddDetail .onClear").val("");

          $("#total").html("Rp. "+$.number(total)+" ,-");

        }
        if (dataObj.status == 'failed') {
          validateForm("#modal3 .modal-body",dataObj.required);
        }
      }
    })
})

$(document).on("submit", "#formEditDetail", function(e){
    var path = $(this).attr("action");
    var get_method = $(this).attr("method");
    var pembelian_id = $("#pembelian_id").val();
    e.preventDefault();
    btnLoader("#btnUpdateProduct");

    $.ajax({
      url : path,
      method : get_method,
      data : new FormData(this),
      contentType : false,
      processData : false,
      success:function(jsonData){
        btnRemoveLoader("#btnUpdateProduct",'<span class="fa fa-save"></span> Update');

        var dataObj = JSON.parse(jsonData);
        var total = dataObj.total;

        if (dataObj.status == 'ok') {
          $("#modal4").modal("hide");
          renderPembelianDetail(pembelian_id);
          $("#formEditDetail .onClear").val("");
          $("#total").html("Rp. "+$.number(total));

        }
        if (dataObj.status == 'failed') {
          swal(dataObj.required+" Harus terisi","warning");
        }
      }
    })
})

$(document).on("click",".btnEdit", function(){
  $("#modal4").modal("show");
  var btnEdit = $(".btnEdit");
  var index  = btnEdit.index(this);
  var dataValue = btnEdit.eq(index).attr("data-value");
  $("#pembelian_detail_id").val(dataValue);

  showLoader("#modal4 .modal-body");

  $.ajax({
    url : '<?php echo admin_url() ?>' + 'pembelian/render_item',
    method : 'POST',
    data : {pembelian_detail_id : dataValue},
    success : function(jsonData){

      removeLoader("#modal4 .modal-body");

      var dataObj = JSON.parse(jsonData);
      if (dataObj.status == 'ok') {
        $("#nama_barang_edit").val(dataObj.data.nama_barang);
        $("#jumlah_barang_edit").val(dataObj.data.jumlah_barang);
        $("#satuan_barang_edit").val(dataObj.data.satuan_barang);
        $("#harga_barang_edit").val(dataObj.data.harga_barang);
      }
    }
  })
})

var savePembelian = (callback)=>{
  var pembelian_id = $("#pembelian_id").val();
  var supplier_id = $("#supplier_id").val();
  var date_trx = $("#date_trx").val();
  var total_paid = $("#total_paid").val();
  var no_terima = $("#no_terima").val();

    $.ajax({
      url : '<?php echo admin_url() ?>' + 'pembelian/save_pembelian',
      method : 'POST',
      data : {pembelian_id : pembelian_id,
              supplier_id : supplier_id,
              date_trx : date_trx,
              total_paid : total_paid,
              no_terima : no_terima
              },
      success : function(jsonData){
        if (callback)
          callback(jsonData);
      }
    })
}

$(document).on("click", "#btnSave1", function(){
  var supplier_id = $("#supplier_id").val();
  var pembelian_id = $("#pembelian_id").val();


  if (supplier_id == "") {
    swal("Ooops!!","Supplier harus terisi",'warning');
    return false;
  }
  if (pembelian_id == "") {
    swal("Ooops!!","Isi Data Item Dulu",'warning');
    return false;
  }
    var objAlert = {
      title : 'Yakin Ingin Menyimpan',
      text : 'Data akan tersimpan ke Database'
    };
    dataAlert(objAlert,function(){

      savePembelian(function(jsonData){
        $("#btnSave1").html("Processing ...");
        var dataObj = JSON.parse(jsonData);

        if (dataObj.status == 'ok') {
          var data = dataObj.data;
          var pembelian_id = data.pembelian_id;
          window.open('<?php echo admin_url() ?>'+'pembelian/print_pembelian/'+pembelian_id);
          document.location = '<?php echo admin_url() ?>'+'pembelian';
        }
      }) 

    })

})


$(document).on("click", "#btnSave2", function(){
  var supplier_id = $("#supplier_id").val();
  var pembelian_id = $("#pembelian_id").val();


  if (supplier_id == "") {
    swal("Ooops!!","Supplier harus terisi",'warning');
    return false;
  }
  if (pembelian_id == "") {
    swal("Ooops!!","Isi Data Item Dulu",'warning');
    return false;
  }
    var objAlert = {
      title : 'Yakin Ingin Menyimpan',
      text : 'Data akan tersimpan ke Database'
    };
    dataAlert(objAlert,function(){

      savePembelian(function(jsonData){
        $("#btnSave2").html("Processing ...");
        var dataObj = JSON.parse(jsonData);

        if (dataObj.status == 'ok') {
          var data = dataObj.data;
          var pembelian_id = data.pembelian_id;
          document.location = '<?php echo admin_url() ?>'+'pembelian';
        }
      }) 

    })
    
})

var getRenderPembelian = (pembelian_id)=>{
  $.ajax({
    url : '<?php echo admin_url() ?>' + 'pembelian/get_render_pembelian',
    method : 'POST',
    data : {pembelian_id : pembelian_id},
    success : function(jsonData){
      var dataObj = JSON.parse(jsonData);
      var status = dataObj.status;
      var data = dataObj.data;
      if (status == 'ok') {
        $("#supplier_id").val(data.supplier_id);
        $(".pembelian_id").val(data.pembelian_id);
        $("#no_trx").val(data.no_pembelian);
        $("#date_trx").val(data.date_trx);
        $("#no_terima").val(data.no_terima);
        $("#total").html("Rp. "+$.number(data.total)+" ,-");
        $("#total_paid").val(data.total_paid);
        $("#renderSup").val(data.supplier_name);
      }

    }
  })
}


$(window).on("load", function(){

  showLoader(".block-space");

  var pembelian_id = $("#pembelian_id").val();
  if (pembelian_id !== "") {
    renderPembelianDetail(pembelian_id);
    getRenderPembelian(pembelian_id);
  }  
  
    $(document).ajaxStop(function(){
      removeLoader(".block-space");
    })
})

$(document).on("click",".btnDelete", function(){
  var bDelete = $(".btnDelete");
  var index = bDelete.index(this);
  var pembelian_detail_id = bDelete.eq(index).attr("data-value");
  var pembelian_id = $("#pembelian_id").val();

  var objAlert = {
    title : 'Anda Yakin Ingin Menghapus ?',
    text : 'Data akan terhapus dari database'
  }

  dataAlert(objAlert, function(){

    $.ajax({
      url : '<?php echo admin_url() ?>'+'pembelian/delete_detail',
      method : 'POST',
      data : {pembelian_detail_id : pembelian_detail_id,pembelian_id : pembelian_id},
      success : function(jsonData){
        var dataObj = JSON.parse(jsonData);
        renderPembelianDetail(pembelian_id);
        $("#total").html("Rp. "+$.number(dataObj.total)+" ,-");
      }
    })
  })


})
</script>