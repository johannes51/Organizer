window.onload = function()
{
	$('#formbox').toggle();
	$('#formtoggle').click(function(ev) {
		ev.preventDefault();
		$('#formbox').toggle();
	});
}

