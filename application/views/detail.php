
	<div class="row">
		<div class="col-md-8">
			<div class="block-white">
			<div class="row">

			<!-- START FORM -->
				
			<div class="col-md-4">
				<img src="<?php echo image_exists("assets/img/post_img/",$query['product_picture']) ?>" class="img-responsive">
			</div>
			<div class="col-md-8">
				<h3><b><?php echo $query['product_name'] ?></b></h3>
				<hr>
				<h2><b><?php echo "Rp. ".number_format($query['product_price']) ?></b></h2>
				<span style="padding: 2px 5px; background-color: #f97272; color: white; "><?php echo "Category ".$query['category_name'] ?></span><br>
				<b><i>Stok Tersedia</i></b>
				<hr>
				<p>
					<b><?php echo $query['product_menu']; ?></b>
				</p>
				<p>
					<?php echo $query['product_info']; ?>
				</p>
				<hr>
				<div style="width: 120px">
					<input id="order_qty" type="text" class="colorful form-control" name="" min="1" max="20" value="1">
				</div>
				<hr>

				<button class="btn-order" id="btnCart" data-value="<?php echo $query['product_id'] ?>" style="float: left; margin-right: 10px;">Tambahkan ke keranjang 
				<span class="fa fa-shopping-cart"></span></button>
				
				</div>
			</div>
			<!-- END FORM -->
			</div>
		</div>

		<div class="col-md-4">
			<div class="flow-img">
				<img class="" src="<?php echo base_url()."assets/img/flow_1.png" ?>">
				<h4><i>Pilih Paket<br>Sesuai Kebutuhan</i></h4>
			</div>
			<div class="flow-img">
				<img class="" src="<?php echo base_url()."assets/img/flow_2.png" ?>">
				<h4><i>Isi Detail<br>Pemesanan Anda</i></h4>
			</div>
			<div class="flow-img">
				<img class="" src="<?php echo base_url()."assets/img/flow_3.png" ?>">
				<h4><i>Pilih Lokasi Pengiriman</i></h4>
			</div>
			<div class="flow-img">
				<img class="" src="<?php echo base_url()."assets/img/flow_4.png" ?>">
				<h4><i>Kami Akan Verifikasi<br>Pesanan Anda</i></h4>
			</div>
			<div class="flow-img">
				<img class="" src="<?php echo base_url()."assets/img/flow_5.png" ?>">
				<h4><i>Pesanan Dikirim</i></h4>
			</div>
			
		</div>
</div>


<!-- MOdal -->


<div id="modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <span style="font-size: 18px;" class="modal-title"><b>Keranjang Belanja</b></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            
            <div id="wrapCart"></div>
            <table style="float: right; width: 230px;">
            	<tr>
            		<td style="text-align: left; ">Total Harga</td>
            		<td style="text-align: right;" id="subtotal"></td>
            	</tr>
            	<tr style="text-align: left;">
            		<td>Biaya Kirim</td>
            		<td style="text-align: right;"><b>Gratis</b></td>
            	</tr>
            	<tr style="text-align: left;">
            		<td>Subtotal</td>
            		<td style="text-align: right;" id="grand_total"></td>
            	</tr>
            </table>
            <div style="clear: both;"></div>
        </div>
        <div class="modal-footer">
        	<a href="<?php echo base_url()."product" ?>">
        		<button class="btn btn-primary"><span class="fa fa-shopping-cart"></span> Lanjut Belanja</button>
        	</a>

        	<button class="btn btn-primary btnCheckOut"><span class="fa fa-check"></span> Checkout</button>
        </div>

    </div>
  </div>
</div>

<script type="text/javascript">

var addToCart = (dataObj,callback)=>{
	var product_id = dataObj.product_id;
	var order_qty = dataObj.order_qty;
	var state = dataObj.state;

	$.ajax({
		url : '<?php echo base_url() ?>' + 'product/add_to_cart',
		method : 'POST',
		data : {product_id : product_id,
				order_qty : order_qty,
				state : state
			},
		success : function(jsonData){
			var dataObj = JSON.parse(jsonData);
			if (callback) {
				callback(dataObj);
			}
		}
	})
}


var renderOrder = (order_id,callback)=>{

	$.ajax({
		url : '<?php echo base_url() ?>' + 'product/render_order',
		method : 'POST',
		data : {order_id : order_id},
		success : function(jsonData){
			var dataObj = JSON.parse(jsonData);

			if (dataObj.status == 'ok') {
				var dataOrder = dataObj.data.order;					
				var dataOrderDetail = dataObj.data.order_detail;
				var dataHtml = "";
				dataHtml += '<div class="alert alert-success">Product telah ditambahkan ke Keranjang Belanja<br><a href="<?php echo base_url() ?>product/cart">Lihat Keranjang Belanja</a></div>';
				Object.keys(dataOrderDetail).forEach(function(key){
					    dataHtml += '<div class="row">';
		            	dataHtml += '<div class="col-md-2">';
		            	dataHtml += '<img src="'+dataOrderDetail[key].product_picture+'" class="" style="width:70px;">';
		            	dataHtml += '</div>';
		            	dataHtml += '<div class="col-md-4">';
		            	dataHtml += '<h4 style="margin:0 0 5px 0">'+dataOrderDetail[key].product_name+'</h4>';
		            	dataHtml += '<p style="font-size:12px; margin:0">'+dataOrderDetail[key].masakan+'</p>';
		            	dataHtml += '<p>Rp. '+$.number(dataOrderDetail[key].sales_price)+'</p>';
		            	dataHtml += '</div>';
		            	dataHtml += '<div class="col-md-4">';
		            	dataHtml += '<input min="1" data-value="'+dataOrderDetail[key].product_id+'" type="number" style="width:80px; margin-right:10px" value="'+dataOrderDetail[key].order_qty+'" class="form-control order_qty" name="">';
		            	dataHtml += '</div>';
		            	dataHtml += '<div class="col-md-2">';
		            	dataHtml += '<a href="#">';
		            	dataHtml += '<button class="btn btn-danger btnDeleteCart float-right" data-value="'+dataOrderDetail[key].product_id+'">';
		            	dataHtml += '<span class="fa fa-trash"></span>';
		            	dataHtml += '</button></a></div></div><hr>';
		            		
				})
				$("#subtotal").html('Rp. '+$.number(dataOrder.subtotal));
				$("#grand_total").html('<h4 style="color:#1ca3db; font-weight : bold; margin : 0;">Rp. '+$.number(dataOrder.grand_total)+'</h4>');
				$("#wrapCart").replaceWith('<div id="wrapCart">'+dataHtml+'</div>');
				removeLoader("#modal1 .modal-body");
				getCart();

			}

			if (callback) {
				callback(dataObj);
			}
		}
	})
}


	$(document).on("click", "#btnCart", function(){
		btnLoader(this);
		var product_id = $(this).attr('data-value');
		var order_qty = $("#order_qty").val();
		var state = 'productWindow';
		addToCart({
			product_id : product_id,
			order_qty : order_qty,
			state : state
		}, function(dataObj){
			if (dataObj.status == 'ok') {
				btnRemoveLoader('#btnCart','Tambahkan ke keranjang <span class="fa fa-shopping-cart"></span>')
				$("#modal1").modal('show');
				showLoader("#modal1 .modal-body")
				renderOrder(dataObj.order_id);
			}
		})
	})

	$(document).on("click", ".btnDeleteCart", function(){
		var btnDeleteCart = $(".btnDeleteCart");
		var index = btnDeleteCart.index(this);

		var product_id = $('.btnDeleteCart').eq(index).attr('data-value');
		alertObj = {
			title : 'Yakin Ingin Menghapus ?',
			text : 'Data akan terhapus dari daftar cart anda!'
		}
		dataAlert(alertObj, function(){
			$.ajax({
				url : '<?php echo base_url() ?>' + 'product/delete_cart',
				method : 'POST',
				data : {product_id : product_id },
				success : function(jsonData){
					var dataObj = JSON.parse(jsonData);

					if (dataObj.status == 'ok') {
						btnRemoveLoader('#btnCart','Tambahkan ke keranjang <span class="fa fa-shopping-cart"></span>');
						showLoader("#modal1 .modal-body");
						renderOrder(dataObj.order_id, function(dataObj){
							var dataOrderDetail = dataObj.data.order_detail;
							var numDetailOrder = Object.keys(dataOrderDetail).length;
							if (numDetailOrder == 0) {
								$("#modal1").modal("hide");
							}


						});
					}
				}
			})
		})
	})

	$(document).on("change", ".order_qty", function(){
		var order_qty = $(".order_qty");
		var index = order_qty.index(this);

		var product_id = $('.order_qty').eq(index).attr('data-value');
		var order_qty = $('.order_qty').eq(index).val();
		var state = 'cartWindow';

		showLoader("#modal1 .modal-body");

		addToCart({
		product_id : product_id,
		order_qty : order_qty,
		state : state
		}, function(dataObj){
			if (dataObj.status == 'ok') {
				btnRemoveLoader('#btnCart','Tambahkan ke keranjang <span class="fa fa-shopping-cart"></span>');
				
				renderOrder(dataObj.order_id);
			}
		})
	})

	$(document).on("click", ".btnCheckOut", function(){
	var path = '<?php echo base_url() ?>' + 'product/checkout';

	btnLoader(".btnCheckOut", "Check login..");
	$.ajax({
		url : '<?php echo base_url() ?>' + 'product/check_login',
		method : 'POST',
		data : {redirect : path},
		success : function(jsonData){
			var dataObj = JSON.parse(jsonData)
			if (dataObj.status == 'ok') {
				var data = dataObj.data;
				btnRemoveLoader(".btnCheckOut","Selesai");
				if (data.login == 'required') {
					document.location = '<?php echo base_url() ?>' + 'login/';
				}
				if (data.login == 'success') {
					document.location = '<?php echo base_url() ?>' + 'product/checkout';
				}
			}
		}
	})

})


</script>