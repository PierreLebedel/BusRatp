(function($){

var loadBusRatp = function(ajaxUrl, callback){
	if(!ajaxUrl) ajaxUrl = window.location.href;
	$('#content').load(ajaxUrl+" #content_inner", function(data){
		if( typeof(callback)=='function' ) callback();
	});
}


var isWindowActive;
window.onfocus = function(){ 
	isWindowActive = true; 
}; 

window.onblur = function(){ 
	isWindowActive = false; 
}; 


var autoTimeout = false;
var autoTimeoutEven = false;
var autoTimeoutDuration = 20000;

var $loader = $('#loader');

var autorefreshBusRatp = function(){
	autoTimeout = setTimeout(function(){
		if(isWindowActive){
			loadBusRatp(false, autorefreshBusRatp);
		}else{
			autorefreshBusRatp();
		}
	}, autoTimeoutDuration);

	if(autoTimeoutEven){
		autoTimeoutEven = false;
		$loader.css({left:'auto', right:0});
		$loader.animate({
			width:'0%'
		}, autoTimeoutDuration, 'linear');
	}else{
		autoTimeoutEven = true;
		$loader.css({left:0, right:'auto'});
		$loader.animate({
			width:'100%'
		}, autoTimeoutDuration, 'linear');
	}
}
autorefreshBusRatp();

//////////

var $form = $('#form');
var $type = $('#select_type');
var $line = $('#input_line');
var $stop = $('#select_stop');
var $refresh = $('#refresh');

$type.change(function(){
	$line.attr('disabled', true);
	$stop.attr('disabled', true);
	$form.submit();
});

var previousLine = '';
$line.focus(function(){
	previousLine = $line.val();
	$line.val('');
});

$line.blur(function(){
	if( $line.val()=='' ){
		$line.val(previousLine);
	}else{
		$stop.attr('disabled', true);
		$form.submit();
	}
});

$stop.change(function(){
	$form.submit();
});

$refresh.click(function(e){
	e.preventDefault();
	$form.submit();
});

$form.submit(function(e){
	//e.preventDefault();
	clearTimeout(autoTimeout);
	$('body').addClass('loading');
	/*var formData = $form.serialize();
	var newUrl = window.location.origin + window.location.pathname + '?' + formData;
	loadBusRatp(newUrl, function(){
		$line.removeAttr('disabled');
		$stop.removeAttr('disabled');
		$('body').removeClass('loading');
		history.pushState({}, '', newUrl);
	});*/
});










})(jQuery);