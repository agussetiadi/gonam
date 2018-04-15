 <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>Gonam Aqiqah &copy; 2017-2019</p>
                </div>
                <div class="col-sm-6 text-right">
                  <p>Powered By <a href="https://bootstrapious.com/admin-templates" class="external">Agus Setiadi</a></p>
                  <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>

<script type="text/javascript">

if ($(window).width() <= 500) {
  $(".block-space").css('overflow-y','scroll');
}

  $('.datepicker').datepicker({
    dateFormat: 'yy-mm-dd'
  });
  $('.clockpicker').clockpicker({
        placement: 'bottom',
        align: 'right',
        donetext: 'Done',
        autoclose: true,
        'default': 'now'
    });
  $('.number').number(true);

  $('.selectpicker').selectpicker();


  /*Render Notif Admin*/
  $(window).on("load", function(){
    $.ajax({
      url : '<?php echo admin_url() ?>' + 'notification/get_notif',
      method : 'POST',
      data : {},
      success : function(data){
        $("#numNotif").html(data);
      }
    })
  })


  $(document).on("click", "#notifications", function(){
    $.ajax({
      url : '<?php echo admin_url() ?>' + 'notification/render_notif',
      method : 'POST',
      data : {},
      success : function(dataHtml){
        $("#wNotif").html(dataHtml)
      }
    })
  })


</script>




  </body>
</html>