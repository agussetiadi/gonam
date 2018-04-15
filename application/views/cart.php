
		<div class="row">
			<div class="col-md-12" style="margin-top: 15px;">
				<div class="head-cart">
					<div class="cart-center-info">
						<img src="<?php echo base_url()."assets/img/shopping-cart-01.png" ?>">
					</div>
					<div class="cart-btn-right">
						
					</div>
				</div>
			</div>
		</div>

		<div class="row">

		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<?php 
					if ($cart_num == 0) {
						echo '<img src="'.base_url()."assets/img/cart_kosong.png".'" style="width:80%;">';
					}

					?>
					<div class="block-white">
						<div id="cart-block" style="min-height: 200px;">
						<h4>Detail Order</h4><hr>
							<div id="wrapCart"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
			<div class="col-md-4">
				<div class="div-cart-total" style="margin-top: 15px;">
					<h4>REKAP BELANJA</h4>
					<div class="rekap-item">
						<div class="row">
							<div class="col-md-6">Total Belanja</div>
							<div class="col-md-6"><b id="subtotal"></b></div>
						</div>
					</div>
					<div class="rekap-item">
						<div class="row">
							<div class="col-md-6">Diskon</div>
							<div class="col-md-6" id="discount"><b style="color: #b10a0a;"></b></div>
						</div>
					</div>
					<div class="rekap-item">
						<div class="row">
							<div class="col-md-6">Ongkos Kirim</div>
							<div class="col-md-6"><b style="color: #b10a0a;">Gratis</b></div>
						</div>
					</div>
					<div class="rekap-item">
						<div class="row">
							<div class="col-md-6">Grand Total</div>
							<div class="col-md-6"><b style="color: #b10a0a;" id="grand_total"></b></div>
						</div>
					</div>
				</div>

				<div style="margin-top: 15px;">
					<div class="cart-btn-left">
						<a class="btn-left hover-none" href="<?php echo base_url()."product" ?>">Pesan Lagi</a>
						<a class="btn-left-m hover-none" href="<?php echo base_url()."product" ?>">Pesan Lagi</a>
					</div>
					<?php 
					if ($cart_num > 0) { ?>
					<button class="btn-right hover-none btnCheckOut">Selesai</button>
					<button class="btn-right-m hover-none btnCheckOut">Selesai</button>
					<?php } ?>
				</div>


			</div>
		</div>
		



<div id="modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <span style="font-size: 18px;" class="modal-title"><b></b></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="wrapRegister">
				<div class="head-register text-bold">Login User</div>
					<img style="cursor: pointer;" id="bGoogle" class="btn-register-login" src="<?php echo base_url()."assets/img/btn-google.png" ?>">
					<div id="wLoader1" style="width: 150px; position: relative"></div>
				<div style="margin-top: 15px;"></div>
					<img style="cursor: pointer;" id="bFacebook" class="btn-register-login" src="<?php echo base_url()."assets/img/btn-fb.png" ?>">
					<div id="wLoader2" style="height: 50px; width: 150px; position: relative"></div>
				<div class="info-register"></div>
			</div>
        </div>

    </div>
  </div>
</div>

<script type="text/javascript">
$('.af').bootstrapNumber();

var renderOrder = (callback1)=>{
	showLoader("#wrapCart");
	$.ajax({
		url : '<?php echo base_url() ?>' + 'product/get_cart_order',
		method : 'POST',
		data : {},
		success : function(jsonData){
			removeLoader("#wrapCart");
			var dataObj = JSON.parse(jsonData);

			if (dataObj.status == 'ok') {


				var dataOrder = dataObj.data.order;					
				var dataOrderDetail = dataObj.data.order_detail;
				var dataHtml = "";
				Object.keys(dataOrderDetail).forEach(function(key){
					    dataHtml += '<div class="row">';
		            	dataHtml += '<div class="col-md-2">';
		            	dataHtml += '<img src="'+dataOrderDetail[key].product_picture+'" class="img-thumbnail" style="width:90px;">';
		            	dataHtml += '</div>';
		            	dataHtml += '<div class="col-md-4">';
		            	dataHtml += '<h4 style="margin:0 0 5px 0">'+dataOrderDetail[key].product_name+'</h4>';
		            	dataHtml += '<p style="font-size:12px; margin:0">'+dataOrderDetail[key].masakan+'</p>';
		            	dataHtml += '<p>Rp. '+$.number(dataOrderDetail[key].sales_price)+'</p>';
		            	dataHtml += '</div>';
		            	dataHtml += '<div class="col-xs-4">';
		            	dataHtml += '<input min="1" data-value="'+dataOrderDetail[key].product_id+'" type="number" style="width:80px; margin-right:10px;" value="'+dataOrderDetail[key].order_qty+'" class="form-control order_qty" name="">';
		            	dataHtml += '</div>';
		            	dataHtml += '<div class="col-md-2">';
		            	
		            	dataHtml += '<button class="btn btn-danger btnDeleteCart float-right" data-value="'+dataOrderDetail[key].product_id+'">';
		            	dataHtml += '<span class="fa fa-trash"></span>';
		            	dataHtml += '</button></div></div><hr>';
		            		
				})
				$("#subtotal").html('Rp. '+$.number(dataOrder.subtotal));
				$("#discount").html('Rp. '+$.number(dataOrder.discount));
				$("#grand_total").html('<h4 style="color:#1ca3db; font-weight : bold; margin : 0;">Rp. '+$.number(dataOrder.grand_total)+'</h4>');
				$("#wrapCart").replaceWith('<div id="wrapCart">'+dataHtml+'</div>');
				
				getCart();

			}

			if (callback1) {
				callback1(dataObj);
			}
		}
	})
}

renderOrder();

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
					$("#modal1").modal("show");
				}
				if (data.login == 'success') {
					document.location = '<?php echo base_url() ?>' + 'product/checkout';
				}
			}
		}
	})

})

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


$(document).on("change", ".order_qty", function(){
	var order_qty = $(".order_qty");
	var index = order_qty.index(this);

	var product_id = $('.order_qty').eq(index).attr('data-value');
	var order_qty = $('.order_qty').eq(index).val();
	var state = 'cartWindow';

	addToCart({
	product_id : product_id,
	order_qty : order_qty,
	state : state
	}, function(dataObj){
		if (dataObj.status == 'ok') {
			
			renderOrder();
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
			data : {product_id : product_id},
			success : function(jsonData){
				var dataObj = JSON.parse(jsonData);

				if (dataObj.status == 'ok') {
					btnRemoveLoader('#btnCart','Tambahkan ke keranjang <span class="fa fa-shopping-cart"></span>');
					renderOrder(function(dataObj){
						var dataOrderDetail = dataObj.data.order_detail;
						var numDetailOrder = Object.keys(dataOrderDetail).length;
						if (numDetailOrder == 0) {
							$(".btnCheckOut").hide()
						}
					});
				}
			}
		})
	})
})

	var render_url = (callback)=>{
		$.ajax({
			url : '<?php echo base_url() ?>' + 'login/get_auth_url',
			method : 'POST',
			data : {},
			success : function(jsonData){
				btnRemoveLoader('#wLoader1');
				var dataObj = JSON.parse(jsonData);
					if (callback)
					callback(dataObj);

			}
		})
	}
	$(document).on("click", "#bGoogle", function(){
		btnLoader('#wLoader1','Redirect..');
			render_url(function(dataObj){
				var data = dataObj.data;
				var path = data.googleAuth

				document.location = path;
			})		
	})


	$(document).on("click", "#bFacebook", function(){
		btnLoader('#wLoader2','Redirect..');
			render_url(function(dataObj){
				var data = dataObj.data;
				var path = data.facebookAuth;
				document.location = path;
			})		
	})	


</script>