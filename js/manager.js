function openshare(id){
				$.ajax({
    				url: 'share.php',
    				type: 'POST',
    				data:'idmp3='+id,
    				dataType: 'json',
    				success: function(json) {
    					if(json.reponse=="login")
							alert('login Plz') ;
    					else{
    						$('#imgshare').attr('src',json.img);
							$('#btnshare').attr('onclick','share('+id+')');
							$('#share_response').html('');
							document.getElementById('div_share_response').style.display="none";
    					}
    				}
    			});
				

			}
function share(id){
				var button_submit=$('#btnshare')
				button_submit.html('<img src="http://upload.wikimedia.org/wikipedia/commons/4/42/Loading.gif"> Please wait...');
				$.ajax({
    				url: 'share.php',
    				type: 'POST',
    				data:'id='+id,
    				dataType: 'json',
    				success: function(json) {
    				if(json.reponse=="login") alert('login Plz') ;
    				$('#share_response').html(json.reponse);
				    document.getElementById('div_share_response').style.display="block";
				    button_submit.html('Share');
    				if(json.nb!=0) $('#nb_share'+id).html('('+json.nb+')');
    				}
    				
				});
			}
function like(id){
				
				$.ajax({
    				url: 'like.php',
    				type: 'POST',
    				data:'idmp3='+id,
    				dataType: 'json',
    				success: function(json) {
    					if(json.reponse=="login"){
    						alert('login Plz') ;}
    						//$("#modal-container-login").modal();
    					else {
    						$('#nb_like'+id).html('('+json.nb+')');
    						if(json.reponse==1)
    						$('#likeid'+id).html("Dislike");
    						else
    						$('#likeid'+id).html("Like");	
    					}
    					}
				});
			}


function opencomment(id){
				$.ajax({
    				url: 'comment.php',
    				type: 'POST',
    				data:'idmp3='+id,
    				dataType: 'json',
    				success: function(json) {
    				    if(json.reponse=="login")
    						alert('login Plz') ;
    					else {
    						$('#comentmp3').html(json.reponse);
    						$('#mp3_id').val(id);
    					}
    				}
    				
				});
			}

$(document).ready(function(){
    $('#form_comment').submit(function(id){
 
        //setup variables
        var form = $(this),
        formData = form.serialize(),
        formUrl = form.attr('action'),
        formMethod = form.attr('method')
		var button_submit=$('#btnshare')
		button_submit.html('<img src="http://upload.wikimedia.org/wikipedia/commons/4/42/Loading.gif"> Please wait...');
        //send data to server
        $.ajax({
            url: formUrl,
            type: formMethod,
            data: formData,
            dataType: 'json',
            success:function(json){
				$('#comentmp3').html(json.reponse);
				button_submit.html('comment');
				$('#inputcomment').val('');
				if(json.nb!=0) $('#nb_comment'+json.id).html('('+json.nb+')');}
              
        });
 
        //prevent form from submitting
        return false;
    });
});
				
$(document).ready(function(){
    $('#signup').submit(function(){
 
        //setup variables
        var form = $(this),
        formData = form.serialize(),
        formUrl = form.attr('action'),
        formMethod = form.attr('method'), 
        responseMsg = $('#signup_response')
		var button_submit=$('#signup-button')
		button_submit.html('<img src="http://upload.wikimedia.org/wikipedia/commons/4/42/Loading.gif"> Please wait...');
        //send data to server
        $.ajax({
            url: formUrl,
            type: formMethod,
            data: formData,
            dataType: 'json',
            success:function(json){
				if(json=="login")
    			  location.href = "profile.php";
    			else{
				responseMsg.html(json);
				document.getElementById('div_signup_response').style.display="block";
				button_submit.html('Sign Up');}
              }
        });
 
        //prevent form from submitting
        return false;
    });
});


$(document).ready(function(){
    $('#login').submit(function(){
 
        //setup variables
        var form = $(this),
        formData = form.serialize(),
        formUrl = form.attr('action'),
        formMethod = form.attr('method'), 
        responseMsg = $('#login_response')
		var button_submit=$('#login-button')
		button_submit.html('<img src="http://upload.wikimedia.org/wikipedia/commons/4/42/Loading.gif"> Please wait...');
        //send data to server
        $.ajax({
            url: formUrl,
            type: formMethod,
            data: formData,
            dataType: 'json',
            success:function(json){
				if(json=="login")
    			  location.href = "index.php";
    			else{
					if(json!="success"){
					responseMsg.html(json);
					button_submit.html('LogIn')
					document.getElementById('div_login_response').style.display="block";}
					else  window.location.replace("index.php");
				}
              }
        });
 
        //prevent form from submitting
        return false;
    });
});


$(document).ready(function(){
    $('#init').submit(function(){
 
        //setup variables
        var form = $(this),
        formData = form.serialize(),
        formUrl = form.attr('action'),
        formMethod = form.attr('method'), 
        responseMsg = $('#init_response')
		var button_submit=$('#init_button')
		button_submit.html('<img src="http://upload.wikimedia.org/wikipedia/commons/4/42/Loading.gif"> Please wait...');
        //send data to server
        $.ajax({
            url: formUrl,
            type: formMethod,
            data: formData,
            dataType: 'json',
            success:function(json){
				if(json=="login")
    				location.href = "index.php";
    			else{
				responseMsg.html(json);
				document.getElementById('div_init_response').style.display="block";
				button_submit.html('Find');}
              }
        });
 
        //prevent form from submitting
        return false;
    });
});

$(document).ready(function(){
    $('#reset').submit(function(){
 
        //setup variables
        var form = $(this),
        formData = form.serialize(),
        formUrl = form.attr('action'),
        formMethod = form.attr('method'), 
        responseMsg = $('#reset_response')
		var button_submit=$('#reset_button')
		button_submit.html('<img src="http://upload.wikimedia.org/wikipedia/commons/4/42/Loading.gif"> Please wait...');
		
        //send data to server
        $.ajax({
            url: formUrl,
            type: formMethod,
            data: formData,
            dataType: 'json',
            success:function(json){
				if(json=="login")
    				location.href = "index.php";
    			else{
				responseMsg.html(json);
				document.getElementById('div_init_response').style.display="block";
				button_submit.html('Reset');}
              }
        });
 
        //prevent form from submitting
        return false;
    });
});
$(document).ready(function(){
    $('#activate').submit(function(){
 
        //setup variables
        var form = $(this),
        formData = form.serialize(),
        formUrl = form.attr('action'),
        formMethod = form.attr('method'), 
        responseMsg = $('#activate_response')
		var button_submit=$('#activate_button')
		button_submit.html('<img src="http://upload.wikimedia.org/wikipedia/commons/4/42/Loading.gif"> Please wait...');
        //send data to server
        $.ajax({
            url: formUrl,
            type: formMethod,
            data: formData,
            dataType: 'json',
            success:function(json){
				if(json=="login")
    				location.href = "index.php";
    			else{
				responseMsg.html(json);
				document.getElementById('div_activate_response').style.display="block";
				button_submit.html('Activate');}
              }
        });
 
        //prevent form from submitting
        return false;
    });
});

