
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Statistik Penjualan</h2></div>
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

        		    <table style="width: 100%;" class="table-td-padd">
      				<tr>
      					
      					
      					<td>
      						<button class="btn btn-info" id="bProcess1"><span class="fa fa-refresh"></span> Bulanan</button>
                  <button class="btn btn-info" id="bProcess2"><span class="fa fa-refresh"></span> Tahunan</button>
                  
      					</td>
      				</tr>
      			</table>  
      			<hr>
      			<div id="container"></div>
            

        	</div>

       	</div>
    </div>
</div>
<div class="container-fluid top-bottom">
    <div class="row">
        <div class="col-md-12">
          <div class="block-space">

            <div id="container_old"></div>

          </div>
        </div>
    </div>
</div>

<div class="container-fluid top-bottom">
    <div class="row">
        <div class="col-md-12">
          <div class="block-space">

            <div id="container_pie"></div>

          </div>
        </div>
    </div>
</div>

<div class="container-fluid top-bottom">
    <div class="row">
        <div class="col-md-12">
          <div class="block-space">

            <div id="container_pie_old"></div>

          </div>
        </div>
    </div>
</div>

<script type="text/javascript">

var renderStats = (selector,jsonData,title,subtitle)=> {

var category = [];
var value = [];
Object.keys(jsonData).forEach(function(key){
  category.push(key);
  value.push(jsonData[key]);
})


Highcharts.chart(selector, {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: title
    },
    subtitle : {
        text : subtitle
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 150,
        y: 100,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    xAxis: {
        categories: category,
        plotBands: [{ // visualize the weekend
            from: 4.5,
            to: 6.5,
            color: 'rgba(68, 170, 213, .2)'
        }]
    },
    yAxis: {
        title: {
            text: 'Jumlah Pesanan'
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: ' Orders'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.5
        }
    },
    series: [{
        name: 'Pesanan',
        data: value
    }]
});
}

var renderData = (valObj, callback)=>{
  $.ajax({
    url : '<?php echo admin_url() ?>' + 'report/sales_stats_render',
    method : 'POST',
    data : valObj,
    success : function(jsonData){
      var dataObj = JSON.parse(jsonData);
      var data1 = dataObj.graphic_line;
      var data2 = dataObj.graphic_pie;
      var dataOld = dataObj.graphic_line_old;
      var data2Old = dataObj.graphic_pie_old;


      renderStats('container',data1.data,data1.title,data1.subtitle);
      renderStats('container_old',dataOld.data,dataOld.title,dataOld.subtitle); 
      
      renderPie('container_pie',data2.data,data2.title,data2.subtitle);
      renderPie('container_pie_old',data2Old.data,data2Old.title,data2Old.subtitle);

      if (callback)
        callback();

    }
  })
}

$(document).on("click","#bProcess1", function(){
  showLoader(".block-space");
  var valObj = {
    init : 'mingguan'
  }
  renderData(valObj, function(){
    $(window).ajaxStop(function(){
      removeLoader(".block-space");
    })
  })
})

$(document).on("click","#bProcess2", function(){
  showLoader(".block-space");
  var valObj = {
    init : 'bulanan'
  }
  renderData(valObj, function(){
    $(window).ajaxStop(function(){
      removeLoader(".block-space");
    })
  })
})


var renderPie = (selector,map_obj,title,subtitle)=>{
  
  Highcharts.chart(selector, {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: title
    },
    subtitle : {
      text : subtitle
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Prosentase',
        colorByPoint: true,
        data: map_obj
    }]
});
}

$(window).on("load", function(){
  showLoader(".block-space");
  var valObj = {
    init : 'mingguan'
  }
  renderData(valObj, function(){
    $(window).ajaxStop(function(){
      removeLoader(".block-space");
    })
  })
})

</script>