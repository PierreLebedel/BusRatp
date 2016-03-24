(function($){

var $form = $('#form');
var $type = $('#select_type');
var $line = $('#input_line');
var $stop = $('#select_stop');
var $refresh = $('#refresh');

$type.change(function(){
	$stop.attr('disabled', true);
	$('body').addClass('loading');
	$form.submit();
});

$line.focus(function(){
	$(this).val('');
});

$line.blur(function(){
	$stop.attr('disabled', true);
	$('body').addClass('loading');
	$form.submit();
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