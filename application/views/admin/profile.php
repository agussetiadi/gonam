<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Profile Admin</h2></div>
          <div class="col-md-6">
            <div id="wrapImg"></div>
          </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->

<div class="container-fluid top-bottom">
    <div class="row">
        <div class="col-md-4">
          <div class="block-space">

          <div style="position: absolute;">
            <button class="btn btn-info btn-sm" style="position: absolute;"><span class="fa fa-pencil"></span> Ganti</button>
            <form id="formUpdate" method="POST" enctype="multipart/form-data" style="position: absolute;">
              <div style="position: relative; width: 250px;">
              <input type="file" id="fil_pp" style=" opacity: 0; cursor: pointer;" name="fil_pp">
              </div>
            </form>
          </div>
          <img width="100%" id="imgWrapResult" src="<?php echo base_url()."assets/img/admin/".$query['admin_foto'] ?>">
          <div id="wBtn" style="display: none;">
            <button type="submit" id="bSave" class="btn btn-info form-control" data-value="<?php echo $query['admin_id'] ?>">Simpan</button>
            <button type="submit" id="bCancel" class="btn btn-danger form-control" data-value="<?php echo $query['admin_id'] ?>">Batal</button>
          </div>
          <input type="hidden" name="" id="image_new">
          <input type="hidden" name="" id="image_old" value="<?php echo $query['admin_foto'] ?>">
          </div>
        </div>
        <div class="col-md-8">
          <div class="row">
            
            <div class="col-md-12">
              <div class="block-space">

                <table style="width: 100%">
                  <tr>
                    <td width="180px">Username</td>
                    <td> : </td>
                    <td>

                      <input type="text" class="form-control form-control-sm" name="" id="username" value="<?php echo $query['username'] ?>">
                    </td>
                  </tr>
                </table>
                <button style="margin-top: 20px; float: right;" id="btnUsername" class="btn btn-sm btn-info"><span class="fa fa-save"></span> Simpan</button>
                <div style="clear: both;"></div>
              </div>
            </div>


            <div class="col-md-12" style="margin-top: 20px;">
              <div class="block-space">

                <table style="width: 100%">
                  <tr>
                    <td width="180px">Nama Lengkap</td>
                    <td> : </td>
                    <td>
                      <input type="text" class="form-control form-control-sm" name="" id="first_name" value="<?php echo $query['first_name'] ?>">
                    </td>
                  </tr>
                </table>
                <button id="btnFisrtname" style="margin-top: 20px; float: right;" class="btn btn-sm btn-info"><span class="fa fa-save"></span> Simpan</button>
                <div style="clear: both;"></div>
              </div>
            </div>

            <div class="col-md-12" style="margin-top: 20px;">
              <div class="block-space">
              <b>Ganti Password</b>
                <table style="width: 100%">
                  <tr>
                    <td width="180px">Password Lama</td>
                    <td> : </td>
                    <td>
                      <input type="text" class="form-control form-control-sm" name="" id="pw1" placeholder="masukkan password yang lama">
                    </td>
                  </tr>
                  <tr>
                    <td width="180px">Password Baru</td>
                    <td> : </td>
                    <td>
                      <input type="text" class="form-control form-control-sm" name="" id="pw2" placeholder="masukkan password yang baru">
                    </td>
                  </tr>
                  <tr>
                    <td width="180px">Ulangi Password Baru</td>
                    <td> : </td>
                    <td>
                      <input type="text" class="form-control form-control-sm" name="" id="pw3" placeholder="masukkan password yang baru">
                    </td>
                  </tr>
                </table>
                <button id="btnPassword" style="margin-top: 20px; float: right;" class="btn btn-sm btn-info"><span class="fa fa-save"></span> Simpan</button>
                <div style="clear: both;"></div>
              </div>
            </div>

          </div>
        </div>
    </div>
</div>


<script type="text/javascript">

var sendImage = (form,selector,xhrTarget,callback)=>{

    var formImage = $(form)[0];
    var pr = '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div></div>';
   $(form+" "+selector).after(pr);

    $.ajax({
      url:xhrTarget,
      method:"POST",
      data: new FormData(formImage),
      contentType:false,
      processData:false,
      xhr:function(){
        var xhr = new XMLHttpRequest();
        xhr.upload.onprogress = function(progress){
          var percentage = Math.floor(100 / (progress.total / progress.loaded));
          console.log(progress.total+","+progress.loaded);
          console.log(percentage);

          /*Progress Bar*/
          $(form +" .progress-bar").css("width", percentage+"%");
          $(form +" .progress-bar").html(percentage+"%");



        }
        return xhr;
      },
      success:function(jsonData){
        $(form+" .progress").remove();
        $(form+" "+selector).val("");
        var jsonData = JSON.parse(jsonData);
            if (callback)
            callback(jsonData);

      }
    })
  }


  var render_akun = (callback)=> {

      $.ajax({
      url : '<?php echo admin_url() ?>' + 'profile/render_akun',
      method : 'POST',
      data : {},
      success : function(jsonData){
        var dataObj =  JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          var data = dataObj.data;
          if (callback)
            callback(data);
        }        
      }
    })
  }


/*  $(window).on('load', function(){
    render_akun(function(data){

    })
  })*/
  var pathImage = '<?php echo base_url() ?>assets/img/admin/';


  $(document).on("change", "#fil_pp", function(){
    var form = "#formUpdate";
    var selector = "#fil_pp";
    var xhrTarget = '<?php echo admin_url() ?>' + 'profile/upload_image';
    sendImage(form,selector,xhrTarget,function(resultObj){
      if (resultObj.status == 'ok') {

        $("#imgWrapResult").attr('src', pathImage + resultObj.data);
        $("#image_new").val(resultObj.data);
        $("#wBtn").show();
      }
    });
  })

  $(document).on("click", "#bCancel", function(){
    $("#wBtn").hide();
    $("#image_new").val('');
    var imageOld = $("#image_old").val();
    $("#imgWrapResult").attr('src', pathImage + imageOld);
  })

  $(document).on("click", "#bSave", function(){
    var imageNew = $("#image_new").val();

    $.ajax({
      url : '<?php echo admin_url() ?>' + 'profile/save_image',
      method : 'POST',
      data : {admin_foto : imageNew},
      success : function(jsonData){
        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          $("#wBtn").hide();
          $("#image_old").val(imageNew);
          $("#image_new").val('');
          $("#imgWrapResult").attr('src', pathImage + imageNew);
          swal("Foto berhasil di ganti");

          var thumb = imageNew.replace('.','_thumb.');
          $("#fImgAdmin").attr('src',pathImage + thumb);
          
        }
      }
    })
  })

  $(document).on("click", "#btnPassword", function(){
    var pw1 = $("#pw1").val();
    var pw2 = $("#pw2").val();
    var pw3 = $("#pw3").val();

    if (pw1 == "" || pw2 === "" || pw3 === "" ) {
      return false;
    }

    $.ajax({
      url : '<?php echo admin_url() ?>' + 'profile/change_password',
      method : 'POST',
      data : {password : pw1, pw2 : pw2, pw3 : pw3},
      success : function(jsonData){
        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          document.location = '<?php echo admin_url() ?>';
        }
        if (dataObj.status == 'notValid') {
          swal('Password Lama Tidak Valid !!');
        }
        if (dataObj.status == 'notMatch') {
          swal('Password Baru Tidak Match !!');
        }
      }
    })

  })


  $(document).on("click","#btnFisrtname", function(){
    var first_name = $("#first_name").val();

    $.ajax({
      url : '<?php echo admin_url() ?>' + 'profile/change_name',
      method : 'POST',
      data : {first_name : first_name},
      success : function(jsonData){
        var dataObj =  JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          swal('Nama Berhasil Di Update !!!');
          $("#fAdminName").html(first_name);
        }
      }
    })

  })


  $(document).on("click","#btnUsername", function(){
    var username = $("#username").val();
    $.ajax({
      url : '<?php echo admin_url() ?>' + 'profile/change_username',
      method : 'POST',
      data : {username : username},
      success : function(jsonData){
        var dataObj =  JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          swal('Username Berhasil Di Update !!!');
        }
        if (dataObj.status == 'notValid') {
          swal('Username Sudah Dipakai !!!'); 

        }
      }
    })
  })

</script>