  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Home Admin Panel</h2></div>
        <div class="col-md-6">
        	<span class="fa fa-manual"></span>
        </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->

          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><span>Jumlah<br>User</span>
                      <div class="progress">
                        
                      </div>
                    </div>
                    <h1 id="countUsers"></h1>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="icon-padnote"></i></div>
                    <div class="title"><span>Jumlah<br>Orders</span>
                      <div class="progress">
                        
                      </div>
                    </div>
                    <h1 id="countOrders"></h1>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="icon-bill"></i></div>
                    <div class="title"><span>Jumlah<br>Pembelian</span>
                      <div class="progress">
                        
                      </div>
                    </div>
                    <h1 id="countPurchase"></h1>
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="icon-user"></i></div>
                    <div class="title"><span>Jumlah<br>Pelanggan</span>
                      <div class="progress">
                        
                      </div>
                    </div>
                    <h1 id="countCustomers"></h1>
                  </div>
                </div>
              </div>
            </div>
          </section>

<div class="container-fluid top-bottom">
  <div class="row">
    <div class="col-md-6">
      <div class="block-space">
      	<div id="statsVisitors"></div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="block-space">
      	<div id="statsProduct"></div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	

var statsVisitors = (dataObj, callback)=>{


Highcharts.chart('statsVisitors', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: 'Statistic Pengunjung Terhitung 7 Hari Lalu'
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
        categories: dataObj.categories /*[
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ]*/,
        plotBands: [{ // visualize the weekend
            from: 4.5,
            to: 6.5,
            color: 'rgba(68, 170, 213, .2)'
        }]
    },
    yAxis: {
        title: {
            text: 'Hits Count'
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: ' Hits'
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.5
        }
    },
    series: dataObj.series /*[{
        name: 'Pengunjung',
        data: [3, 4, 3, 5, 4, 10, 12]
    }]*/
});

if (callback) {
    callback();
}


}


var renderVisitors = (callback) => {
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'home/render_visitors',
        method : 'POST',
        data : {},
        success : function(jsonData){
            var dataObj = JSON.parse(jsonData)
            if (dataObj.status == 'ok') {
                var data = dataObj.data;
                var categories = [];
                var nestedSeries = [];
                Object.keys(data).forEach(function(key){
                    categories.push(key);
                    nestedSeries.push(data[key]);
                    
                })

                var series = [{
                    name : 'Pengunjung',
                    data : nestedSeries
                }];

                var dataParam = {
                    categories : categories,
                    series : series
                }

                console.log(dataParam)

                statsVisitors(dataParam);
                if (callback) {
                    callback(dataObj);
                }
            }
        }
    })
}


var statsProduct = (dataObj) => {



Highcharts.chart('statsProduct', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statistic Product Populer'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total percentage'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: dataObj/*[{
            name: 'Microsoft Internet Explorer',
            y: 56.33,
            drilldown: 'Microsoft Internet Explorer'
        }, {
            name: 'Chrome',
            y: 24.03,
            drilldown: 'Chrome'
        }]*/
    }]
});

}

var renderCountData = ()=>{
  $.ajax({
    url : '<?php echo admin_url() ?>' + 'home/render_count_data',
    method : 'POST',
    data : {},
    success : function(jsonData){
      var dataObj = JSON.parse(jsonData);
      var status = dataObj.status;
      var data = dataObj.data;
      if (status == 'ok') {
        var countUsers = data.countUsers
        var countOrders = data.countOrders
        var countPurchase  = data.countPurchase
        var countCustomers  = data.countCustomers



        $("#countUsers").html(countUsers);
        $("#countOrders").html(countOrders);
        $("#countPurchase").html(countPurchase);
        $("#countCustomers").html(countCustomers);




      }

    }
  })
}


var renderProduct = ()=>{
    $.ajax({
        url : '<?php echo admin_url() ?>' + 'home/render_product',
        method : 'POST',
        data : {},
        success : function(jsonData){
            var dataObj = JSON.parse(jsonData);
            if (dataObj.status == 'ok') {

                var data = dataObj.data;
                var param = [];
                Object.keys(data).forEach(function(key){
                    param.push({
                        name : data[key].name,
                        y : data[key].y
                    })
                })
                
                statsProduct(param);

            }
        }
    })

}

$(window).on("load", function(){
    showLoader('.block-space');
    showLoader('.bg-white');

    renderCountData();
    renderVisitors();
    renderProduct();

    $(document).ajaxStop(function(){
        removeLoader('.block-space');
        removeLoader('.bg-white');
    })
})



</script>