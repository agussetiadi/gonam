<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>

    <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" />
    <style type="text/css">
        body{
            font-family: helvetica;
        }
        table{
            font-size: 12px;
        }
/*        div {
            -ms-transform: rotate(90deg); 
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
        }*/
        #head-template{
            width: 100%;
            display: block;
        }
        .table_print{
            width: 100%;
            border-style: none;

        }
        .table_print td{
            padding: 3px;
        }
    </style>
</head>
<body>

<div class="container" style="">

        <div class="col-md-12">
        <div class="col-md-12 border-small" style="padding: 15px 10px;">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 200px;">
                        <img style="width: 150px;" src="<?php echo base_url()."assets/img/Logo-02.png" ?>">
                    </div>
                </div>
                <p><b>CUSTOMER DETAIL</b></p>
                <table>
                    <tr>
                        <td width="40%">Nama</td>
                        <td width="10%">:</td>
                        <td width="50%"><?php echo $query['costumer_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Telp</td>
                        <td>:</td>
                        <td><?php echo $query['phone'] ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $query['address'] ?></td>
                    </tr>
                    <tr>
                        <td>Estimasi</td>
                        <td>:</td>
                        <td><?php echo $query['estimate_deliver'] ?></td>
                    </tr>
                   <tr>
                        <td>Nomor</td>
                        <td>:</td>
                        <td><?php echo $query['order_id'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><?php echo date("Y-m-d") ?></td>
                    </tr>
                </table>
                </table>


            </div>
            <div class="col-md-6" style="height: 100px;">
            
            </div>
                      <div class="col-md-12" style="margin-top: 30px;">
                        <table class="table">
                            <tr>
                                <th>Item</th>
                                <th>Jumlah</th>
                                <th>Hrg Satuan</th>
                                <th>Diskon</th>
                                <th width="20%">Ket</th>
                                <th>Subtotal</th>
                            </tr>
                         <?php 
                        foreach ($query1 as $key => $value) { ?>
                            
                            <tr>
                                
                                <td><?php echo $value['kambing_type']." / ".$value['kambing_gender'] ?></td>
                                <td><?php echo $value['kambing_qty'] ?> Ekor</td>
                                <td><?php echo "Rp. ".number_format($value['hrg_satuan']) ?> </td>
                                <td><?php echo "Rp. ".number_format($value['okd_diskon'])." " ?></td>
                                <td><?php if (!empty($menu[$key])) { 
                                         foreach ($menu[$key] as $key_menu => $value_menu) {
                                            echo $value_menu['menu']." , ";
                                                } ?>   
                                        <?php } ?>
                                 </td>
                                <td><?php echo "Rp. ".number_format($value['subtotal'])." " ?></td>
                            </tr>
                            <?php } ?>
                            <?php 
                            foreach ($query2 as $key2 => $value2) { ?>
                            <tr>
                                <td><?php echo $value2['product_type'] ?></td>
                                <td><?php echo $value2['product_qty'] ?></td>
                                <td><?php echo "Rp. ".number_format($value2['hrg_satuan']) ?></td>
                                <td><?php echo "Rp. ".number_format($value2['opd_diskon']) ?></td>
                                <td><?php echo $value2['product_menu']; ?></td>
                                <td><?php echo "Rp. ".number_format($value2['subtotal_product'])." " ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4"></td>
                                <td style="line-height: 2">DISKON<br>TOTAL</td>
                                <td style="line-height: 2"><?php echo "Rp. ".number_format($query['potongan'])  ?><br><?php echo "Rp. ".number_format($query['total'])  ?></td>
                            </tr>
                            
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                
                        <h3>Gonam Sentra Aqiqah </h3>
                        <p>Office :<br>Kp. Sanding 2 RT 13/06,
                        Bojongnangka, Gunungputri, Bogor - 16963 <br> Telp : 0852 8978 1700 / 0857 1008 3893</p>
                            </div>
                            <div class="col-md-6">
                                <img style="width: 100px; float: right;" src="<?php echo base_url()."assets/img/qr_code/".$query['order_id'].".png" ?>">
                            </div>

                        </div>
                    </div>
        </div>

        </div>
</div>

<script type="text/javascript">
    window.print();
</script>
</body>
</html>
