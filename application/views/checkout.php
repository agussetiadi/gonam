<div class="row">
	<div class="container">
		<div class="block-white">

            <div class="row">
                <div class="m-10 row">
    				<div class="col-md-3">Nama Pemesan</div>
                    <div class="col-md-9"><input type="text" class="input-text-12" name="" disabled="" value="<?php echo $query['name'] ?>"></div>
                </div>

                <div class="m-10 row">
    				<div class="col-md-3">No. Tlp</div>
                    <div class="col-md-9"><input type="text" id="phone" class="input-text-12" name="" <?php echo $query['phone'] ?>></div>
                </div>

                <div class="m-10 row">
    				<div class="col-md-3">Tanggal Kirim</div>
                    <div class="col-md-4"><input type="text" id="date_deliver" class="input-text-12 date-picker" name=""  placeholder="Tanggal"></div>
                
                    <div class="col-md-4"><input type="text" id="time_deliver" class="input-text-12 clock-picker" name=""  placeholder="Jam"></div>
                </div>

                <div class="m-10 row">
    				<div class="col-md-3">Provinsi</div>
        			<div class="col-md-9"><select class="selectpicker" id="provinsi" data-live-search="true">
                        <option value="">Pilih Provinsi</option>
                        <option value="32">JAWA BARAT</option>
                        <option value="31">DKI</option>
                        <option value="36">BANTEN</option>
        			</select></div>
                </div>

                <div class="m-10 row">
    				<div class="col-md-3">Kabupaten</div>
        			<div class="col-md-9"><select class="selectpicker" id="kabupaten" data-live-search="true">
        				</select></div>	
                </div>

                <div class="m-10 row">
    				<div class="col-md-3">Kecamatan</div>
        			<div class="col-md-9"><select class="selectpicker" id="kecamatan" data-live-search="true">
        				</select></div>
                </div>

                <div class="m-10 row">
    				<div class="col-md-3">Alamat Lengkap</div>
    				<div class="col-md-9"><textarea class="form-control" id="address"></textarea></div>
                </div>

                <div class="m-10 row">
    				<div class="col-md-3">Catatan</div>
    				<div class="col-md-9"><textarea class="form-control" id="information" placeholder="Catatan unutk penjual"></textarea>
                    </div>
                </div>
					
			<br>
            <div class="col-md-12">
			 <button class="btn-order" id="btnSave">Kirim Order <span class="fa fa-sign-out"></span></button>
            </div>

            </div>


		</div>
	</div>
</div>

<script type="text/javascript">

	$('.selectpicker').selectpicker();

	var renderProvinsi = ()=>{
		$.ajax({
        url:'<?php echo base_url() ?>'+"wilayah/provinsi",
        method:"POST",
        data:{},
        success:function(data_html){
          $("#provinsi").html(data_html)
          $("#provinsi").selectpicker('refresh');
          $("#kabupaten").html("");
          $("#kecamatan").html("");
        }
      })
	}	

	/*$(window).on("load", function(){
		renderProvinsi();
	})*/

	$(document).on("change", "#provinsi", function(){
    var data_send = $(this).val();
      $.ajax({
        url:'<?php echo base_url() ?>'+"wilayah/kabupaten",
        method:"POST",
        data:{provinsi_id:data_send},
        success:function(data_html){
          $("#kabupaten").html(data_html)
          $("#kecamatan").html("");
          $("#kabupaten").selectpicker('refresh');
          $("#kecamatan").selectpicker('refresh');
        }
      })
    })


    $(document).on("change", "#kabupaten", function(){
      var data_send = $(this).val();
      $.ajax({
        url:'<?php echo base_url() ?>'+"wilayah/kecamatan",
        method:"POST",
        data:{kabupaten_id:data_send},
        success:function(data_html){
          $("#kecamatan").html(data_html)
          $("#kecamatan").selectpicker('refresh');
        }
      })
    })

    $(document).on("click","#btnSave", function(){
        
    	var phone = $("#phone").val();
    	var date_deliver = $("#date_deliver").val();
    	var time_deliver = $("#time_deliver").val();
    	var provinsi_id = $("#provinsi").val();
    	var kabupaten_id = $("#kabupaten").val();
    	var kecamatan_id = $("#kecamatan").val();
    	var address = $("#address").val();
    	var information = $("#information").val();

    	var objSend = {
			phone : phone,
	    	date_deliver : date_deliver,
	    	time_deliver : time_deliver,
	    	provinsi_id : provinsi_id,
	    	kabupaten_id : kabupaten_id,
	    	kecamatan_id : kecamatan_id,
	    	address : address,
	    	information : information
    	}

    	if (phone == "") {
    		swal("Warning !","No telp tidak boleh kosong");
    		return false;
    	}
    	if (date_deliver == "") {
    		swal("Warning !","Tanggal tidak boleh kosong");
    		return false;
    	}
    	if (time_deliver == "") {
    		swal("Warning !","Jam tidak boleh kosong");
    		return false;
    	}
    	if (provinsi_id == "") {
    		swal("Warning !","Provinsi tidak boleh kosong");
    		return false;
    	}
    	if (kabupaten_id == "") {
    		swal("Warning !","Kabupaten tidak boleh kosong");
    		return false;
    	}
    	if (address == "") {
    		swal("Warning !","Alamat Lengkap tidak boleh kosong");
    		return false;
    	}
        btnLoader('#btnSave');
    	$.ajax({
    		url : '<?php echo base_url() ?>' + 'product/cart_ok',
    		method : 'POST',
    		data : objSend,
    		success : function(jsonData){
                btnLoader('#btnSave');
    			var dataObj = JSON.parse(jsonData);
    			var data = dataObj.data;
    			if (dataObj.status == 'ok') {
    				document.location = '<?php echo base_url() ?>' + 'product/order?init='+data.no_trx;
                    
    			}
    		}
    	})
    })

</script>
