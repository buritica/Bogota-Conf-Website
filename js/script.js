//app object literal
var bconf = {
	layer:{},
	status:{},
	findInArray: function(arr,obj) {
		return (arr.indexOf(obj) != -1);
	}
};

bconf.baseUrl = $('#base-url').attr('href');
bconf.layer.body = $('body');
bconf.layer.transmi = $('#transmi-outer');
bconf.layer.header = $('#weather');
bconf.layer.clouds = $('#clouds');
bconf.layer.leftContent = $('#left-content .load');
bconf.layer.sidebar = $('#sidebar');
bconf.layer.overlay =  $('#overlay');
bconf.layer.lightbox = $('#lightbox');
bconf.status.windowWidth = $(window).width();
bconf.transmi = {step1: bconf.status.windowWidth*.9 };
//weather codes
bconf.weatherCodes = {rain :['389', '386', '377', '374', '371', '365', '362', '359', '356', '353', '320', '317', '308', '305', '296', '293']};
bconf.weatherCodes.clouded = ['266', '263', '200', '176', '122', '119'];
bconf.weatherCodes.partlyClouded = ['116', '299'];
bconf.weatherCodes.clear = '113';

//methods

bconf.linkAction = function(){
	$('body').delegate('a', 'click', function(e){

		var dataLink = $(this).attr('data-link');
		var href = $(this).attr('href');
		var contentToLoad;
		
		if(!dataLink){
			return true;
		}
		
		switch(dataLink){
			case 'load-left':
				// contentToLoad = $(this).attr();
				//TODO: Factor!!
				bconf.layer.transmi.stop().scrollLeft(0).animate({scrollLeft: bconf.transmi.step1}, 2000, 'easeOutExpo');
				bconf.layer.leftContent.fadeOut(function(){
					bconf.layer.leftContent.load(href, function(){
						bconf.layer.leftContent.fadeIn();
						bconf.layer.transmi.stop().animate({scrollLeft: bconf.status.windowWidth+600}, 2000, 'easeOutExpo');
						bconf.fixColumnHeights();
					});
				});
				break;
			case 'lightbox':
				bconf.layer.overlay.fadeIn();
				bconf.layer.lightbox.find('#content').load(bconf.baseUrl+href, function(){
					$(this).parent().fadeIn().animate({top:($(window).height()-$(this).height())/2});	
				});

				console.log('lightbox');
				break;
			case 'lightbox-close':
				bconf.layer.overlay.fadeOut();
				bconf.layer.lightbox.fadeOut();
				console.log('lightbox close');
				break;
			default:
				return true;
				break;
		}
		return false;
		

	});
	
	$('nav a').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
	});
}

bconf.purchaseSubmitAction = function(){
	$('#lightbox').delegate('form', 'submit', function(e){
		formData = $(this).serialize();
		postUrl = $(this).attr('action');
		$.post(postUrl, formData, function(results){
			console.log(results);
			if(results.success == true){
				$('#purchase').slideUp(function(){
					$(this).html(results.message).slideDown(function(){
						bconf.layer.lightbox.animate({top:($(window).height()-$(this).height())/2});
					});
				});
			}else{
				$('#instructions').slideUp(function(){
					$(this).html(results.errors).addClass('error').slideDown();
				});
			}
		}, 'json');

		return false;
	});
}

bconf.fixColumnHeights = function(){
	if(bconf.layer.sidebar.height() < 1040 && bconf.layer.leftContent.height() > 1040){
		bconf.layer.sidebar.height(bconf.layer.leftContent.height());
	}else{
		bconf.layer.sidebar.height(1039);
	}
}
//weather
bconf.setWeather = function(code){
	
	//clear
	if(code == '113'){
		return false;
	}
	//partly clouded
	if(bconf.findInArray(bconf.weatherCodes.partlyClouded, code)){
		bconf.layer.clouds.addClass('clouds');
		return false;
	}
	//raining
	if(bconf.findInArray(bconf.weatherCodes.rain, code)){
		bconf.layer.header.addClass('rain');
		bconf.layer.clouds.addClass('clouds');
		return false;
	}
	//clouded
	else if(bconf.findInArray(bconf.weatherCodes.clouded, code)){
		bconf.layer.header.addClass('gray');
		bconf.layer.clouds.addClass('clouds');
		return false;
	}
	

}

bconf.weatherAnimate = function(){
	$('#clouds .inner').css('right', 0).animate({right: 6400}, 120000, 'linear', function(){
		bconf.weatherAnimate();
	});
};

bconf.weatherAnimateDouble = function(){
	$('#clouds .double').css('right', 0).animate({right: 6400}, 180000, 'linear', function(){
		bconf.weatherAnimateDouble();
	});
};

//animations
bconf.transmiAnimate = function(){
	bconf.layer.transmi.scrollLeft(0).animate({scrollLeft: bconf.transmi.step1}, 3000, 'easeOutExpo', function(){
		$(this).delay(1000).animate({scrollLeft: bconf.status.windowWidth+600}, 1000, 'easeOutExpo', function(){
			// window.setTimeout(function(){
			//	bconf.transmiAnimate();
			// },6000);
		});
	});
};

//feature detection
bconf.noPlaceholder = function(){
	var email = $('#email');
	email.val('No somos amigos del spam');
	
	email.focus(function(){
		$(this).val('');
	}).blur(function(){
		if($(this).val() == ''){
			$(this).val('No somos amigos del spam');
		}
	});
	
};

bconf.noRequired = function(){
	var email = $('#email');
	$('#give-email').submit(function(){
		if(email.val() == '' || email.val() == 'No somos amigos del spam' || email.val() == ':('){
			email.val(':(');
			return false;
		}
		
		validRegExp = /^[^@]+@[^@]+.[a-z]{2,}$/i;
		var strEmail = email.val();
		
		if(strEmail.search(validRegExp) == -1){
			email.val(':(');
		}else{
				$.post(bconf.baseUrl+'store_email/', $(this).serialize(), function(data){
					$('#flash .wrapper').html(data.message).slideDown().delay(6000).slideUp();
					email.val(':)');
				}, 'json');
				
					email.focus(function(){
						$(this).val('');
					}).blur(function(){
						if($(this).val() == ''){
							$(this).val('No somos amigos del spam');
						}
					});
		}
		return false;
	});
}();


$(document).ready(function(){
	if(window.location.pathname == '/' || window.location.pathname == '/bconf/'){
		$('nav a').first().addClass('active');
	}
	//hide flashmessage
	$('#flash .show').delay(3000).slideUp();
	
	//event handlers
	bconf.linkAction();
	bconf.purchaseSubmitAction();
	
	//landingpage script
	if(bconf.layer.body.hasClass('weather')){
		bconf.transmiAnimate();
		bconf.weatherAnimate();
		bconf.weatherAnimateDouble();
		
		//weather
		$.get('http://free.worldweatheronline.com/feed/weather.ashx?q=Bogota&format=json&num_of_days=1&key=3105835f23235510110804',function(weather){
			 bconf.setWeather(weather.data.current_condition[0].weatherCode);
		},'jsonp'); 

		//modernizr
		// if placeholder isn't supported:
		//		if (!Modernizr.input.placeholder){
		// bconf.noPlaceholder();
		//		}
	}

	bconf.fixColumnHeights();
	
	
});
