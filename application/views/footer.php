
		<!-- Data Page Dinamis CLOSE -->

		<!-- FOOTER OPEN -->

		<div class="row">
			<div id="footer">
                <div class="row">
                    <div class="" style="color: white">
                                        
                        <div class="col-md-4 footer-div-sub">
                            <div class="footer-sub-head">
                                <h3>Hubungi Kami</h3>
                            </div>
                            <div class="footer-sub-body">
                                <i class="awesome-size fa-map-marker"></i>
                                <span class="footer-text-content">Pusat | Kp. Sanding 2 RT 13/06, Bojongnangka, Gunungputri, Kab. Bogor - 16963 | <a target="_blank" href="https://www.google.com/maps/place/Gonam+Aqiqah/@-6.4247234,106.9156774,15z/data=!4m5!3m4!1s0x0:0x7a1f32b3f536e32d!8m2!3d-6.4247234!4d106.9156774" style="color: white">Lihat Map</a></span>
                            </div>
                            <div class="footer-sub-body">
                                <i class="awesome-size fa-phone"></i>
                                <span class="footer-text-content">0852 8978 1700 , 0857 1008 3893</span>
                            </div>
                            <div class="footer-sub-body">
                                <i class="awesome-size fa-whatsapp"></i>
                                <span class="footer-text-content">Whatsapp | 0852 8978 1700 | <a target="_blank" href="https://api.whatsapp.com/send?phone=6285289781700&text=Tuliskan Pesan Anda" style="color: white">Kirim Chat</a></span>
                            </div>
                            <div class="footer-sub-body">
                                <i class="awesome-size  fa-envelope-o"></i>
                                <span class="footer-text-content">Email | gonamaqiqah@gmail.com</span>
                            </div>
                        </div>
                        <div class="col-md-4 footer-div-sub border-left border-right">
                            <div class="footer-sub-head">
                                <h4>Agen Bogor Cibinong</h4>
                            </div>
                            <div class="footer-sub-body ">
                                <i class="awesome-size fa-map-marker"></i>
                                <span class="footer-text-content">Jln.Raya Mayor Oking, Ciriung RT 05 RW 01 Cibinong Bogor Belakang Alfamidi Ciriung</span>
                            </div>
                            
                            <div class="footer-sub-head">
                                <h4>Agen Bogor Ciluar</h4>
                            </div>
                            <div class="footer-sub-body">
                                <i class="awesome-size fa-map-marker"></i>
                                <span class="footer-text-content">Jln. Mandala ll, Bogor Utara, Kota Bogor, Belakang SMAN 8 Kota  Bogor</span>
                            </div>
                            


                        </div>
                        <div class="col-md-4 footer-div-sub">
                            
                            <div class="footer-sub-head">
                                <h4>Agen Bekasi Bantar Gebang</h4>
                            </div>
                            <div class="footer-sub-body">
                                <i class="awesome-size fa-map-marker"></i>
                                <span class="footer-text-content">Jalan Yon Armed VII, Cikiwul, Kota Bekasi, Jawa Barat</span>
                            </div>
                            <div class="footer-sub-body">
                                <i class="awesome-size fa-phone"></i>
                                <span class="footer-text-content">Phone | Whatsapp | 081314826767</span>
                            </div>

                            <div class="footer-sub-head">
                                <h4>Agen Bekasi Jatiasih</h4>
                            </div>
                            <div class="footer-sub-body">
                                <i class="awesome-size fa-map-marker"></i>
                                <span class="footer-text-content">Jalan Swatantra II Gg Thamran No 35 Jatiasih Bekasi</span>
                            </div>
                            


                        </div>
                    </div>
                </div>
			</div>
		</div>

		<!-- FOOTER CLOSE -->
        <div class="row">
            <div id="bottom-footer">
                <p>Copyright © 2017, Gonam Aqiqah | Develop By Gonam Group</p>
            </div>
        </div>


</div>



<script type="text/javascript">
$('.after').bootstrapNumber();
$('.colorful').bootstrapNumber({
	
});
    


    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top
            }, 1000);
        }
    });




    function ajax_rq2(param_url){
        var param_url = param_url;
        $.ajax({
            url:param_url,
            method:"POST",
            data:{ajax_request:"true"},
            success:function(data){
                $('#ajax_content').replaceWith(data);
                 window.history.pushState('','null', url);
            }
        })
    }


    function load_history(){
    var param_url = window.location.href;
    $.ajax({
        url:param_url,
        method:"POST",
        data:{ajax_request:"true"},
        success:function(data){
            $('#ajax_content').replaceWith(data);

        }
    })
}

window.addEventListener('popstate', function() {
    load_history();
});



$(document).on("click",".ajax_nav", function(e){
	$("#ajax-loading").show();
    var url = $(this).attr("href");
    e.preventDefault();
    $.ajax({
        method:"POST",
        url:url,
        data:{ajax_request:"true"},
        success:function(data){
        	$("#ajax-loading").hide();
            $('#ajax_content').replaceWith(data);
             window.history.pushState('','null', url);
        }
    })
})
</script>

<script type="text/javascript">
$('.clock-picker').clockpicker({
    placement: 'bottom',
    align: 'right',
    donetext: 'Done',
    autoclose: true,
    'default': 'now'
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.date-picker').datepicker({dateFormat: 'yy-mm-dd',minDate:1});
	})
</script>



<script type="text/javascript">
	$(document).ready(function(){

	
	})

    var getCart = ()=> {
    $.ajax({
      url : '<?php echo base_url() ?>' + 'product/get_cart',
      method : 'POST',
      success : function(jsonData){
        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          $(".cartN").html(dataObj.data);
        }        
      }
    })
  }
  $(window).on("load", function(){
    getCart();
  })

</script>
</body>
</html>