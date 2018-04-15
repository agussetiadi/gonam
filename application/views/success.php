<div class="row">
<div class="container">
    <div class="row">

        <div class="col-md-12">
        <div class="col-md-8 border-small div-m-scroll" style="padding: 15px 10px;">
            <div class="col-md-6">
                <div style="height: 150px;">
                    <img src="<?php echo base_url()."assets/img/Logo-02.png" ?>" style="display: block;width: 50%;">
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

            </div>
            <div class="col-md-6">
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
                        </div>
                    </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <div class="div-print">
                <div class="row">
                    <ul>
                    <li>Simpan sebagai bukti pemesanan</li>
                    <li>Admin kami akan segera menghubungi anda</li>
                    <li>Jika dalam 30 menit tidak ada respon<br>anda bisa menghubungi ke nomor 081919835585 <a href="tel:085289781700"> Telp (klick disini) </a> / <a href="https://api.whatsapp.com/send?phone=6285289781700&text=Pemesanan Nomor Order <?php echo $query['order_id'] ?> Harap Segera Di Respon">Whatsapp (klick disini)</a></li>
                    </ul>
                    <div class="col-md-6">
                        <a target="_blank" href="<?php echo base_url() ?>order/printf?init=<?php echo base64_encode($query['order_id']); ?>">
                        <button class="user-btn-print"><span class=" glyphicon glyphicon-print" style="margin-right: 10px"></span>Print</button>
                        </a>
                    </div>
                    <div class="col-md-6">
                    <a target="_blank" href="<?php echo base_url() ?>order/print_pdf?init=<?php echo base64_encode($query['order_id']); ?>">
                        <button class="user-btn-print"><span class=" glyphicon glyphicon-floppy-save" style="margin-right: 10px"></span> Save PDF</button>
                    </a>
                    </div>
                </div>
            </div>
        </div>
        </div>

        </div>
</div>
</div>
</div>