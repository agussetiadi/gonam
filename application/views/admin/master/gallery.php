<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Data Gallery</h2></div>
          <div class="col-md-6">
            <button id="btnAdd" class="btn btn-primary" style="float:right;"><span class="fa fa-plus"></span> Tambah Baru</button>
          </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->

<div class="container-fluid top-bottom">
    <div class="row">
        <div class="col-md-12">
          <div class="block-space">

            <div class="row" >
              <div class="col-md-3">
                <select class="custom-select" id="image_category">
                  <option value="all">Tampilkan Semua</option>
                  <option value="posting">Posting Blog</option>
                  <option value="gallery">Posting Gallery</option>
                </select>
              </div>
              <div class="col-md-9"></div>
            </div>

              <div class="" id="wrap-image" style="column-width: 200px;">
                
              </div>

          </div>
        </div>
    </div>
</div>

<!-- Modal -->

<div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="file_bg">
              <form method="POST" id="formImage" enctype="multipart/form-data">
                <input type="file" name="picture_init" id="file">
              </form>

              <div class="form-group" style="margin-top: 50px;">
                <label for="slc">Kategori Gambar</label>
                <select id="slc" class="custom-select image_category_add" style="">
                  <option value="posting">Posting Blog</option>
                  <option value="gallery">Posting Gallery</option>
                </select>
              </div>

              <input type="hidden" class="src" name="src">
              <input type="hidden" class="image_thumb" name="image_thumb">
            </div>
            <div id="wraperImg">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-info btn-primary" id="bAdd"><span class="fa fa-save"></span> Simpan</button>
        </div>
            </form>


    </div>
  </div>
</div>


<div id="modal2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">View Image</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">

        </div>
        <div class="modal-footer">
            
        </div>
            </form>


    </div>
  </div>
</div>


<script type="text/javascript">
  
  var image_category = $("#image_category").val();
  var loadImage = (category)=> {
    $("#wrap-image").html('<div class="loader"></div>')
    $.ajax({
      url : '<?php echo admin_url() ?>' + 'master/gallery_select_all',
      method : 'POST',
      data : {image_category : image_category},
      success : function(jsonData){
        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          var data = dataObj.data;
          var setHtml = '';
          Object.keys(data).forEach(function(key){
            setHtml += '<div style="position : relative">'
            setHtml += '<img class="img-thumbnail data-img" data-value="'+data[key].image_post_id+'" style="width:100%; cursor:pointer; margin:5px 0px" src="<?php echo base_url() ?>assets/img/post_img/'+data[key].image_thumb+'">';
            setHtml += '<button class="bDelImg btn btn-danger btn-sm" data-value="'+data[key].image_post_id+'"><span class="fa fa-trash"></span></button>';
            setHtml += '</div>';
          });

          $("#wrap-image").html(setHtml);

        }

      }
    })
  }
  loadImage(image_category);




  $(document).on("change", "#image_category", function(){
    image_category = $("#image_category").val();
    loadImage(image_category);
  })

  $(document).on("click","#btnAdd", function(){
    $("#modal1").modal("show");
  })



  $(document).on("change","#file",function(){

    var xhrTarget = '<?php echo admin_url()."master/gallery_generate_picture/" ?>';

    sendImage("#formImage","#file", xhrTarget ,function(result){
      if (result.status == 'ok') {
        $(".imgRes").remove();
        $("#file").after('<div class="imgRes"><img style="width:100%" src="<?php echo base_url() ?>assets/img/post_img/'+result.data+'"><br><a href="#" class="imgDel">Hapus</a></div>');
        $(".src").val(result.data);
        $(".image_thumb").val(result.thumb);
        console.log(result)
      }
      else{
        swal('File Tidak Falid !!!');
      }
    });
  })

  $(document).on("click", ".imgDel", function(){
    $(".src").val('');
    $(".image_thumb").val('');
    $(".imgRes").remove();
  })


  $(document).on("click","#bAdd", function(){


    var src = $(".src").val();
    var image_thumb = $(".image_thumb").val();
    var image_category_add = $(".image_category_add").val();

    image_category = $("#image_category").val();
    if (src == "") {
      return false;
    }
    btnLoader(this);

    $.ajax({

      url : '<?php echo admin_url() ?>'+'master/add_gallery',
      method : 'POST',
      data : {src : src, image_thumb : image_thumb,image_category : image_category_add},
      success : function(jsonData){

        btnRemoveLoader('#bAdd','<span class="fa fa-save"></span> Simpan');

        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          $("#modal1").modal('hide');
          loadImage(image_category);
          $(".src").val('');
          $(".image_thumb").val('');
          $(".imgRes").remove();
        }
      }
    })

  })

  $(document).on("click", ".bDelImg", function(){

    var alertObj = {
      title : 'Yakin Ingin Menghapus ?',
      text : 'Data akan terhapus dari DATABASE !!!'
    }

    image_category = $("#image_category").val();
    var bDelImg = $('.bDelImg');
    var index = bDelImg.index(this);
    var valId = bDelImg.eq(index).attr('data-value');
    
    dataAlert(alertObj, function(){    
      $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/delete_gallery',
        method : 'POST',
        data : {image_post_id : valId},
        success : function(jsonData){
          var dataObj = JSON.parse(jsonData);
          if (dataObj.status == 'ok') {
            loadImage(image_category);
          }
        }
      })
    })

  })

  $(document).on("click", ".data-img", function(){
    var dataImg = $(".data-img");
    var index = dataImg.index(this);
    var valId = dataImg.eq(index).attr('data-value');
    $("#modal2").modal("show");
    
    showLoader('#modal2 .modal-body');

    $.ajax({
      url : '<?php echo admin_url() ?>' + 'master/get_gallery',
      method : 'POST',
      data : {image_post_id : valId},
      success : function(jsonData){

        removeLoader('#modal2 .modal-body');

        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          $("#modal2 .modal-body").html('<img style="width : 100%;" src="<?php echo base_url() ?>assets/img/post_img/'+dataObj.data.src+'">');
        }
      }
    })

  })


</script>