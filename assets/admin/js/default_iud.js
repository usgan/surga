$("form").submit(function(e){
	alamat = $(this). attr('action');
	id = $(this). attr('id');

	if(id == "createupdate"){
		e.preventDefault();
		if(editor == false){
			formdata =  new FormData($(this)[0]);
		}
		formdata.append('send','ajax');
		$.ajax({
			url: alamat,
			type: 'POST',
			data: formdata,
			async: false,
			cache: false,
			contentType: false,
			enctype: 'multipart/form-data',
			dataType: 'json',
			processData: false,
			success: function (response) {
				if(response['type'] == "success"){
					$.alert({
						title	: 'Info',	
						content : response['alert'],
						confirm: function(){
						 	if(response['reload'] == true){
								window.location.assign(window.location.href);
							}
						 }
					});
				}else{
					$.alert({
						title	: 'Info',	
						content : response['alert']
					});
				}
			},
			error : function(respons,status){
				alert(status);
			}
		});
	}
});

$(".hapus").click(function(e){
	e.preventDefault();
	alamat = $(this).attr('href');
	$.confirm({
	    title: 'Confirm!',
	    content: 'Yakin anda akan menghapus data ini ?',
	    confirm: function(){
	        fdata = {'send' : 'ajax'}
			$.post(alamat,fdata,function(response){
				if(response['type'] == "success"){
					$.alert({
						title	: 'Info',	
						content : response['alert'],
						confirm: function(){
						 	if(response['reload'] == true){
								window.location.assign(window.location.href);
							}
						 }
					});
				}else{
					$.alert(response['alert']);
				}
			},'json');
	    },
	    cancel: function(){
	        $.alert('Canceled!')
	    }
	});
});

$(".info").click(function(e){
	e.preventDefault();

	alamat = $(this).attr('href');
	fdata = {'send' : 'ajax'}

	$.post(alamat,fdata,function(response){
		if(response['type'] == "success"){
			$.alert({
				title	: 'Info',	
				content : response['content'],
				columnClass: 'col-md-6 col-md-offset-3'
			});
		}else{
			alert(response['alert']);
		}
	},'json');
});