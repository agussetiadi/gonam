<div class="ajax_load">
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/summernote.js"></script>
  <label>Riwayat Testimoni Saya</label>
  <?php foreach ($query as $key => $value) {
    
  ?>
    <p><?php echo $value['testi_isi'] ?></p>
    <hr>
  <?php } ?>
	<form method="POST" enctype="multipart/form-data">

    <label style="margin-top: 25px;">Isi Testimoni Baru</label>
	  <textarea id="summernote" name="data"></textarea>

      <div class="result_upload">
            
      </div>

      
    </form>

    <input type="button" class="div-lainnya2" name="submit" value="kirim" style="margin-top: 50px;">
  <script>
    $(document).ready(function() {
      var base_url = "<?php echo base_url() ?>"
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

        $('#summernote').summernote({
        	height: 400,
        });



        


        /*
        Kirim data 
        */
        $('input[name=submit]').click(function(x){
          x.preventDefault();
          $('.progress-content').show();
          var info = $('#testi_info').val();
          var post = $('#summernote').val();
            $.ajax({
              url:base_url+"user/testimoni_post/",
              method:"POST",
              data:{request:"ajax_request",posting:post,testi_info:info},
              success:function(d){
                $('.progress-content').hide();
                jsonData = JSON.parse(d);

                if (jsonData.status == "success") {
                  swal("Terimakasih" ,"Testimoni anda akan segera kami tanggapi", "success")
                  ajax_rq2(base_url+'user/testimoni/');
                }
                else{
                    if (jsonData.report == "bad") {
                      swal("Oops Terjadi Masalah" ,"Tampaknya sistem kami sedang maintenance", "error")
                    }
                    else if(jsonData.report == "validate"){
                      swal("Validasi" ,"Data tidak valid", "error") 
                    }
                }
              }
            })
        })


    });
  </script>
</div>