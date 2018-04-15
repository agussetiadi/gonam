<script src="<?php echo base_url() ?>assets/admin_panel/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/dataTables.responsive.js"></script>
<script src="<?php echo base_url() ?>assets/admin_panel/js/responsive.bootstrap4.js"></script>
<!-- Page Header-->
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Data Satuan Product</h2></div>
          <div class="col-md-6">
              <button data-toggle="modal" data-target="#modal1" class="btn btn-info" style="float: right;"><span class="fa fa-plus"></span> Tambah Data</button>
          </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->
<div class="container-fluid top-bottom">
    <div class="row">
        <div class="col-md-12">
          <div class="block-space">


	<div class="col-md-12">
		<table class="table" id="lookup">
    <thead>
			<th>Nama</th>
      <th>Isi Testimoni</th>
			<th>Keterangan</th>
			<th>Dibuat</th>
			<th>Publish</th>
			<th width="50px">Action</th>
    </thead>
		<tbody>
      
    </tbody>
		</table>
	</div>

<div id="modal1" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
    <form id="formAdd" enctype="multipart/form-data" method="POST">
      <div class="modal-header">Insert Data</div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Nama User</label>
      		<input class="input-text-12" type="text" name="name" required="">
      	</div>
      	<div class="form-group">
      		<label>Keterangan</label>
      		<input type="text" class="input-text-12" name="testi_ket">
      	</div>
      	<div class="form-group">
      		<label>Isi Testimoni</label>
      		<textarea class="form-control summernote" name="testi_isi" required=""></textarea>
      	</div>
      	<div class="form-group">
      		<label>Gender</label>
      			<select class="custom-select" name="gender">
      				<option value="male">Laki - laki</option>
      				<option value="female">Perempuan</option>
      			</select>
      	</div>

      	<div class="form-group">
      		<label>Foto Pengguna <i> (opsional)</i></label>
      		<input type="file" name="picture_init" id="picture_init">
          <input type="hidden" name="picture" id="picture">
      	</div>
      <div class="form-group">
        <select class="custom-select" name="status_publishing">
          <option value="publishing">Publish</option>
          <option value="waiting">Menunggu</option>
        </select>
      </div>
      </div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-primary" id="btnAddForm">Simpan</button>
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
      </form>
    </div>
  </div>
</div>



<div id="modal2" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
    <form id="formUpdate" enctype="multipart/form-data" method="POST" action="">
      <div class="modal-header">Update Data</div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama User</label>
          <input class="input-text-12" id="testimoni_id_update" type="hidden" name="testimoni_id" required="">
          <input class="input-text-12" id="name_update" type="text" name="name" required="">
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <input type="text" class="input-text-12" id="testi_ket_update" name="testi_ket">
        </div>
        <div class="form-group">
          <label>Isi Testimoni</label>
          <textarea class="form-control summernote" id="testi_isi_update" name="testi_isi" required=""></textarea>
        </div>
        <div class="form-group">
          <label>Gender</label>
            <select class="custom-select" name="gender" id="gender_update">
              <option value="male">Laki - laki</option>
              <option value="female">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
          <select class="custom-select" name="status_publishing" id="status_publishing_update">
            <option value="publishing">Publish</option>
            <option value="waiting">Menunggu</option>
          </select>
        </div>

        <div class="form-group">
          <label>Foto Pengguna <i> (opsional)</i></label>
          <input type="file" name="picture_init" id="picture_init_update">
          <input type="hidden" name="picture" id="picture_update">
        </div>


      </div>
      <div class="modal-footer">

        <button type="submit" id="btnUpdateForm" class="btn btn-primary">Simpan</button>
        <button type="button" id="btnUpdateForm" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
      </form>
    </div>
  </div>
</div>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var dataTable = $('#lookup').DataTable( {
  "processing": true,
  "serverSide": true,
  "searching": true,
  "responsive": true,
  "ajax":{
      url :"<?php echo admin_url()."testimoni/render_testimoni" ?>", // json datasource
      type: "POST",  // method  , by default get
      error: function(){  // error handling
          $(".lookup-error").html("");
          $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
          $("#lookup_processing").css("display","none");
          
      }
    }
});
$("#lookup_length select").addClass("custom-select").css('height','35px');


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

function deleteResImage(selector, callback){

  $(document).on("click", ".imgDel", function(){
    $(".src").val('');
    $(selector).val('');
    $(".imgRes").remove();
    if(callback) 
      callback();
  }) 
}

function showImage(selector,path,image){
  $(".imgRes").remove();
  if (image !== "") {
    $(selector).after('<div class="imgRes"><img style="width:100%" src="'+path+image+'"><br><a href="#" class="imgDel">Hapus</a></div>');
  }
}



$(document).on("click",".bDelete",function(){


  var bDelete = $(".bDelete");
  var index = bDelete.index(this);
  var valId = bDelete.eq(index).attr('data-value');
  var alertObj = {
    title : 'Apakah Yakin Ingin Menghapus ?',
    text : "Data akan terhapus dari DATABASE !!"
  }
  dataAlert(alertObj, function(){
    $.ajax({
      url : '<?php echo admin_url() ?>' + 'testimoni/delete/',
      method : 'POST',
      data : {testimoni_id : valId},
      success : function(jsonData){
        var dataObj = JSON.parse(jsonData);
        if (dataObj.status == 'ok') {
          dataTable.ajax.reload();
        }
      }
    })
  })

})

deleteResImage("#picture");
deleteResImage("#picture_update");

$(document).on("change","#picture_init", function(){


  var xhrTarget = "<?php echo admin_url()."testimoni/upload_image" ?>";

  sendImage("#formAdd", '#picture_init', xhrTarget,function(result){
    if (result.status == 'ok') {
        $(".imgRes").remove();
        $("#picture_init").after('<div class="imgRes"><img style="width:100%" src="<?php echo base_url() ?>assets/img/testimoni_img/'+result.data+'"><br><a href="#" class="imgDel">Hapus</a></div>');
        $("#picture").val(result.data);
        $(".image_thumb").val(result.thumb);
      }
      else{
        swal('File Tidak Falid !!!');
      }
  })
})

$(document).on("change","#picture_init_update", function(){


  var xhrTarget = "<?php echo admin_url()."testimoni/upload_image" ?>";

  sendImage("#formUpdate", '#picture_init_update', xhrTarget,function(result){
    if (result.status == 'ok') {
        $(".imgRes").remove();
        $("#picture_init_update").after('<div class="imgRes"><img style="width:100%" src="<?php echo base_url() ?>assets/img/testimoni_img/'+result.data+'"><br><a href="#" class="imgDel">Hapus</a></div>');
        $("#picture_update").val(result.data);
        $(".image_thumb").val(result.thumb);
      }
      else{
        swal('File Tidak Falid !!!');
      }
  })
})


$(document).on("submit","#formAdd", function(e){

    e.preventDefault();

    $("#btnAddForm").html("Processing...");
    $("#btnAddForm").attr("disabled","");
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'testimoni/add',
        method : 'POST',
        data : new FormData(this),
        contentType : false,
        processData : false,
        success : function(data){
        $("#btnAddForm").html('<span class="fa fa-save"></span> Simpan');
        $("#btnAddForm").removeAttr("disabled");
            var dataObj = JSON.parse(data);
            if (dataObj.status == 'ok') {
                $("#modal1").modal('hide');
                dataTable.ajax.reload();
            }
        }
    })
})

$(document).on("submit","#formUpdate", function(e){

    e.preventDefault();

    $("#btnUpdateForm").html("Processing...");
    $("#btnUpdateForm").attr("disabled","");
    $.ajax({
        url : '<?php echo base_url()."admin/testimoni/update_action/" ?>',
        method : 'POST',
        data : new FormData(this),
        contentType : false,
        processData : false,
        success : function(data){
        $("#btnUpdateForm").html('<span class="fa fa-save"></span> Simpan');
        $("#btnUpdateForm").removeAttr("disabled");
            var dataObj = JSON.parse(data);
            if (dataObj.status == 'ok') {
                $("#modal2").modal('hide');
                dataTable.ajax.reload();
            }
        }
    })
})

$(document).on("click", ".bEdit", function(){
  var bEdit = $(".bEdit");
  var index = bEdit.index(this);
  var valId = bEdit.eq(index).attr('data-value');
  var path = '<?php echo base_url() ?>assets/img/testimoni_img/';
  $("#testimoni_id_update").val(valId);
  $("#modal2").modal("show");
  $("#status_publishing_update option").removeAttr("selected");
  $("#gender_update option").removeAttr("selected");
  $.ajax({
    url : '<?php echo admin_url() ?>'+'testimoni/get_testimoni',
    method : 'POST',
    data : {testimoni_id : valId},
    success : function(jsonData){
      var dataObj = JSON.parse(jsonData);
      var data = dataObj.data;
      var gender = data.gender;
      if (!gender) {
        gender = 0;
      }
      $("#name_update").val(data.name);
      $("#testi_ket_update").val(data.testi_ket);
      $("#testi_isi_update").val(data.testi_isi);
      $("#gender_update option[value="+gender+"]").attr("selected","");
      $("#status_publishing_update option[value="+data.status_publishing+"]").attr("selected","");
      $("#picture_update").val(data.picture);
      showImage("#picture_init_update",path,data.picture);
    }
  })


})
</script>

