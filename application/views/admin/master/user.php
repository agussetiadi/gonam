<script type="text/javascript" src="<?php echo base_url()."assets/admin_panel/js/table-data.js" ?>"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Data User</h2></div>
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


    <div class="row">
      <div class="col-3">
          <select class="custom-select" id="provider">
            <option value="all">Tampilkan Semua</option>
            <option value="basic">Reguler</option>
            <option value="facebook">Faebook</option>
            <option value="google">Google</option>
          </select>
      </div>
      <div class="col-3">
        <div class="custom-fa-search">
          <input type="text" class="form-control form-control-sm" id="filterSearch" name="" placeholder="Cari">
        </div>
      </div>
      <div class="col-3">
        <select id="filterLimit" class="custom-select">
          <option>7</option>
          <option>15</option>
          <option>25</option>
          <option>50</option>
        </select>
      </div>

    </div>


    <table class="table" id="lookup" style="margin-top: 50px;">
      <thead>
        <th>Foto</th>
        <th>Profile</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Alamat</th>
        <th>Tanggal Gabung</th>
        <th>Status</th>
        <th>Provider</th>
        <th>Action</th>
      </thead>
      <tbody></tbody>
    </table>

<!-- Modal -->

<div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Update User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
        <form id="formUpdate" method="POST" enctype="multipart/form-data">
            <table width="100%" class="table-form">
                <tr>
                    <td width="130px">Nama User</td>
                    <td> : </td>
                    <td>
                    <input type="hidden" class="form-control form-control-sm" id="user_id" name="user_id">
                    <input type="text" class="form-control form-control-sm" id="name_update" name="name" placeholder="Nama Pengguna" required=""></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td> : </td>
                    <td>
                      <input type="email" class="form-control form-control-sm" id="email_update" name="email" placeholder="Ganti Email" required=""></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td> : </td>
                    <td>
                      <input type="text" class="form-control form-control-sm" id="phone_update" name="phone" placeholder="No Telp"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td> : </td>
                    <td>
                      <input type="password" class="form-control form-control-sm" id="password_update" name="password" placeholder="Ganti Password" required=""></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td> : </td>
                    <td>
                      <select class="custom-select" name="user_gender" id="user_gender_update">
                        <option value="male">Laki - laki</option>
                        <option value="female">Perempuan</option>
                      </select>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td> : </td>
                    <td>
                      <textarea class="form-control" name="address" id="address_update"></textarea>
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

<div id="modal2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Tambah User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
        <form id="formAdd" method="POST" enctype="multipart/form-data">
            <table width="100%" class="table-form">
                <tr>
                    <td width="130px">Nama User</td>
                    <td> : </td>
                    <td>
                    <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Nama Pengguna"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td> : </td>
                    <td>
                      <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Isi Email"></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td> : </td>
                    <td>
                      <input type="text" class="form-control form-control-sm" id="phone" name="phone" placeholder="No Telp"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td> : </td>
                    <td>
                      <input type="text" class="form-control form-control-sm" id="password" name="password" placeholder="Isi Password"></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td> : </td>
                    <td>
                      <select class="custom-select" id="user_gender" name="user_gender">
                        <option value="male">Laki - laki</option>
                        <option value="female">Perempuan</option>
                      </select>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td> : </td>
                    <td>
                      <textarea class="form-control" name="address" id="address"></textarea>
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




          </div>
        </div>
    </div>
</div>


<script type="text/javascript">
  var provider = $("#provider").val();
  var lookup = new tableData({
    url : '<?php echo admin_url() ?>' + 'master/user_select_all',
    table : '#lookup',
    search : '#filterSearch',
    length : '#filterLimit',
    defaultSort : ['user_id','DESC'],
    data : {
      provider : provider
    }
  })

  lookup.render();

  $(document).on("change", "#provider", function(){
    var provider = $(this).val();
    lookup.reload({
      provider : provider
    })
  })



$(document).on("click", ".bDelete", function(){
  var bDelete = $(".bDelete");
  var index = bDelete.index(this);
  var valId = bDelete.eq(index).attr("data-value");




  var alertObj = {
    title : 'Yakin ingin Menghapus ?',
    text : 'Data akan terhapus dari system'
  }
  dataAlert(alertObj,function(){
      $.ajax({
        url : '<?php echo admin_url() ?>'+'master/delete_user',
        method : 'POST',
        data : {user_id : valId},
        success:function(jsonData){
          var dataObj = JSON.parse(jsonData);
          if (dataObj.status == 'ok') {
            lookup.reload();
          }
        }
      })
  })
  
})


$(document).on("click", ".bEdit", function(){
  var bEdit = $(".bEdit");
  var index = bEdit.index(this);
  var valId = bEdit.eq(index).attr("data-value");
  $("#modal1").modal("show");
  showLoader("#modal1 .modal-body")

  $("#user_id").val(valId);
  $("#user_gender_update option").removeAttr("selected");


  $.ajax({
    url : '<?php echo admin_url() ?>'+'master/get_user',
    method : 'POST',
    data : {user_id : valId},
    success:function(jsonData){

      removeLoader("#modal1 .modal-body");

      var dataObj = JSON.parse(jsonData);
      var data = dataObj.data;
      if (dataObj.status == 'ok') {
        $("#name_update").val(data.name);
        $("#email_update").val(data.email);
        $("#password_update").val(data.password);
        $("#phone_update").val(data.phone);
        $("#user_gender_update option[value="+data.user_gender+"]").attr("selected","");
        $("#address_update").val(data.address);
      }
    }
  })
})


$(document).on("click","#btnAdd",function(){
  $("#modal2").modal("show");
})

$(document).on("submit","#formAdd", function(e){
  e.preventDefault();

  btnLoader("#bAdd");

  $.ajax({
    url : '<?php echo admin_url() ?>' + 'master/add_user',
    method : 'POST',
    data : new FormData(this),
    contentType : false,
    processData : false,
    success : function(jsonData){

      btnRemoveLoader("#bAdd", '<span class="fa fa-save"></span> Simpan');

      var dataObj = JSON.parse(jsonData);
      if (dataObj.status == 'required') {
        validateForm("#modal2",dataObj.message);
      }
      if (dataObj.status == 'ok') {
        $("#modal2").modal("hide");
        lookup.reload();
      }
    }
  })
})

$(document).on("submit","#formUpdate", function(e){
  e.preventDefault();

  btnLoader("#bUp");

  $.ajax({
    url : '<?php echo admin_url() ?>' + 'master/update_user',
    method : 'POST',
    data : new FormData(this),
    contentType : false,
    processData : false,
    success : function(jsonData){

      btnRemoveLoader("#bUp", '<span class="fa fa-save"></span> Simpan');

      var dataObj = JSON.parse(jsonData);
      if (dataObj.status == 'required') {
        validateForm("#modal1",dataObj.message);
      }
      if (dataObj.status == 'ok') {
        $("#modal1").modal("hide");
        lookup.reload();
      }
    }
  })
})


</script>