(function($){

var loadBusRatp = function(ajaxUrl, callback){
	if(!ajaxUrl) ajaxUrl = window.location.href;
	$('#content').load(ajaxUrl+" #content_inner", function(data){
		if( typeof(callback)=='function' ) callback();
	});
}

var autoTimeout = false;
var autorefreshBusRatp = function(){
	autoTimeout = setTimeout(function(){
		loadBusRatp(false, autorefreshBusRatp);
	}, 20000);
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