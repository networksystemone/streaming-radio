function del(id){
	$.ajax({
    				url: 'delete.php',
    				type: 'POST',
    				data:'idshare='+id,
    				dataType: 'json',
    				success: function(json) {
    					if(json=="login")
    						alert('login Plz') ;
    					else {
    						if(json==1)
    						$('#deleteid'+id).html("");
    						

    					}
    					}
				});
}	
