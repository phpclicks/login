$(function()
{
	$('#log-in').click(function(event){
		event.preventDefault();

		$.post('include/process.php',$('#log-in-form').serialize(),function(resp)
		{
			if (resp['status'] == true)
			{
				location.href = "dashboard.php";
			}
			else
			{
				var htm = '<button data-dismiss="alert" class="close" type="button">×</button>';
				$.each(resp['msg'],function(index,val){
					htm += val+" <br>";
					});
				$("#error-msg").html(htm);
				$("#error-msg").show();	
				$(this).prop('disabled',false);
			}
		},'json');
	});
});




