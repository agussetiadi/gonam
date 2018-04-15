<script src="<?php echo base_url() ?>assets/admin_panel/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.responsive.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/responsive.bootstrap4.js"></script>

<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Kelola Blog</h2></div>
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

    <table id="lookup" class="table">
        <thead>
            <th>No.</th>
            <th>Nama Product</th>
            <th>Menu Product</th>
            <th>Harga Jual</th>
            <th>Harga Modal</th>
            <th>Kategory</th>
            <th>Tampilkan</th>
            <th width="50px"></th>
        </thead>
        <tbody>
        
        </tbody>
    </table>



<!-- Modal Start -->

<div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
        <form id="formAdd" method="POST" enctype="multipart/form-data">
            <table width="100%" class="table-form">
                <tr>
                    <td width="130px">Nama Produk</td>
                    <td> : </td>
                    <td>
                    <input type="text" class="form-control form-control-sm" name="product_name" placeholder="Tuliskan nama produk" required=""></td>
                </tr>
                <tr>
                    <td>Menu Produk</td>
                    <td> : </td>
                    <td>
                        <textarea class="form-control" id="product_menu" name="product_menu" placeholder="Tuliskan menu produk" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Satuan</td>
                    <td> : </td>
                    <td>
                        <select class="custom-select unit_id" style="margin: 0" id="unit_id" name="unit_id">
                            
                        </select>
                        <a href="#" data-toggle="modal" data-target="#modal2">Tambah Satuan</a>
                    </td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td> : </td>
                    <td>
                        <select class="custom-select category_id" id="category_id" name="category_id" style="margin: 0;">
                            
                        </select>
                        <a href="#" data-toggle="modal" data-target="#modal3">Tambah Kategori</a>
                    </td>
                </tr>
                <tr>
                    <td>Foto Produk</td>
                    <td> : </td>
                    <td>
                        <input type="file" id="picture_init" name="picture_init">
                        <input type="hidden" id="product_picture" name="product_picture">
                    </td>
                </tr>
                <tr>
                    <td>Harga Jual</td>
                    <td> : </td>
                    <td><input type="number" class="form-control form-control-sm" name="product_price" placeholder="Tuliskan harga Jual" required=""></td>
                </tr>
                <tr>
                    <td>Harga Modal</td>
                    <td> : </td>
                    <td><input type="number" class="form-control form-control-sm" name="product_hpp" placeholder="Tuliskan harga modal" required=""></td>
                </tr>
                <tr>
                    <td>Info Produk</td>
                    <td> : </td>
                    <td>
                        <textarea name="product_info" class="form-control summernote" placeholder="Tuliskan info produk"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td> : </td>
                    <td>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="is_publish" value="1" class="pemotongan custom-control-input" id="is_publish1"> <label class="custom-control-label" for="is_publish1">Publikasikan di Halaman Pengunjung</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input checked="" type="radio" name="is_publish" value="0" class="pemotongan custom-control-input" id="is_publish2"> <label class="custom-control-label" for="is_publish2">Hanya Tampil di Halaman Admin</label>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
        <div class="modal-footer">
            <button class="btn btn-info btn-primary" id="bAdd"><span class="fa fa-save"></span> Simpan</button>
        </div>
            </form>


    </div>
  </div>
</div>


<div id="modal4" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
        <form id="formUpdate" method="POST" enctype="multipart/form-data">
            <table width="100%" class="table-form">
                <tr>
                    <td width="130px">Nama Produk</td>
                    <td> : </td>
                    <td>
                    <input type="hidden" class="form-control form-control-sm" id="product_id" name="product_id">
                    <input type="text" class="form-control form-control-sm" id="product_name_update" name="product_name" placeholder="Tuliskan nama produk" required=""></td>
                </tr>
                <tr>
                    <td>Menu Produk</td>
                    <td> : </td>
                    <td>
                        <textarea class="form-control" id="product_menu_update" name="product_menu" placeholder="Tuliskan menu produk"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Satuan</td>
                    <td> : </td>
                    <td>
                        <select class="custom-select unit_id" id="unit_id_update" style="margin: 0" name="unit_id">
                            
                        </select>
                        <a href="#" data-toggle="modal" data-target="#modal2">Tambah Satuan</a>
                    </td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td> : </td>
                    <td>
                        <select class="custom-select category_id" name="category_id" id="category_id_update" style="margin: 0;">
                            
                        </select>
                        <a href="#" data-toggle="modal" data-target="#modal3">Tambah Kategori</a>
                    </td>
                </tr>
                <tr>
                    <td>Foto Produk</td>
                    <td> : </td>
                    <td>
                        <input type="file" id="picture_init_update" name="picture_init">
                        
                        <input type="hidden" id="product_picture_update" name="product_picture">
                    </td>
                </tr>
                <tr>
                    <td>Harga Jual</td>
                    <td> : </td>
                    <td><input type="number" id="product_price_update" class="form-control form-control-sm" name="product_price" placeholder="Tuliskan harga Jual" required=""></td>
                </tr>
                <tr>
                    <td>Harga Modal</td>
                    <td> : </td>
                    <td><input type="number" id="product_hpp_update" class="form-control form-control-sm" name="product_hpp" placeholder="Tuliskan harga modal" required=""></td>
                </tr>
                <tr>
                    <td>Info Produk</td>
                    <td> : </td>
                    <td>
                        <textarea name="product_info" id="product_info_update" class="form-control summernote" placeholder="Tuliskan info produk"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td> : </td>
                    <td>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="is_publish" value="1" class="custom-control-input" id="is_publish3"> <label class="custom-control-label" for="is_publish3">Publikasikan di Halaman Pengunjung</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="is_publish" value="0" class="custom-control-input" id="is_publish4"> <label class="custom-control-label" for="is_publish4">Hanya Tampil di Halaman Admin</label>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
        <div class="modal-footer">
            <button class="btn btn-info btn-primary" id="bUp"><span class="fa fa-save"></span> Update</button>
        </div>
     </form>


    </div>
  </div>
</div>

<div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Satuan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label>Nama Satuan</label>
                <input type="text" class="form-control form-control-sm" id="unit_name" name="" placeholder="Tuliskan nama satuan">
            </div>
            <button class="btn btn-primary btn-sm" id="bSaveSatuan"><span class="fa fa-save"></span> Simpan</button>
        </div>


    </div>
  </div>
</div>

<div id="modal3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah Kategori</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" class="form-control form-control-sm" id="category_name" name="" placeholder="Tuliskan nama kategori">
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" name="is_publish" value="1" class="custom-control-input" id="is_publish5"> <label class="custom-control-label" for="is_publish5">Publikasikan di Halaman Pengunjung</label>
            </div>
            <div class="custom-control custom-radio">
                <input checked="" type="radio" name="is_publish" value="0" class="custom-control-input" id="is_publish6"> <label class="custom-control-label" for="is_publish6">Hanya Tampil di Halaman Admin</label>
            </div>
            <button class="btn btn-primary btn-sm" id="bSaveKategori"><span class="fa fa-save"></span> Simpan</button>
        </div>


    </div>
  </div>
</div>



<!-- Modal END -->




          </div>
        </div>
    </div>
</div>

<script>

var dataTable = $('#lookup').DataTable( {
    "processing": true,
    "serverSide": true,
    "searching": true,
    "responsive": true,
    "ajax":{
        url :"<?php echo admin_url()."master/product_all" ?>", // json datasource
        type: "POST",  // method  , by default get
        error: function(){  // error handling
            $(".lookup-error").html("");
            $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
            $("#lookup_processing").css("display","none");
            
        }
    }
});
$("#lookup_length select").addClass("custom-select").css('height','35px');


var renderSatuan = (selector)=>{
    

        $.ajax({
            url : '<?php echo admin_url() ?>' + 'master/render_satuan',
            method : 'POST',
            data : {},
            success : function(dataJson){
                var dataObj = JSON.parse(dataJson);
                var data = dataObj.data;
                var status = dataObj.status;
                var option = "";
                Object.keys(data).forEach(function(key){
                    option += '<option value="'+data[key].unit_id+'">'+data[key].unit_name+'</option>';
                })
                $(selector).html(option);
            }
        })
    
}

var renderCategory = (selector)=>{
    

        $.ajax({
            url : '<?php echo admin_url() ?>' + 'master/render_category',
            method : 'POST',
            data : {},
            success : function(dataJson){
                var dataObj = JSON.parse(dataJson);
                var data = dataObj.data;
                var status = dataObj.status;
                var option = "";
                Object.keys(data).forEach(function(key){
                    option += '<option value="'+data[key].category_id+'">'+data[key].category_name+'</option>';
                })
                $(selector).html(option);
            }
        })
    
}


$(window).on("load", function(){
    if ($(".unit_id option").length == 0) {
        renderSatuan(".unit_id");
    }
    if ($(".category_id option").length == 0) {
        renderCategory(".category_id");
    }
})

$(document).on("click", "#bSaveSatuan", function(){
    var unit_name = $("#unit_name").val();
    if (unit_name == "") {
        return false;
    }
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/save_satuan',
        method : 'POST',
        data : {unit_name : unit_name},
        success : function(jsonData){
            var dataObj = JSON.parse(jsonData);
            if (dataObj.status == 'ok') {
                renderSatuan(".unit_id");
                $("#modal2").modal("hide");
            }
        }
    })
})

$(document).on("click", "#bSaveKategori", function(){
    var category_name = $("#category_name").val();
    var is_publish5 = $("#is_publish5").prop('checked');
    var is_publish6 = $("#is_publish6").prop('checked');
    
    if (is_publish5 == true) {
        var is_publish = 1;
    }
    else{
        var is_publish = 0;
    }

    if (category_name == "") {
        return false;
    }
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/save_category',
        method : 'POST',
        data : {category_name : category_name, is_publish : is_publish},
        success : function(jsonData){
            var dataObj = JSON.parse(jsonData);
            if (dataObj.status == 'ok') {
                renderCategory(".category_id");
                $("#modal3").modal("hide");
            }
        }
    })
})

$(document).on("click","#btnAdd", function(){
    
    $("#modal1").modal("show");
})

$(document).on("submit", "#formAdd", function(e){
    e.preventDefault();
    

    btnLoader("#bAdd");

    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/add_product',
        method : 'POST',
        data : new FormData(this),
        contentType : false,
        processData : false,
        success : function(data){
            
        btnRemoveLoader('#bAdd','<span class="fa fa-save"></span> Simpan');

            var dataObj = JSON.parse(data);
            if (dataObj.status == 'ok') {
                $("#modal1").modal('hide');
                dataTable.ajax.reload();
                $("#modal1 input").val('');
                $(".imgRes").remove();
            }
        }
    })
})

$(document).on("submit", "#formUpdate", function(e){
    e.preventDefault();
    btnLoader("#bUp");
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'master/update_product',
        method : 'POST',
        data : new FormData(this),
        contentType : false,
        processData : false,
        success : function(data){
        btnRemoveLoader('#bUp','<span class="fa fa-save"></span> Simpan');
            var dataObj = JSON.parse(data);
            if (dataObj.status == 'ok') {
                $("#modal4").modal('hide');
                dataTable.ajax.reload();
            }
        }
    })


})



$(document).on("change","#picture_init",function(){
    var xhrTarget = '<?php echo admin_url()."master/product_generate_picture/" ?>';
    sendImage('#formAdd',"#picture_init",xhrTarget, function(data){
        if (data.status == 'ok') {
            $(".progress").remove();
            $(".imgRes").remove();
            $("#product_picture").val(data.data);
            $("#picture_init").val("");
            $("#formAdd #picture_init").after('<div class="imgRes"><img style="width : 200px" src="<?php echo base_url()."assets/img/post_img/" ?>'+data.data+'"><br><a href="#" class="delPic">hapus</div></div>')
        }
        else{
            swal("Failed" ,"Gagal upload , file tidak falid", "error")
            $(".progress").remove();
            $("#picture_init").val("");
        }
    });
})

$(document).on("change","#picture_init_update",function(){
    var xhrTarget = '<?php echo admin_url()."master/product_generate_picture/" ?>';
    sendImage('#formUpdate',"#picture_init_update",xhrTarget,function(data){
       if (data.status == 'ok') {
            $(".progress").remove();
            $(".imgRes").remove();
            $("#product_picture_update").val(data.data);
            $("#picture_init_update").val("");
            $("#formUpdate #picture_init_update").after('<div class="imgRes"><img style="width : 200px" src="<?php echo base_url()."assets/img/post_img/" ?>'+data.data+'"><br><a href="#" class="delPic">hapus</div></div>')
        }
        else{
            swal("Failed" ,"Gagal upload , file tidak falid", "error")
            $(".progress").remove();
            $("#picture_init_update").val("");
        } 
    });
})


$(document).on("click","#modal1", function(){
    if ($("body").hasClass("modal-open") == false) {
        $("body").addClass("modal-open")
    }
})

$(document).on("click","#modal4", function(){
    if ($("body").hasClass("modal-open") == false) {
        $("body").addClass("modal-open")
    }
})

$(document).on("click",".delPic", function(){
    $("#product_picture").val("");
    $("#product_picture_update").val("");
    $(this).remove();
    $(".imgRes").remove();
})

$(document).on("click",".bEdit", function(){
    var bEdit = $(".bEdit");
    var index = bEdit.index(this);
    var product_id = bEdit.eq(index).attr("data-value");
    var modalSelector = "#modal4";

    $("#modal4").modal("show");

    $("#unit_id_update option").removeAttr("selected");
    $("#category_id_update option").removeAttr("selected");
    $(".imgRes").remove();

    showLoader(modalSelector + " .modal-body");
    $.ajax({
        url : '<?php echo admin_url() ?>'+'master/get_edit_product',
        method : 'POST',
        data : {product_id : product_id},
        success : function(jsonData){

            removeLoader(modalSelector + " .modal-body");

            var dataObj = JSON.parse(jsonData);
            if (dataObj.status == 'ok') {

                var data = dataObj.data;
                $("#product_name_update").val(data.product_name);
                $("#product_menu_update").val(data.product_menu);
                $("#unit_id_update option[value="+data.unit_id+"]").attr("selected","");
                $("#category_id_update option[value="+data.category_id+"]").attr("selected","");

                if (data.product_picture !== "") {
                    $(modalSelector+" #picture_init_update").after('<div class="imgRes"><img style="width : 200px" src="<?php echo base_url()."assets/img/post_img/" ?>'+data.product_picture+'"><br><a href="#" class="delPic">hapus</div></div>')
                }

                $("#product_picture_update").val(data.product_picture);
                $("#product_price_update").val(data.product_price);
                $("#product_hpp_update").val(data.product_hpp);
                $("#product_info_update").val(data.product_info);
                $("#product_id").val(data.product_id);

                $("#modal4 is_publish").removeAttr('checked');
                if (data.is_publish == 1) {
                    $("#is_publish3").attr('checked','');
                }
                if (data.is_publish == 0) {
                    $("#is_publish4").attr('checked','');
                }

                if (data.product_info == "") {
                    $("#modal4 .note-editable").html('<p></p><br>');
                }
                else{
                    $("#modal4 .note-editable").html(data.product_info);   
                }


            }
        }
    })

})


$(document).on("click",".bDel", function(){
    var bDelete = $(".bDel");
    var index = bDelete.index(this);
    var product_id = bDelete.eq(index).attr("data-value");
    alertObj = {
        title : "Yakin Ingin Menghapus ?",
        text : "Data akan terhapus dari system"
    }

    dataAlert(alertObj, function(){
        $.ajax({
            url : '<?php echo admin_url() ?>'+'master/delete_product',
            method : 'POST',
            data : {product_id : product_id},
            success : function(jsonData){
                var dataObj = JSON.parse(jsonData);
                if (dataObj.status == 'ok') {
                    dataTable.ajax.reload();
                }
            }
        })
    })

})

    $('.summernote').summernote({
      height: 250,
    });
</script>