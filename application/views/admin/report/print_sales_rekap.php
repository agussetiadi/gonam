<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Penjualan Rekap</title>

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
                <h4>PENJUALAN REKAP</h4>
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
            <th>No</th>
            <th>No Transaksi</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Jumlah Item</th>
            <th>Discount</th>
            <th>Subtotal</th>
            <th>Grand Total</th>
            <th>Dibayar</th>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    <table width="400px" style="float: right;">
        <tr>
            <td>Jumlah Item</td>
            <td> : </td>
            <td id="total_item"></td>
        </tr>
        <tr>
            <td>Jumlah Pesanan</td>
            <td> : </td>
            <td id="total_order"></td>
        </tr>
        <tr>
            <td>Total Per Kategory</td>
            <td> : </td>
            <td id="category"></td>
        </tr>
        <tr>
            <td>Total Discount</td>
            <td> : </td>
            <td id="total_discount"></td>
        </tr>
        <tr>
            <td>Total Omset</td>
            <td> : </td>
            <td id="total_omzet"></td>
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

        $.ajax({
            url : '<?php echo admin_url() ?>' + 'report/sales_rekap_render',
            method : 'POST',
            data : {
                dateStart : dateStart,
                dateEnd : dateEnd,
                sortBy : sortBy
            },
            success : function(resultJson){

                var result = JSON.parse(resultJson);
                renderTable("#tableRender", result.data);
                    var td = '';
                    Object.keys(result.category).forEach(function(key){
                      td += key + ' ' + result.category[key] + '<br>';
                      
                    })

                    $("#category").html(td);

                $("#total_item").html(result.total_item);
                $("#total_order").html(result.total_order);
                $("#total_discount").html(result.total_discount);
                $("#total_omzet").html($.number(result.grand_total));
                $("#total_paid").html($.number(result.total_paid));

                window.print();

            }
        })


    })
</script>


</body>
</html>