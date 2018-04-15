<script type="text/javascript" src="<?php echo base_url()."assets/admin_panel/js/table-data.js" ?>"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Halaman Transaksi</h2></div>
        <div class="col-md-6">
          
          <button style="float: right; margin-left: 5px" class="btn btn-primary" id="b-print"><span class="fa fa-print" id="b-print"></span> Print</button>
          
          <a href="<?php echo admin_url()."pos/order" ?>" style="float: right;">
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
              <input title="Cari Berdasarkan Keywords" data-toggle="tooltip" data-placement="bottom" type="text" class="form-control" id="searchModal1" name="" placeholder="Cari nama/invoice"></td>
            </div>
            
            <td width="100px">
              <select class="form-control custom-select" id="lengthModal1" style="margin: 0">
                <option>15</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
                <option>250</option>
                <option>500</option>
              </select>
          </td>
          <td width="200px">
            <select class="form-control custom-select" id="order_status" style="margin: 0">
                <option value="all">Status</option>
                <option value="Pending">Pending</option>
                <option value="Done">Done</option>
              </select>
          </td>
          <td width="200px">
            <select class="form-control custom-select" id="paid_off" style="margin: 0">
                <option value="all">Pembayaran</option>
                <option value="L">Lunas</option>
                <option value="BL">Belum Lunas</option>
              </select>
          </td>
          <td>
            <div class="custom-fa-calender">
              <input type="text" name="" id="date_deliver" class="form-control datepicker" placeholder="Tanggal Mulai">
            </div>
          </td>
          <td>
            <div class="custom-fa-calender">
              <input type="text" name="" id="date_deliver2" class="form-control datepicker" placeholder="Tanggal Akhir">
            </div>
          </td>

          </tr>
        </table>
      <table class="table" id="tableOrder">
        <thead style="cursor: pointer;">
          <th>No. Invoice</th>
          <th width="250px;">Pelanggan</th>
          <th>Waktu Pengiriman</th>
          <th>Total</th>
          <th>Status Bayar</th>
          <th>Status TRX</th>
          <th></th>
        </thead>
        <tbody></tbody>
      </table>
      <div style="margin-top: 50px"></div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">



  var order_status = $("#order_status").val();
  var paid_off = $("#paid_off").val();
  var date_deliver = $("#date_deliver").val();
  var date_deliver2 = $("#date_deliver2").val();


  var renderOrder = new tableData({
    table : '#tableOrder',
    url : '<?php echo admin_url() ?>' + 'pos/render_order',
    method : 'POST',
    search : '#searchModal1',
    length : '#lengthModal1',
    defaultSort : ['date_created','DESC'],
    field : ["no_trx","customer_name","date_deliver", "grand_total"],
    data : {
      order_status : order_status,
      paid_off : paid_off,
      date_deliver : date_deliver,
      date_deliver2 : date_deliver2
    }
  });


  renderOrder.render();
  $("#order_status").change(function(){
    order_status = $(this).val();
    paid_off = $("#paid_off").val();
    date_deliver = $("#date_deliver").val();
    date_deliver2 = $("#date_deliver2").val();

    renderOrder.reload({
        order_status : order_status,
        paid_off : paid_off,
        date_deliver : date_deliver,
        date_deliver2 : date_deliver2
    })
  })

  $("#paid_off").change(function(){
    order_status = $("#order_status").val();
    paid_off = $(this).val();
    date_deliver = $("#date_deliver").val();
    date_deliver2 = $("#date_deliver2").val();

    renderOrder.reload({
        order_status : order_status,
        paid_off : paid_off,
        date_deliver : date_deliver,
        date_deliver2 : date_deliver2
    })
  })
  $("#date_deliver").on("change",function(){
    order_status = $("#order_status").val();
    paid_off = $("#paid_off").val();
    date_deliver = $(this).val();
    date_deliver2 = $("#date_deliver2").val();

    renderOrder.reload({
        order_status : order_status,
        paid_off : paid_off,
        date_deliver : date_deliver,
        date_deliver2 : date_deliver2
    })
  })

  $("#date_deliver2").on("change",function(){
    order_status = $("#order_status").val();
    paid_off = $("#paid_off").val();
    date_deliver = $("#date_deliver").val();
    date_deliver2 = $(this).val();
    
    renderOrder.reload({
        order_status : order_status,
        paid_off : paid_off,
        date_deliver : date_deliver,
        date_deliver2 : date_deliver2
    })
  })


  $(document).on("click", ".btnDeleteOrder", function(e){
    e.preventDefault();
    var btnDeleteOrder = $(".btnDeleteOrder");
    var index = btnDeleteOrder.index(this);
    var path = btnDeleteOrder.eq(index).attr("href");
      dataAlert({
        title : 'Yakin Ingin Menghapus !!',
        text : 'Data akan terhapus dari sistem'
      },function(){
          
          $.ajax({
            url : path,
            method : 'POST',
            success : function(jsonData){
              var dataObj = JSON.parse(jsonData);
              if (dataObj.status == 'ok') {
                renderOrder.reload();
              }
            }
          })

      })
  })
  $(document).on("click", "#b-print", function(){
    var order_status = $("#order_status").val();
    var paid_off = $("#paid_off").val();
    var date_deliver = $("#date_deliver").val();
    var date_deliver2 = $("#date_deliver2").val();
    var search = $("#searchModal1").val();
    var fieldTable = ["no_trx","customer_name","date_deliver", "grand_total"];
    var sort;
    var field;
    var arrF = [];
    
    $("#tableOrder thead th").each(function(x){
      if ($(this).attr('sort')) {
        sort = $(this).attr('sort');
        field = fieldTable[x];
        if (sort) {
          arrF.push(x);
        }
      }
    })  

    if (arrF == 0) {
      field = 'order_id';
      sort = 'DESC';
    }

    var path = '<?php echo admin_url() ?>' + 'pos/print_filtered_order?order_status='+order_status+'&paid_off='+paid_off+'&date_deliver='+date_deliver+'&search='+search+'&date_deliver2='+date_deliver2+'&field='+field+'&sort='+sort+'';
    window.open(path);
  })

  $(window).on('load', function(){
    showLoader('.block-space');
  })

  $(document).ajaxStop(function(){
    removeLoader('.block-space');
  })
</script>