
"use strict";

class tableData{

	constructor(data){
		this.param = data;
		this.tableName = data.table;
		this.table = $(data.table);
		this.tbody = $(data.table+' tbody');
		this.thead = $(data.table+' thead');
		this.url = data.url;
		this.totalData = 0;
		this.re;
		this.dataReload;



	
		if (typeof data.method === 'undefined') {
			this.method = 'POST';
		}
		else{
			this.method = data.method;
		}	

		if (typeof data.search === 'undefined') {
			this.search = null;
		}
		else{
			this.search = data.search;
		}	

		if (typeof data.length === 'undefined') {
			this.length = null;
		}
		else{
			this.length = data.length;
		}

		if (typeof data.data === 'undefined') {
			this.data = {};
		}
		else{
			this.data = data.data;
		}


		this.th = this.tableName + ' thead th';



		if (typeof data.defaultSort === 'undefined') {
			$(this.th).eq(0).attr("sort","asc");
		}
		/*else{
			var getSort = data.defaultSort;
			$(this.th).eq(0).attr("sort",getSort[1]);
		}
*/
		if (typeof data.field === 'undefined') {
			this.field = [];
		}
		else{
			this.field = data.field;
		}

		/*Remove ATTR sorting*/
		//$(this.tableName+' thead th').removeAttr("sort");

		var selector = data.table + "-page";
		var page = selector+' .page';

		this.selector = selector;
		this.page = page;

		this.tbFoot = this.tableName.substring(1)+"-totalData";
		if ($(selector).length == 0) {
			$(data.table).after('<div style="width:50%; float:left;" id="'+this.tableName.substring(1)+'-page"></div><div id="'+this.tbFoot+'" style="width:50%; float:left;">Total Data</div>');
			$(selector).html('<button class="btn-pre btn btn-primary btn-sm"> Previous </button> <input type="text" style="width : 40px; border-style:solid" class="page"  value="1"> <button class="btn-next btn btn-primary btn-sm"> Next </button>');
		}





	}
	reload(dt){
		this.dataReload = dt;
		this.re()
	}

	render(){



		var draw = (clb,start,field,sort)=>{

			if (this.search == null) {
				var search = "";	
			}
			else{
				var search = $(this.search).val();
			}
			if (this.length == null) {
				var length = 100
			}
			else{
				var length = $(this.length).val()
			}

			
			

			var selector = this.tableName + "-page";
	        if (this.length == null) {
	        	var perpage = 1
	        }
	        else{
	        	var perpage = length
	        }

	        

        	if (!start) {
        		var st = 0
        	}
        	else{
        		var st = start * length - length;
        	}

			var container = this.tbody;
			var dataObj = {
				search : search,
				start : st,
				length : length
			}


	        var selectThead = this.th;
	        var field = this.field;
	        var param = this.param;
	        var arrTh = [];

	        $(selectThead).each(function(ind){
	        	if ($(selectThead).eq(ind).attr('sort')) {
	        		arrTh.push(ind);
	        	}
	        })
	        

	        if (arrTh.length == 0) {
				dataObj['field'] = param.defaultSort[0];
				dataObj['sort'] = param.defaultSort[1];
			}
			else{
				
		        $(selectThead).each(function(x){
		        	if ($(selectThead).eq(x).attr("sort")) {
		        		if (typeof field[x] == "undefined") {
		        			dataObj['field'] = 1;	
		        		}
		        		else{
		        			dataObj['field'] = field[x];
		        		}
		        		dataObj['sort'] = $(selectThead).eq(x).attr("sort");
		        	}
		        	
		        })
			}






				var obj = this.data;
				Object.keys(obj).forEach(function(key){
					var valKey = $(obj[key]).val();

					dataObj[key] = obj[key];

					/*if (typeof valKey == 'undefined') {
						dataObj[key] = obj[key];
					}
					else{
						dataObj[key] = $(obj[key]).val();	
					}*/

				})



				/*if get data reload*/
				var obj2 = this.dataReload
				if (obj2) {
					Object.keys(this.dataReload).forEach(function(key){
						dataObj[key] = obj2[key];
					})
				}

				var tb = this.tableName;
				var tbFoot = this.tbFoot;
				$.ajax({
					url : this.url,
					method : this.method,
					data : dataObj,
					success : function(resultJson){
						var result = JSON.parse(resultJson);
						var jsonData = result.data;
				        var totalData = result.total;
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
				        container.html(tr);
				        $("#"+tbFoot).html("<i>Total data "+totalData+" rows </i>");
				        

				        if (clb)
				        	clb(totalData,perpage)
				        
					}
				})
			
			


		}


		var selector = this.selector;
		var page = this.page;
		var btn_next = selector+' .btn-next';
		var btn_pre = selector+' .btn-pre';

        


		draw(function(totalData,perpage){

			//$(selector).html('<button class="btn-pre btn btn-primary btn-sm"> Previous </button> <input type="text" style="width : 40px; border-style:solid" class="page"  value="1"> <button class="btn-next btn btn-primary btn-sm"> Next </button>');
			perpage = parseInt(perpage);
			if (totalData <= perpage) {
				$(selector).hide();
			}
			else{
				$(selector).show();	
			}
		});


		this.re = function(){
			$(page).val(1);

			draw(function(){
				
			});
		};

		$(document).on("click",btn_next, function(){
			var valPage = parseInt($(page).val()) + 1;
			$(page).val(valPage);
			draw(function(){

			},valPage)
		})
		$(document).on("click",btn_pre, function(){
			if(parseInt($(page).val()) > 1){
				var valPage = parseInt($(page).val()) - 1;
				$(page).val(valPage);
				draw(function(){

				},valPage)
			}
		})

		$(document).on("change",page, function(){
			if(parseInt($(page).val()) > 0){
				var valPage = parseInt($(page).val());
				$(page).val(valPage);
				draw(function(){

				},valPage)
			}
		})


		$(document).on("input", this.search, function(){
			$(page).val(1);
			draw(function(totalData,perpage){
				perpage = parseInt(perpage);
				if (totalData <= perpage) {
					$(selector).hide();
				}
				else{
					$(selector).show();	
				}
			});

		})
		$(document).on("change", this.length, function(){
			$(page).val(1);
			draw(function(totalData,perpage){
				perpage = parseInt(perpage);
				if (totalData <= perpage) {
					$(selector).hide();
				}
				else{
					$(selector).show();	
				}
			});
		})


		var tableHead = this.tableName+' thead th';

		$(document).on("click",tableHead, function(){
			var pg = $(page).val();
			var inx = $(tableHead).index(this);
			if ($(tableHead).eq(inx).attr("sort") == "desc") {
				$(tableHead).eq(inx).attr("sort","asc");

				draw(null,pg);
			}
			else if($(tableHead).eq(inx).attr("sort") == "asc"){
				$(tableHead).eq(inx).attr("sort","desc");
				draw(null,pg);
			}
			else{
				$(tableHead).removeAttr("sort");
				$(tableHead).eq(inx).attr("sort","desc");
				draw(null,pg);
				
			}
		})


	}

}
