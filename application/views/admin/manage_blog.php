<script type="text/javascript" src="<?php echo base_url()."assets/admin_panel/js/table-data.js" ?>"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Blog Editor</h2></div>
        <div class="col-md-6">
        </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->

<div class="container-fluid top-bottom">
  <div class="row">
    <div class="col-md-12">
      <div class="block-space">

        <form method="POST" id="formBlog" action="<?php echo base_url()."admin/blog/add/" ?>" enctype="multipart/form-data">
        <div class="form-group">
          <label>Judul</label>
          <input type="hidden" name="blog_id" id="blog_id" class="form-control" value="<?php echo $blog_id ?>">
          <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul" required="">
        </div>

        <div class="form-group">
          <label>Content</label>
          <textarea class="summernote form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi"></textarea>
        </div>

        <div class="form-group">
          <label>Hastag <i>(Pisahkan dengan tanda koma)</i></label>
          <input type="text" name="hastag" id="hastag" class="input-text-12">
        </div>
        <div class="form-group">
          <label>Meta Description <i>(kosongkan jika tidak diisi)</i></label>
          <input type="text" id="meta_des" name="meta_des" class="input-text-12" placeholder="Deskripsi untuk optimasi SEO, usahakan kata tidak di ulang">
        </div>

        <div class="form-group">
          <label>Format</label>

            <select name="format" id="format" class="custom-select">
              <option value="sale">Promosi</option>
              <option value="artikel">Artikel Biasa</option>
            </select>
        </div>

        <div class="form-group">
          <label>Sisipkan Daftar Harga</label><br>
          <select name="category_id" class="custom-select" id="category_id">
            <option value="0">- Tidak -</option>
            <?php foreach ($query_category as $key => $value) { ?>
            <option value="<?php echo $value['category_id'] ?>"><?php echo $value['category_name'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Status Postingan</label>
          
            <select name="status" class="custom-select" id="status">
              <option value="publish">Publish</option>
              <option value="draft">Simpan Sebagai Draft</option>
            </select>
        </div>

        <button id="btn-posting" name="" class="btn btn-info" value="Posting">Posting</button>
        </form>


      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
      var dataAlert = (data,callback,callback2) => {
      if (typeof data.title == 'undefined') {
        var title = "Title Alert";
      }
      else{
        var title = data.title; 
      }
      if (typeof data.text == 'undefined') {
        var text = "Text Alert";
      }
      else{
        var text = data.text;
      }

      swal({
        title: title,
        text: text,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: true
      },
        function(isConfirm){
          if (isConfirm) {
                
              if (callback)
                callback();

          } else {
            if (callback2)
                callback2();
          }
        });

    }


    $('.summernote').summernote({
      height: 400,
    });


    function loadImg(){
      $("#wraperImg").html('<img id="loader" style="display: block; margin: auto; margin-top: 50px" src="<?php echo base_url()."assets/img/loader.gif" ?>">');
      $.ajax({
        url:"<?php echo admin_url()."blog/get_img_post" ?>",
        method:"POST",
        data:{},
        success:function(data){
          $('.note-editor .modal-body #wraperImg').html(data)
          //$('#loader').hide()
        }
      })
    }


    $(document).on("click", ".note-insert .note-btn ", function(){
      var oldFileForm = $(".modal-body .note-group-select-from-files");
      var noteBtn = $(".note-insert .note-btn");

      var htmlAppend = '<div class="col-md-12" style="margin-bottom:50px;"><div class="file_bg"><form method="POST" id="formImage" enctype="multipart/form-data"><input type="file" name="file_init" id="file"></form></div></div><div class="col-md-12"><div id="wraperImg"></div></div>';

      if ($(".modalWrapImg").length == 0) {
        oldFileForm.after('<div class="modalWrapImg"></div>')  
        oldFileForm.remove();
        $(".note-editor .modal-body .modalWrapImg").append(htmlAppend);

        


      }


      var index = noteBtn.index(this);



      if (index == 1) {
        if ($(".modalWrapImg").length > 0) {
          
            loadImg();
        }

      $(".note-group-image-url").hide();

      }

    })

    $(document).on("click", ".img-select", function(){
      var imgSelect = $(".img-select");
      var index = imgSelect.index(this);
      var thisAttr = imgSelect.eq(index).attr("src");

      $('.note-image-url').val(thisAttr);
      $('.btn-primary').removeAttr("disabled");
      $('.btn-primary').removeClass("disabled");
      

      imgSelect.removeClass("light_select");
      imgSelect.eq(index).addClass("light_select");

    })


        $(document).on("change","#file",function(){

          var formImage = $('#formImage')[0];
          var pr = '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div></div>';
           $('.note-editor .modal-body #wraperImg').html(pr);

            $.ajax({
              url:"<?php echo admin_url()."blog/upload_image/" ?>",
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
                  $(".progress-bar").css("width", percentage+"%");
                  $(".progress-bar").html(percentage+"%");



                }
                return xhr;
              },
              success:function(data){
                $(".progress").remove();
                var jsonData = JSON.parse(data);
                var status = jsonData.status;
                var image = jsonData.image;
                  if (status == "ok") {

                    //swal("Success" ,"Berhasil upload , data ditambahkan ke gallery, klik icon picture pada text editor", "success")
                    loadImg();
                  }
                  else{
                    swal("Failed" ,"Gagal upload , file tidak falid", "error")
                  }

                  $('#file').val("");
              }
            })
        })

var renderBlog = (blog_id)=>{
  $.ajax({
    url : '<?php echo admin_url() ?>' + 'blog/get_blog',
    method : 'POST',
    data : {blog_id : blog_id},
    success : function(jsonData){
      var dataObj = JSON.parse(jsonData);
      var data = dataObj.data;
        $("#judul").val(data.judul);
        $("#deskripsi").val(data.deskripsi);
        $(".note-editable").html(data.deskripsi);
        $("#hastag").val(data.hastag);
        $("#meta_des").val(data.meta_des);

        var dataFormat = data.format != "" ? data.format : 0;
        var dataHarga = data.category_id != "" ? data.category_id : 0;
        var dataStatus = data.status != "" ? data.status : 0;

        $("#format option[value="+dataFormat+"]").attr("selected","");
        $("#category_id option[value="+dataHarga+"]").attr("selected","");
        $("#status option[value="+dataStatus+"]").attr("selected","");


    }
  })
}

$(window).on("load", function(){
  var blog_id = $("#blog_id").val();
  if (blog_id !== "") {
    renderBlog(blog_id);

  }
})


var saveBlog = (callback)=>{

    var dataForm = $("#formBlog")[0];
    blog_id = $("#blog_id").val();
    var judul = $("#judul").val();
    var deskripsi = $("#deskripsi").val();
    var hastag = $("#hastag").val();
    var format = $("#format").val();
    var category_id = $("#category_id").val();
    var status = $("#status").val();
    var meta_des = $("#meta_des").val();

    var objInsert = {
      blog_id : blog_id,
      judul : judul,
      deskripsi : deskripsi,
      hastag : hastag,
      format : format,
      category_id : category_id,
      status : status,
      meta_des : meta_des
    }
    var target = "";

    if (blog_id == "") {
      target = "add";
    }
    else{
      target = "update"; 
    }

    $.ajax({
      url : '<?php echo admin_url() ?>' + 'blog/'+target,
      method : 'POST',
      data : objInsert,
      success : function(jsonData){
        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          if (callback)
            callback('ok',dataObj.slug);
          
        }
        if (dataObj.status == 'required') {
          for (var i = 0; i < dataObj.message.length; i++) {
            $(".wrap-alert").append('<div class="alert alert-danger">'+dataObj.message[i]+'</div>');
          }
          setTimeout(function(){
            $(".wrap-alert").html('');

          },1500)

          if (callback)
            callback('required');

        }
      }
    })
}


$(document).on("click","#btn-posting", function(e){
  e.preventDefault();
  var alertInit = {
    title : "Yakin Ingin Memposting ?",
    text : "Postingan akan tersimpan kedatabase!"
  }
  dataAlert(alertInit, function(){
  $("#btn-posting").html("Processing");
  $("#btn-posting").append('<img id="loader" src="<?php echo base_url()."assets/img/system/ajax-loader.gif" ?>">');
    saveBlog(function(status,slug){
        if (status == 'ok') {
          window.open('<?php echo base_url() ?>'+'post/'+slug);
          document.location = '<?php echo admin_url() ?>'+'blog';
        }
        if (status == 'required') {
          $("#btn-posting").html('Posting');
        }

    })
  })
})
</script>