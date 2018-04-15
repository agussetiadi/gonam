<script type="text/javascript" src="<?php echo base_url()."assets/admin_panel/js/table-data.js" ?>"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Halaman Pembelian</h2></div>
        <div class="col-md-6">
          
          <button style="float: right; margin-left: 5px" class="btn btn-primary" id="b-print"><span class="fa fa-print" id="b-print"></span> Print</button>
          
          <a href="<?php echo admin_url()."pembelian/form" ?>" style="float: right;">
            <button class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Pesanan</button>
          </a>
        </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->

<div class="container-fluid top-bottom">
  <div class="row">
    <div class="col-md-12">
      <div class="block-space">

        <table id="tb1" style="width: 100%; margin-bottom: 50px;">

          <tr>
            <td>
            <div class="custom-fa-search">
              <input type="text" class="form-control" id="searchModal1" name="" placeholder="Cari nama/invoice"></td>
            </div>
            <td style="text-align: right;"></td>
            <td>
              <select class="form-control custom-select" id="lengthModal1" style="margin: 0">
                <option>15</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
                <option>250</option>
                <option>500</option>
              </select>
          </td>
          <td>
            <div class="custom-fa-calender">
              <input type="text" name="" id="date_trx" class="form-control datepicker" placeholder="Cari berdasar tanggal">
            </div>
          </td>
          <td>
              <select class="form-control custom-select" id="is_paid" style="margin: 0;">
                <option value="all">Status Bayar</option>
                <option value="1">Lunas</option>
                <option value="0">Belum Lunas</option>
              </select>
            </td>
          </tr>
          

        </table>


        <table id="lookUp" class="table">
          <thead style="cursor: pointer;">
            <th>No. Pembelian</th>
            <th>No. Terima</th>
            <th>Supplier</th>
            <th>Total</th>
            <th>Di Bayar</th>
            <th>Tanggal Transaksi</th>
            <th></th>
          </thead>
          <tbody></tbody>
        </table>
        <div style="clear: both;"></div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

    var dataAlert = (data,callback,callback2) => {
      if (typeof data.title == 'undefined') {
        var title = "Title Alert";
      }
      else{
        var title = data.title; 
      }
      if (typeof data.text == 'undefined') {
        var text = "Text Alert";
      }
      else{
        var text = data.text;
      }

      swal({
        title: title,
        text: text,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: true
      },
        function(isConfirm){
          if (isConfirm) {
                
              if (callback)
                callback();

          } else {
            if (callback2)
                callback2();
          }
        });

    }


    var date_trx = $("#date_trx").val();
    var is_paid = $("#is_paid").val();

    var renderPembelian = new tableData({
    table : '#lookUp',
    url : '<?php echo admin_url() ?>' + 'pembelian/render_pembelian',
    method : 'POST',
    search : '#searchModal1',
    length : '#lengthModal1',
    defaultSort : ['pembelian_id','DESC'],
    field : ["pembelian_id","no_terima","supplier.supplier_name","total","total_paid", "date_trx"],
    data : {
      date_trx : date_trx,
      is_paid : is_paid
    }
  });

  renderPembelian.render();

  $(document).on("change","#date_trx", function(){

    date_trx = $(this).val();
    is_paid = $("#is_paid").val();
    renderPembelian.reload({
      date_trx : date_trx,
      is_paid : is_paid
    })
  })

  $(document).on("change","#is_paid", function(){

    date_trx = $("#date_trx").val();
    is_paid = $(this).val();
    renderPembelian.reload({
      date_trx : date_trx,
      is_paid : is_paid
    })
  })

  $(document).on("click","#b-print", function(){
    var f1 = $("#searchModal1").val();
    var f2 = $("#date_trx").val();
    var f3 = $("#is_paid").val();

    var path = '<?php echo admin_url() ?>'+'pembelian/get_print?key='+f1+'&date='+f2+'&is_paid='+is_paid+'';
    window.open(path);

  })
  $(document).on("click",".bDelete", function(){

    var bDelete = $(".bDelete");
    var index = bDelete.index(this);
    var pembelian_id = bDelete.eq(index).attr('data-value');

    date_trx = $("#date_trx").val();
    is_paid = $("#is_paid").val();

    objAlert = {
      title : 'Yakin Ingin Menghapus',
      text : 'Data akan terhapus dari sistem'
    }
    dataAlert(objAlert, function(){

      $.ajax({
        url : '<?php echo admin_url() ?>' + 'pembelian/delete',
        method : 'POST',
        data : {pembelian_id : pembelian_id},
        success : function(jsonData){
          var dataObj = JSON.parse(jsonData);
          if (dataObj.status == 'ok') {
              renderPembelian.reload({
              date_trx : date_trx,
              is_paid : is_paid
            });
          }

        }
      })

    })

  })

  $(window).on('load', function(){
    showLoader('.block-space');
  })

  $(document).ajaxStop(function(){
    removeLoader('.block-space');
  })

</script>