	
	<div class="row">
		<div class="col-md-12">
			<div class="block-white">
				<div class="row">
					<div class="col-md-6">
						<h4 style="margin: 0 15px 0 0; font-weight: bold; float: left; color: #D41016;">Filter By Category</h4>
						<?php foreach ($queryCategory->result_array() as $key => $value) { ?>
							<button class="btnOptionsProduct responsive-p filtered-btn-p" data-value="<?php echo $value['category_id'] ?>"><?php echo $value['category_name'] ?></button>
						<?php } ?>
					</div>
					<div class="col-md-2">
						<div class="selector filtered-sort-p">
							<select class="form-control" id="sortBy">
								<option>Urutkan</option>
								<option value="cheapest">Termurah</option>
								<option value="popular">Terpopuler</option>
							</select>
						</div>

					</div>
					<div class="col-md-4">
						<input id="keyWord" type="text" name="" style="width: 65%" class="input-text-12 filtered-text-p" placeholder="Cari Product/Layanan">
						<div class="btn-daftar filtered-search-p" style="width: 30%; float: right;"><a id="btnFilter" href="#"><span class="fa fa-search"></span> Cari</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			
			<div class="block-white">
				
				<div id="replaceData">

		<!-- this to replace Data -->

				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(".wrap-paket-header img").each(function(x){
		var img_p = $("wrap-paket-header img");
		var $this = $(this);
        if ($this.width() > $this.height()) {
            img_p.css({"height":"100%"})
        }
        else{
            img_p.css("width","100%")  
        }
	})

	$(document).on("click", ".btnOptionsProduct", function(){
		var btnOptionsProduct = $(".btnOptionsProduct");
		var index = btnOptionsProduct.index(this);

		if ($(".opBtnProduct").length == 0) {
			btnOptionsProduct.addClass('opBtnProduct');
			btnOptionsProduct.eq(index).removeClass('opBtnProduct');
		}
		else{		
			if (btnOptionsProduct.eq(index).hasClass('opBtnProduct') == true) {
				btnOptionsProduct.eq(index).removeClass('opBtnProduct');
			}
			else{
				btnOptionsProduct.eq(index).addClass('opBtnProduct');
			}
		}
		$("#keyWord").val('');
		showLoader("#replaceData")
		renderData();


	})

	var renderData = ()=>{
		var getCategory = $(".btnOptionsProduct");

		var category = [];
		getCategory.each(function(x){
			if (getCategory.eq(x).hasClass('opBtnProduct') == false) {
				category.push(getCategory.eq(x).attr('data-value'));
			}
		})
		


		var sortBy = $("#sortBy").val();
		var keyWord = $("#keyWord").val();
		$.ajax({
			url : '<?php echo base_url() ?>' + 'product/render_data',
			method : 'POST',
			data : {
				category_id : category,
				key_word : keyWord,
				sort : sortBy
			},
			success : function(jsonData){
				var dataObj = JSON.parse(jsonData);
				var data = dataObj.data;
				var htmlData = "";
				Object.keys(data).forEach(function(key){


				

					htmlData += '<div class="col-md-2 list-order">';
					htmlData += '<div class="row">';
					htmlData += '<div class="wrap-paket" data-value="'+data[key].product_id+'">';
					
					htmlData += '<div class="wrap-paket-header">';
					htmlData += '<img class="img-responsive" src="'+data[key].product_picture+'">';
					htmlData += '</div>';
					htmlData += '<div class="wrap-paket-body">';
					htmlData += '<h4 style="margin: 0; color: #1ca3db;" class=""><b style="margin: 0">'+data[key].product_name+'</b></h4>';
					htmlData += '<p><i>';
					htmlData += data[key].product_menu.substring(0,50);
					htmlData += '</i>';
					htmlData += '</p>';
					htmlData += '<p class="p-sub">';
					htmlData += data[key].product_info.substring(0,85);
					htmlData += '</p>';
					htmlData += '</div>';
					htmlData += '<hr style="margin:0">';
					htmlData += '<div class="wrap-paket-footer">';
					htmlData += '<h4 style="margin: 0; color:#D41016 "><b>Rp. '+$.number(data[key].product_price)+'</b></h4>';
					htmlData += '</div>';
					htmlData += '</div>';
					htmlData += '</div>';
					htmlData += '</div>';

				})
					removeLoader('#replaceData');
					
					$("#replaceData").html(htmlData);
			}
		})
	}

	$(document).on('click', "#btnFilter", function(e){
		e.preventDefault();
		showLoader('#replaceData');
		renderData();
	})

	$(document).on("change","#sortBy",function(){
		showLoader("#replaceData")
		renderData();
	})

	$(window).on("load", function(){
		showLoader('#replaceData');
		renderData();	
	})

	$(document).on("click", ".wrap-paket", function(){
		var wrapPaket = $(".wrap-paket");
		var index = wrapPaket.index(this);
		var valId = wrapPaket.eq(index).attr('data-value');
		redirect = '<?php echo base_url() ?>' + 'product/detail/'+valId;
		document.location = redirect;
	})

</script>