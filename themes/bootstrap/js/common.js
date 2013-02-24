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