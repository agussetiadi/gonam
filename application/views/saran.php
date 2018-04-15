<div class="ajax_load">

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/summernote.js"></script>
<div class="row">
<div class="col-md-12">
		<div class="col-md-6">
			<form class="form_saran" action="<?php echo base_url()."user/send_saran/" ?>">
			<label>Isi Teks</label>
			 <textarea id="summernote" name="saran"></textarea>
			 <button class="div-lainnya2">Kirim</button>
			 </form>
		</div>
		<div class="col-md-6">
			<ul style="margin-top: 30px;">
				<li>Kami berharap masukan/saran dari anda untuk pengembangan sistem kami kedepannya</li>
				<li>Saran/masukan yang anda kirim akan kami tampung untuk kita pelajari lagi</li>				
				<li>Bijaksana dalam menulis dan gunakan bahasa yang sopan</li>				
			</ul>
		</div>

</div>

<script type="text/javascript">
	  $('#summernote').summernote({
        	height: 200,
        });


	 function ajax_rq2(param_url){
      var param_url = param_url;
      $.ajax({
        url:param_url,
        method:"POST",
        data:{ajax_request:"true"},
        success:function(data){
          $('.ajax_load').replaceWith(data);
          window.history.pushState('','null', param_url);
        }
      })
    }


	  $(document).on("submit",".form_saran",function(f){
      f.preventDefault();
      var url_form = $(this).attr("action");
      $.ajax({
        url:url_form,
        method:"POST",
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data){
          var jsonData = JSON.parse(data);
          if (jsonData.status == "success") {
          	swal("Berhasil", "Saran/masukan Anda Berhasil Terkirim", "success");
            
              ajax_rq2(jsonData.redirect);
            
          }

        }
      })
    })

</script>
</div>
</div>