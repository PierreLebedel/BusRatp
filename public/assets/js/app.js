(function($){

var $form = $('#form');
var $type = $('#select_type');
var $line = $('#input_line');
var $stop = $('#select_stop');
var $refresh = $('#refresh');

$type.change(function(){
	$line.attr('disabled', true);
	$stop.attr('disabled', true);
	$('body').addClass('loading');
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
		$('body').addClass('loading');
		$form.submit();
	}
});

$stop.change(function(){
	$('body').addClass('loading');
	$form.submit();
});

$refresh.click(function(e){
	e.preventDefault();
	$('body').addClass('loading');
	window.location.reload();
});


})(jQuery);