function wdAjax(url, data, onSuccess) {
	$.ajax({
		type: 'POST',
		url: url,
		data: data,
		dataType: 'json',
		success: function(data, textStatus, jqXHR){
			if (data.errorMsg) {
				alert(data.errorMsg);
				return;
			}
			
			if (onSuccess)
				onSuccess(data);
		},
		error: function(data) { alert('Internal server error.'); }
	});	
}

function wdSelectAll(_class){
	$(_class).each(function(){
		$(this).bind('click change', function(){
			var all = $(this);
			var form = all.parents('form');
			var fieldset = form.find('fieldset');
			
			fieldset.find("[type='checkbox']").each(function(){
				if (all.is(':checked'))
					$(this).attr('checked', 'checked');
				else
					$(this).attr('checked', false);
			})
		})
	})
}
