  function showLoader(selector){
    $(selector).append('<div class="wrap-loader" style="position : absolute; width : 100%; height : 100%; top:0; left:0; background-color:#ffffffb3;"><div class="loader"></div></div>');
  }
  function removeLoader(selector){
    $(selector + ' .wrap-loader').remove();
  }
  function btnLoader(selector,data){

    if (!data) {
      data = 'Processing'
    }

    var htmData = '<div class="loader-sm"></div>'+data;
    $(selector).html(htmData)
    $(selector).attr("disabled","");
  }
  function btnRemoveLoader(selector,data){
    $(selector).html(data);
    $(selector).removeAttr("disabled");
  }


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
        $(form+" "+selector).val('');
        var jsonData = JSON.parse(jsonData);
            if (callback)
            callback(jsonData);

      }
    })
  }

  var validateForm = (selector,data)=> {

    var appHtml = '<div class="validateForm"">';

    for (var i = 0; i < data.length; i++) {
      appHtml += '<div class="alert alert-danger">'+data[i]+' Required</div>';
    }

    appHtml += '</div>';

    $(selector).prepend(appHtml);

    setTimeout(function(){
      $(selector +' .validateForm').remove();

    },3000);
    
  }

  var renderTable = (selector,objData) => {
      var jsonData = objData;
      var num = jsonData.length;
      

      var tr = "";

      for (var i = 0; i < num; i++) {

        var frontTr = '<tr>';
        var backTr = '</tr>';

        var nested = jsonData[i];
        var numNested = nested.length;
        var td = "";
          for (var b = 0; b < numNested; b++) {
            td += '<td>'+nested[b]+'</td>';
          }
        tr += frontTr+td+backTr;
      }
      $(selector +" tbody").html(tr);
  }