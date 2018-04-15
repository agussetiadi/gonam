$(document).ready(function(){
base_url = "http://localhost:8080/gonam/";
base_url_admin = "http://localhost:8080/gonam/admin/";
/*Ajax order/aqiqah*/





$('.btn-edit').each(function(y){	
	$('.btn-edit').eq(y).on('click', function(){
		gender = $('.gender').eq(y).val()
		$('#ajax_id').val($('.order_detail_id').eq(y).val());
		$('#ajax_1').val($('.ajax_1').eq(y).html());
		$('#ajax_2').val($('.ajax_2').eq(y).html());
		$('#ajax_3').val($('.ajax_3').eq(y).html());
		$('#ajax_4').val($('.ajax_4').eq(y).html());
	})
})


/*sweet alert*/
  $('.btn-delete').click(function(e) {
    deleteContent();
  	e.preventDefault();
  	var linkURL = $(this).attr("href");
    deleteContent(linkURL);
  });

  function deleteContent(linkURL) {
    swal({
      title: "Apakah anda yakin ?", 
      text: "Apakah anda yakin ingin menghapus pesanan dari cart?", 
      type: "warning",
      showCancelButton: true,
      closeOnConfirm: false,
      confirmButtonText: "Yes, hapus!",
      confirmButtonColor: "#ec6c62"
    },
    function() {
      // Redirect the user
      window.location.href = linkURL;
    })
  }




  /*
  Page purchase action
  */
      function remove_modal(init){
      $("body").removeClass("modal-open");
      $("body").attr("style","");
      $("div").removeClass("modal-backdrop");
      $(init).modal("hide");
    }
    function update_total(){
      var purchase_id = $(".purchase_detail_id"),
      count = purchase_id.length,
      potongan = parseInt($("input[name=po_potongan]").val()),
      num = 0;
      for (var i = 0; i < count; i++) {
        num += parseInt($(".pod_price").eq(i).val())
      }
      var result = num-potongan;
      $("input[name=po_total]").val(result);
      $("#h3total").html("Rp. "+$.number(result)+" ,-")

    }
    $(document).on("click", ".pod_delete", function(){
      var el = $(".pod_delete").index(this);
      $(".item").eq(el).hide();
      $(".is_deleted").eq(el).val(1);
      $(".pod_price").eq(el).val(0)
      update_total();

      
    })

    $(document).on("click", ".pod_edit", function(){
      var el = $(".pod_edit").index(this);
      var getTotal = $("input[name=po_total]").val();
      var getItem = $(".pod_item").eq(el).val();
      var getQty = $(".pod_qty").eq(el).val();
      var getPrice = $(".pod_price").eq(el).val();
      $("#index").val(el);
      $(".item_edit").val(getItem);
      $(".price_edit").val(getPrice);
      $(".qty_edit").val(getQty);

      
    })
    $(document).on("click", ".btn_add", function(){

    })
    $(document).on("click", ".btn-edit-ok", function(){
      var el = $("#index").val();


      var item_edit = $(".item_edit").val();
      var qty_edit = $(".qty_edit").val();
      var price_edit = $(".price_edit").val();


      $(".td_item").eq(el).html(item_edit);
      $(".td_price").eq(el).html(price_edit);
      $(".td_qty").eq(el).html(qty_edit);



      $(".pod_item").eq(el).val(item_edit);
      $(".pod_qty").eq(el).val(qty_edit);
      $(".pod_price").eq(el).val(price_edit);
      remove_modal("#exampleModal");
      update_total();

    })
    $(document).on("click", ".btn-add-ok", function(){
      var item_add = $(".item_add").val();
      var qty_add = $(".qty_add").val();
      var price_add = parseInt($(".price_add").val());
      $("#table_detail").append('<tr class="item"><td class="td_item">'+item_add+'</td><td class="td_qty">'+qty_add+'</td><td class="td_price">'+price_add+'</td><td><button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-xs btn-info pod_edit" >Edit</button><button type="button" class="btn btn-xs btn-danger pod_delete">Hapus</button></td></tr>');
      $(".input_hide").append('<input class="purchase_detail_id" type="hidden" name="purchase_detail_id[]" value="auto">      <input class="pod_item" type="hidden" name="pod_item[]" value="'+item_add+'"><input class="pod_price" type="hidden" name="pod_price[]" value="'+price_add+'"><input class="pod_qty" type="hidden" name="pod_qty[]" value="'+qty_add+'"><input class="is_deleted" type="hidden" name="is_deleted[]" value="0"><br>');

      remove_modal("#exampleModal2");
      update_total();
      $(".item_add").val("");
      $(".qty_add").val(0);
      $(".price_add").val(0);
    })
    $(document).on("input", "input[name=po_potongan]", function(){
      update_total();
    })


    /*add order OPEN*/
    function save_order(){
      
      var form_order = $("#ajax_order_form")[0];
        $.ajax({
          url:base_url_admin+"order/edit_action",
          method:"POST",
          data:new FormData(form_order),
          contentType:false,
          processData:false,
          success:function(data_form){

            console.log(data_form)
          }
        })
    }

    $(document).on("click","#btn-save-order",function(){

    })


 $(document).on("click",'.menu_add_order',function(){
    save_order();
  })

/*      $(document).on("click",'.menu_add_order',function(){
        var x = $(this).index();
        $('.menu_add_order').removeClass("active");
        $(this).addClass("active")
        $(".body_content").slideUp()
        $(".body_content").eq(x).slideDown()
      })*/


    $(document).on("change","#kambing_id",function(){
      var dis = $("input[name=okd_diskon]").val();
      var value = $(this).val();
      var kambing_qty = $("#kambing_qty").val();
      $.ajax({
        url:base_url_admin+"order/ajax_get_price",
        method:"POST",
        data:{kambing_id:value},
        success:function(data){
          var json_data = JSON.parse(data);
          var subtotal = (json_data.price- dis) * kambing_qty ;
          if (json_data.status == "success") {
            $("#hrg_satuan").val(json_data.price);
            $("#hrg_satuan_html").html("Rp. "+$.number(json_data.price));
            $("#subtotal").html("Rp. "+$.number(subtotal)+" ,-");

          }
        }
      })

    })

    $(document).on("input","#kambing_qty", function(){
      var val = $("input[name=okd_diskon]").val();
      var kambing_qty = $(this).val();
      var hrg_satuan = $("#hrg_satuan").val();
      var subtotal = (hrg_satuan - val) * kambing_qty;
      $("#subtotal").html("Rp. "+$.number(subtotal)+" ,-");
    })
    $(document).on("input","input[name=okd_diskon]", function(){
      var val = $(this).val()
      var hrg_satuan = $("#hrg_satuan").val();
      var kambing_qty = $("#kambing_qty").val();
      var subtotal = (hrg_satuan - val) * kambing_qty;
      $("#subtotal").html("Rp. "+$.number(subtotal)+",-");
    })








    $(document).on("change","#product_id",function(){
      var value = $(this).val();
      var product_qty = $("#product_qty").val();
      $.ajax({
        url:base_url_admin+"order/ajax_get_price2",
        method:"POST",
        data:{product_id:value},
        success:function(data){
          console.log(data)
          var json_data = JSON.parse(data);
          var subtotal = product_qty*json_data.price;
          if (json_data.status == "success") {
            $("#menu").val(json_data.menu);
            $("#hrg_satuan_product").val(json_data.price);
            $("#hrg_satuan_product_html").html("Rp. "+$.number(json_data.price));
            $("#subtotal_product").html("Rp. "+$.number(subtotal));

          }
        }
      })

    })


    $(document).on("input","#product_qty", function(){
      var val = $("input[name=opd_diskon]").val();
      var product_qty = $(this).val();
      var hrg_satuan = $("#hrg_satuan_product").val();
      var subtotal = product_qty * hrg_satuan - val;
      $("#subtotal_product").html("Rp. "+$.number(subtotal));
    })
    $(document).on("input","input[name=opd_diskon]", function(){
      var val = $(this).val();
      var hrg_satuan_product = $("#hrg_satuan_product").val();
      var product_qty = $("#product_qty").val();
      var subtotal = hrg_satuan_product * product_qty - val;
      $("#subtotal_product").html("Rp. "+$.number(subtotal));
    })


    function ajax_rq(){
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

    function ajax_rq2(param_url){
      var param_url = param_url;
      $.ajax({
        url:param_url,
        method:"POST",
        data:{ajax_request:"true"},
        success:function(data){
          $('#ajax_content').replaceWith(data);
          window.history.pushState('','null', param_url);
        }
      })
    }


    $(document).on("submit",".form_ajax",function(f){
        $("#ajax-loading").show();
      f.preventDefault();
      var url_form = $(this).attr("action");
      $.ajax({
        url:url_form,
        method:"POST",
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data){
            $("#ajax-loading").hide();
          var jsonData = JSON.parse(data);
          if (jsonData.status == "success") {
            /*window.location.reload(true);*/
            $("body").removeClass("modal-open");
            $("body").attr("style","");
            $("div").removeClass("modal-backdrop");
            $("#exampleModal").modal("hide");
            $(".bs-example-modal-lg").modal("hide");
            if (jsonData.redirect == "true") {
              ajax_rq2(jsonData.path);
            }
            else{
              ajax_rq();
            }
          }
          else if(jsonData.status == "failed"){
            swal("Failed", "Eror", "error");
            if (jsonData.redirect) {
              ajax_rq2(jsonData.path);
            }
          }
        }
      })
    })


    $(document).on("click","#btn-success-order",function(){
        $("#ajax-loading").show();
      var form_order = $("#ajax_order_form")[0];
      var order_id = $("input[name=order_id]").val();
        $.ajax({
          url:base_url_admin+"order/success/"+order_id,
          method:"POST",
          data:new FormData(form_order),
          contentType:false,
          processData:false,
          success:function(data_form){
              $("#ajax-loading").hide();
            var jsonData = JSON.parse(data_form);
            if (jsonData.redirect == 'true') {
              if (jsonData.alert == 'true') {
                swal("Berhasil", "Data Telah Tersimpan", "success");
              }
              var path = jsonData.path;
              ajax_rq2(path);
              window.history.pushState('','null', path);
            }
            else{
              ajax_rq();
            }
          }
        })
    })
    

    /*action delete*/
    $(document).on("click",".b_delete",function(b){
      b.preventDefault();
      var url_delete = $(this).attr("href");
      $.ajax({
        url:url_delete,
        method:"POST",
        data:{ajax_request:"true"},
        success:function(data){
          var jsonData = JSON.parse(data);
          if (jsonData.status == "success") {
            /*window.location.reload(true);*/
            if (jsonData.redirect == 'true') {
              if (jsonData.alert == 'true') {
                swal("Berhasil", "Input Data Baru", "success");
              }
              var path = jsonData.path;
              ajax_rq2(path);
              window.history.pushState('','null', path);
            }
            else{
              ajax_rq();
            }
          } 
        }
      })
    })




/*Address event*/

    /*
    - Ketika input name di ketik
    - input hidden address_3 terisi
    */
    $('input[name=address]').on("input", function(){
      $('#address_3').val($(this).val());
    })

    $(document).on("change", "#provinsi", function(){
      var data_send = $(this).val();
      $.ajax({
        url:base_url+"wilayah/kabupaten",
        method:"POST",
        data:{provinsi_id:data_send},
        success:function(data_html){
          $("#kabupaten").html(data_html)
          $("#kecamatan").html("");
        }
      })
    })


    $(document).on("change", "#kabupaten", function(){
      var data_send = $(this).val();
      $.ajax({
        url:base_url+"wilayah/kecamatan",
        method:"POST",
        data:{kabupaten_id:data_send},
        success:function(data_html){
          $("#kecamatan").html(data_html)
        }
      })
    })





/*action delete*/
$(document).on("click",".btn_delete",function(b){
    var th = $(this).attr("href");
         b.preventDefault();
        swal({
        title: "Yakin Ingin Menghapus?",
        text: "Data Akan Terhapus Dari Aplikasi",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus",
        closeOnConfirm: false
      },
        function(isConfirm){
          if (isConfirm) {
                

                /*Ajax function OPEN*/
                var url_delete = th;
                var param_url = window.location.href;
                $.ajax({
                    url:url_delete,
                    method:"POST",
                    data:{ajax_request:"true"},
                    success:function(data){
                        var jsonData = JSON.parse(data);
                        if (jsonData.status == "success") {
                            /*window.location.reload(true);*/
                            if (jsonData.redirect == 'true') {
                                var path = jsonData.path;
                                ajax_rq2(path);
                                window.history.pushState('','null', path);
                            }
                            else{
                                ajax_rq2(param_url);
                            }
                        }   
                    }

                })
                /*Ajax function CLOSE*/


                swal("Berhasil", "Data Berhasil Dihapus)", "success");

          } else {
            swal("Batal", "Batalkan menghapus)", "error");
          }
        });



})





/*
Page Add Order CLOSE
*/


/*
Page Tagihan_supplier OPEN
*/

$(document).on("change","#q_sup",function(){
          var value = $(this).val();
          var id = $("#supplier_id").val();
            $.ajax({
              url:base_url_admin+"purchase/search_supplier/",
              method:"POST",
              data:{po_updated:value,id:id},
              success:function(data){
                $("tbody").replaceWith(data);
              }
            })
        })
$(document).on("input","#q_sup",function(){
          var value = $(this).val();
          var id = $("#supplier_id").val();
            $.ajax({
              url:base_url_admin+"purchase/search_supplier/",
              method:"POST",
              data:{po_updated:value,id:id},
              success:function(data){
                $("tbody").replaceWith(data);
              }
            })
        })
/*CLOSE*/


/*Page statistic/penjualan*/
    $(document).on("click", ".btn-statistic", function(){
      var index = $(this).index();
      var val = $(this).val();
      $.ajax({
        method:"POST",
        url:base_url+"admin/statistic/penjualan",
        data:{ajax_request:"true",data:val},
        success:function(data){
          $("#ajax_sub_content").replaceWith(data);
        }

      })
    })



    /* Page Laporan*/

    $(document).on("submit",".ajax_nav_form", function(e){
        $("#ajax-loading").show();
        var url = $(this).attr("action");
        var start = $("input[name=start]").val();
        var end = $("input[name=end]").val();
        e.preventDefault();
        $.ajax({
            method:"GET",
            url:url,
            data:{ajax_request:"true",start:start,end:end},
            success:function(data){
                $("#ajax-loading").hide();
                $('#ajax_content').replaceWith(data);
                 window.history.pushState('','null', url+"?start="+start+"&end="+end);
            }
        })
    })


    $(document).on("click",".nav_li a", function(e){
        var url = $(this).attr("href");
        e.preventDefault();
        $.ajax({
            method:"POST",
            url:url,
            data:{ajax_request:"true"},
            success:function(data){
                $('#ajax_content').replaceWith(data);
                 window.history.pushState('','null', url);
            }
        })
    })


      $(document).on("submit",".form_search", function(e){
          $("#ajax-loading").show();
        var url = $(this).attr("action");
        var q = $("input[name=q]").val();
        e.preventDefault();
        $.ajax({
            method:"GET",
            url:url,
            data:{ajax_request:"true",q:q},
            success:function(data){
                $("#ajax-loading").hide();
                $('#ajax_content').replaceWith(data);
                 window.history.pushState('','null', url+"?q="+q);
            }
        })
    })


  /*Page Master*/

  $(document).on("click",".btn-kc", function(){
    var x = $(".btn-kc").index(this);
    var id = $(".div-kc").eq(x).html();
    var kc_name = $(".div-kcn").eq(x).html();
    var kc_slug = $(".kc_slug").eq(x).val();
    $("input[name=kambing_category]").val(id);
    $("input[name=kc_name]").val(kc_name);
    $("#kc_slug option").removeAttr("selected");
    $("#kc_slug option[value="+kc_slug+"]").attr("selected","");
  })

 $(document).on("click",".btn-pc", function(){
    var x = $(".btn-pc").index(this);
    var id = $(".div-pc").eq(x).html();
    var pc_name = $(".div-pcn").eq(x).html();
    var pc_slug = $(".pc_slug").eq(x).val();
    $("input[name=product_category]").val(id);
    $("input[name=pc_name]").val(pc_name);
    $("#pc_slug option").removeAttr("selected");
    $("#pc_slug option[value="+pc_slug+"]").attr("selected","");
  })



  $(document).on("click",".btn-add-c", function(){
    $("input[name=pc_name]").val("");
    $("input[name=kc_name]").val("");
  })



  /*Page testimoni OPEN*/

  /*change publish*/
  $(document).on("change",".change_publish", function(){
    var index = $(".change_publish").index(this);
    var id = $(".testimoni_id").eq(index).val();
    var val = $(this).val();
    $.ajax({
      url:base_url_admin+"testimoni/change_publish",
      method:"POST",
      data:{id:id,val:val},
      success:function(data){
        var jsonData = JSON.parse(data);
        if (jsonData.status == "success") {
        $(".change_publish").eq(index).val(jsonData.result);
        }
      }
    })
  })


  /*Page testimoni CLOSE*/


  /*Page menu config OPen*/
  $(document).on("change",".c1", function(){
    var index = $(".c1").index(this);
    var id = $(".md1").eq(index).val();
    var val = $(this).val();
    $.ajax({
      url:base_url_admin+"config_menu/change_1",
      method:"POST",
      data:{id:id,val:val},
      success:function(data){
        var jsonData = JSON.parse(data);
        if (jsonData.status == "success") {
        $(".c1").eq(index).val(jsonData.result);
        }
      }
    })
  })  


  $(document).on("change",".c2", function(){
    var index = $(".c2").index(this);
    var id = $(".md2").eq(index).val();
    var val = $(this).val();
    $.ajax({
      url:base_url_admin+"config_menu/change_2",
      method:"POST",
      data:{id:id,val:val},
      success:function(data){
        var jsonData = JSON.parse(data);
        if (jsonData.status == "success") {
        $(".c2").eq(index).val(jsonData.result);
        }
      }
    })
  })  
  /*Page menu config CLOSE*/

  /*Page Config Notif*/
  $(document).on("change", ".nf_a", function(){
    var index = $(".nf_a").index(this);
    var id = $(".nf_id").eq(index).val();
    var val = $(this).val();
    $.ajax({
      url:base_url_admin+"notif_order/change",
      method:"POST",
      data:{id:id,val:val},
      success:function(data){
        var jsonData = JSON.parse(data);
        if (jsonData.status == "success") {
        $(".nf_a").eq(index).val(jsonData.result);
        }
      }
    })
  })


  $(document).on("click", ".btn-edit-config", function(){
    var index = $(".btn-edit-config").index(this);
    var id = $(".nf_id").eq(index).val();
    var notif_target = $(".notif_target").eq(index).html();
    $("input[name=id_update]").val(id);
    $("input[name=target_update]").val(notif_target);
  })

  $(document).on("submit", "#form_pw", function(x){
      $("#ajax-loading").show();
    x.preventDefault();
    value = $("#form_pw")[0];
    $.ajax({
      url:base_url+"admin/user_admin/action_change_password/",
      method:"POST",
      data:new FormData(value),
      contentType:false,
      processData:false,
      success:function(data){
          $("#ajax-loading").hide();
        var jsonData = JSON.parse(data);
        if (jsonData.status=="success") {
          
          window.location=base_url+'admin/';
        }
        else{
          swal("Failed", jsonData.alert, "error");
        }
      }
    })
  })


  /*Page User / Cart*/
/*action update*/
$(document).on("change",".kambing_cart_update",function(b){
        /*Ajax function OPEN*/
        $("#ajax-loading").show();
        var index = $(".kambing_cart_update").index($(this));
        var url_delete = base_url+"order/update_cart_kambing";
        var param_url = window.location.href;
        var kambing_qty = $(this).val();
        var order_detail_id = $(".odi").eq(index).val();
        var kambing_id = $(".kambing_id").eq(index).val();
        $.ajax({
            url:url_delete,
            method:"POST",
            data:{ajax_request:"true",kambing_qty:kambing_qty,order_detail_id:order_detail_id,kambing_id:kambing_id},
            success:function(data){
                $("#ajax-loading").hide();
                var jsonData = JSON.parse(data);
                if (jsonData.status == "success") {
                    /*window.location.reload(true);*/
                    if (jsonData.redirect == 'true') {
                        var path = jsonData.path;
                        ajax_rq2(path);
                        window.history.pushState('','null', path);
                    }
                    else{
                        ajax_rq2(param_url);
                    }
                }   
            }

        })
        /*Ajax function CLOSE*/
})


$(document).on("change",".product_cart_update",function(b){
        /*Ajax function OPEN*/
        $("#ajax-loading").show();
        var param_url = window.location.href;
        var index = $(".product_cart_update").index($(this));
        var url_delete = base_url+"order/update_cart_product";
        var product_qty = $(this).val();
        var order_product_id = $(".opi").eq(index).val();
        var product_id = $(".product_id").eq(index).val();
        $.ajax({
            url:url_delete,
            method:"POST",
            data:{ajax_request:"true",product_qty:product_qty,order_product_id:order_product_id,product_id:product_id},
            success:function(data){
                $("#ajax-loading").hide();
                var jsonData = JSON.parse(data);
                if (jsonData.status == "success") {
                    /*window.location.reload(true);*/
                    if (jsonData.redirect == 'true') {
                        var path = jsonData.path;
                        ajax_rq2(path);
                        window.history.pushState('','null', path);
                    }
                    else{
                        ajax_rq2(param_url);
                    }
                }   
            }

        })
        /*Ajax function CLOSE*/
})




  })