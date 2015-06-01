$('document').ready(function(){ 

    $('input[id=fileimgadd]').change(function() {
                        $('#imgadd').val($(this).val());
                    });
    $('input[id=filemp3add]').change(function() {
                        $('#mp3add').val($(this).val());
                    });
    $('input[id=fileimgupdate]').change(function() {
                        $('#imgupdate').val($(this).val());
                    });
    $('input[id=filemp3update]').change(function() {
                        $('#mp3update').val($(this).val());
                    });
});
function openupdate(id){

                    $.ajax({
                    url: 'update_mp3.php',
                    type: 'POST',
                    data:'idmp3='+id,
                    dataType: 'json',

                    success: function(json) {
                        if(json.reponse=="login")
                            alert('login Plz') ;
                        else{
                            $('#mp3username').val(json.mp3name);
                            $('#mp3_id').val(id);
                            $('#imgupdate').val(json.img);
                            $('#mp3update').val(json.resource);
                            $('#div_update_response').html('');
                            document.getElementById('div_update_response').style.display="none";;
                        }
                    }
                });

        }





function del(id){
	$.ajax({
    				url: 'delete.php',
    				type: 'POST',
    				data:'id='+id,
    				dataType: 'json',
    				success: function(json) {
    					if(json=="login")
    						alert('login Plz') ;
    					else {
    						if(json!=0)
    						$('#deleteid'+id).html("");
    						

    					}
    					}
				});
}	

function del_user(id){
    $.ajax({
                    url: 'manageruser.php',
                    type: 'POST',
                    data:'id_delet='+id,
                    dataType: 'json',
                    success: function(json) {
                        if(json=="login")
                            alert('login Plz') ;
                        else {
                            if(json=="4")
                            //$('#deleteuser'+id).html("");
                            //user_delete_button.html('User deleted');
                            location.href = "users.php";

                        }
                        }
                });
}   
$('document').ready(function(){ 
$('#update_button').click(function(){
        $('#update_button').html('<img src="http://upload.wikimedia.org/wikipedia/commons/4/42/Loading.gif"> Please wait...');
            });
$('#add_button').click(function(){
        $('#add_button').html('<img src="http://upload.wikimedia.org/wikipedia/commons/4/42/Loading.gif"> Please wait...');
            });
 });