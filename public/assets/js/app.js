(function($){

var $form = $('#form');

$('#select_type').change(function(){
	$form.submit();
});

$('#input_line').focus(function(){
	$(this).val('');
});

$('#input_line').blur(function(){
	$('#select_stop').remove();
	$form.submit();
});

$('#select_stop').change(function(){
	$form.submit();
});


})(jQuery);