<script type="text/javascript" src="<?php echo base_url()."assets/admin_panel/js/table-data.js" ?>"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Kelola Blog</h2></div>
        <div class="col-md-6">
          
          
          <a href="<?php echo admin_url()."blog/manage" ?>" style="float: right;">
            <button class="btn btn-primary"><span class="fa fa-plus"></span> Posting Baru</button>
          </a>
        </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->


<div class="container-fluid top-bottom">
  <div class="row">
    <div class="col-md-12">
      <div class="block-space">

      <div class="form-row">
        <div class="col-4">
          <div class="custom-fa-search">
            <input type="text" id="dsearch" class="form-control form-control-sm" name="" placeholder="Cari Blog">
          </div>

        </div>
        <div class="col-1">

          <select class="form-control custom-select" id="length">
            <option>7</option>
            <option>15</option>
            <option>25</option>
            <option>50</option>
            <option>100</option>
            <option>250</option>
            
          </select>

        </div>
        <div class="col-5"></div>
      </div>
        <table id="lookUp" class="table" style="margin-top: 20px;">
          <thead style="cursor: pointer;">
            <th>No</th>
            <th>Blog Tittle</th>
            <th width="50px;"></th>
            <th width="70px;"></th>
            <th width="70px;"></th>
            <th></th>
            <th width="130px;"></th>
          </thead>
          <tbody>
          </tbody>
        </table>
        <div style="clear: both;"></div>
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


  var dataBlog = new tableData({
    url : '<?php echo admin_url() ?>' + 'blog/render_blog',
    table : '#lookUp',
    search : '#dsearch',
    length : '#length',
    field : ['blog_id','judul','admin.first_name','lihat','blog_id','date'],
    defaultSort : ['blog_id','DESC']
  })

  dataBlog.render();

  $(document).on("click", ".bDelete", function(e){
    e.preventDefault();
    var bDelete = $(".bDelete");
    var index = bDelete.index(this);  
    var valId = bDelete.eq(index).attr("data-value");

    var alertObj = {
      title : 'Yakin ingin menghapus ?',
      text : 'Data akan terhapus dari system'
    }
    dataAlert(alertObj,function(){
      $.ajax({
        url : '<?php echo admin_url() ?>' + 'blog/delete',
        method : 'POST',
        data : {blog_id:valId},
        success : function(jsonData){
          var dataObj = JSON.parse(jsonData);
          if (dataObj.status == 'ok') {
            dataBlog.reload();
          }
        }
      })
    })

  })

  $(window).on('load', function(){
    showLoader('.block-space');
  })

  $(document).ajaxStop(function(){
    removeLoader('.block-space');
  })
</script>