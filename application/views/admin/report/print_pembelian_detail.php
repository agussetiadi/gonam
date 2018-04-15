<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Penjualan Harian</title>

    <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" />
    <script src="<?php echo base_url()."assets/admin_panel/" ?>js/jquery.js"> </script>
    <script src="<?php echo base_url()."assets/admin_panel/js/helper.js" ?>" type="text/javascript"></script>
    <script src="<?php echo base_url()."assets/admin_panel/" ?>js/jquery.number.min.js"></script>
</head>
<body>

<div class="row">
<div class="row">
    

<div class="container">

        <table style="width: 100%;  margin-bottom: 30px;" id="table1">
        <tr>
            <td width="100px" style="padding-right: 20px;">
                <img src="<?php echo base_url()."assets/img/system/logo.png" ?>" style="width: 100%; display: block;">
            </td>
            <td>
                <div>
                    
                    <b>Gonam Sentra Aqiqah</b><br>
                    Kp. Sanding 2 RT 13/06,<br>
                    Bojongnangka, Gunungputri, Bogor<br>
                    Phone. 0852 8978 1700
                    
                </div>
            </td>
            <td style="text-align: center;">
                <h4>PENJUALAN HARIAN</h4>
                Tgl Print <?php echo str_replace("-", "/", date("Y-m-d H:s")) ?><br>
            </td>
            <td style="padding-left: 10px;">
                <div style="text-align: right;">
                    Periode <?php echo str_replace("-", "/", $dateStart); ?><br>
                    s/d <?php echo str_replace("-", "/", $dateEnd); ?><br>
                    Printed by <?php echo $this->session_admin->admin_name() ?>
                </div>
            </td>
        </tr>
    </table>
    <table class="table" id="tableRender">
        <thead>
            <th>Tanggal</th>
            <th>Item Terjual</th>
            <th>Jumlah Transaksi</th>
            <th>Total Transaksi</th>
            <th>Total Bayar Masuk</th>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    <table width="200px" style="float: right;">
        <tr>
            <td>Jumlah Item</td>
            <td> : </td>
            <td id="total_item"></td>
        </tr>
        <tr>
            <td>Total Pengeluaran</td>
            <td> : </td>
            <td id="total_out"></td>
        </tr>
        <tr>
            <td>Total Dibayar</td>
            <td> : </td>
            <td id="total_paid"></td>
        </tr>
    </table>
</div>

</div>
</div>

    <input type="hidden" name="" value="<?php echo $dateStart; ?>" id="dateStart">
    <input type="hidden" name="" value="<?php echo $dateEnd; ?>" id="dateEnd">
    <input type="hidden" name="" value="<?php echo $sortBy; ?>" id="sortBy">

<script type="text/javascript">

$(window).on("load", function(){
    var dateStart = $("#dateStart").val();
    var dateEnd = $("#dateEnd").val();
    var sortBy = $("#sortBy").val();

    btnLoader(this,'Prosess');

    $.ajax({
      url : '<?php echo admin_url() ?>' + 'report/pembelian_detail_render',
      method : 'POST',
      data : {
        dateStart : dateStart,
        dateEnd : dateEnd,
        sortBy : sortBy
      },
      success : function(resultJson){

        btnRemoveLoader("#bProcess",'<span class="fa fa-refresh"></span> Prosess');

        var result = JSON.parse(resultJson);
        renderTable("#tableRender", result.data);
        $("#total_item").html(result.total_item);
        $("#total_out").html($.number(result.total));
        $("#total_paid").html($.number(result.total_paid));

        window.print();
      }
    })
  })

</script>


</body>
</html>