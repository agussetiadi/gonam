function calling(nomor,loket,url){

	function getBilangan(str){
	var str = parseInt(str);
	if (str == 1) {
		bilangan = url+'satu.mp3';
	}
	if (str == 2) {
		bilangan = url+'dua.mp3';
	}
	if (str == 3) {
		bilangan = url+'tiga.mp3';
	}
	if (str == 4) {
		bilangan = url+'empat.mp3';
	}
	if (str == 5) {
		bilangan = url+'lima.mp3';
	}
	if (str == 6) {
		bilangan = url+'enam.mp3';
	}
	if (str == 7) {
		bilangan = url+'tujuh.mp3';
	}
	if (str == 8) {
		bilangan = url+'delapan.mp3';
	}
	if (str == 9) {
		bilangan = url+'sembilan.mp3';
	}
	if (str == 10) {
		bilangan = url+'sepuluh.mp3';
	}
	if (str == 11) {
		bilangan = url+'sebelas.mp3';
	}
	if (str > 11 && str < 20) {
		bilangan = url+'belas.mp3';
	}
	if (str >= 20 && str < 100) {
		bilangan = url+'puluh.mp3';
	}
	if (str >= 100 && str < 200) {
		bilangan = url+'seratus.mp3';
	}
	if (str >= 200 && str < 1000) {
		bilangan = url+'ratus.mp3';
	}

	return bilangan;
}


function playAudio(param,fo){
	var audio = new Audio();
	audio.src = getBilangan(param);
	audio.play();
	audio.onended = fo;
}

function ucap(param){
	var param = parseInt(param);
	
	function satuan(angka, fo){
		var n = angka.toString().substring(-1);
		if (n != 0) {
			playAudio(n, function(){
				if(fo)
				fo()
						
			})
		}
		else{
			if(fo)
				fo();
		}


/*		if (n != 0) {
			playAudio(n, function(){
				
				var a = new Audio();
				a.src = url+'diloket.mp3';
				a.play();
				
				a.onended = function(){

					if(fo)
					fo()
					var b = new Audio();
					b.src = getBilangan(loket);
					b.play();
					b.onended = function(){
						var c = new Audio();
						c.src = url+"end_sign.mp3";
						c.play();
					}
				}	
			})
		}
		else{
			var a = new Audio();
			a.src = url+'diloket.mp3';
			a.play();
			a.onended = function(){
				if(fo)
				fo()
				var b = new Audio();
				b.src = getBilangan(loket);
				b.play();
				b.onended = function(){
					var c = new Audio();
						c.src = url+"end_sign.mp3";
						c.play();
				}
			}
		}*/
		
	}

	function belasan(angka,fo){
		var n = angka.toString().substring(1,2);

		playAudio(n,function(){
			satuan(angka,fo);
		})
	}

	function puluhan(angka,fo){
		var n1 = angka.toString().substring(0,1);
		var n2 = angka.toString().substring(1);


		playAudio(n1,function(){
			playAudio(angka,function(){
				satuan(n2,fo);
				/*if (n2 != 0) {
					playAudio(n2);
				}*/
			});
		})
	}

	function seratusan(angka,fo){
		var n2 = param.toString().substring(1);
		var n2 = parseInt(n2);


		playAudio(angka, function(){

			if (n2 <= 11) {
				satuan(n2,fo);
			}
			if (n2 > 11 && n2 < 20) {
				belasan(n2);
			}
			if (n2 >= 20 && n2 < 100) {
				puluhan(n2);
			}

			
		})
	}

	function ratusan(angka,fo){

		var n1 = angka.toString().substring(0,1);
		var n2 = param.toString().substring(1);
		var n2 = parseInt(n2);

		playAudio(n1, function(){
			playAudio(angka, function(){
				if (n2 <= 11) {
					satuan(n2,fo);
				}
				if (n2 > 11 && n2 < 20) {
					belasan(n2);
				}
				if (n2 >= 20 && n2 < 100) {
					puluhan(n2);
				}
			})
		})
	}

	function render(param,fo){

		if (param == 11) {
			satuan(param,fo);
		}

		if (param < 11) {
			satuan(param,fo);
		}

		if (param > 11 && param < 20) {
			belasan(param,fo);
		}

		if (param >= 20 && param < 100) {
			
			puluhan(param,fo)
				
		}
		if (param >= 100 && param < 200) {

			seratusan(param,fo);
		}
		if (param >= 200 && param < 1000) {

			ratusan(param,fo);
		}
	}

	render(param, function(){
		var a = new Audio();
		a.src = url+"diloket.mp3";
		a.play();
		a.onended = function(){

			render(loket, function(){
				var g = new Audio();
				g.src = url+"end_sign.mp3";
				g.play();
				g.onended = function(){
					
				}
			});
			
		}
	});



}



	var audio = new Audio();
	audio.src = url+'start_sign.mp3';
	audio.play();
	audio.onended = function(){

		audio.src = url+"antrian.mp3";
		audio.play();
		audio.onended = function(){
			
			nomor = nomor.split(" ");
			str1 = nomor[0];
			str2 = nomor[1];

			audio.src = url+''+str1+'.mp3';
			audio.play();
			audio.onended = function(){

				ucap(str2,loket);

			}
		}



	}
}