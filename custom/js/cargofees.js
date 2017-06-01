var $lis = $('.list-group-item');

$lis.on('click', function(){
	$lis.removeClass('active');
	$(this).addClass('active');
});