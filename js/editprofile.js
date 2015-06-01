$(document).ready(function(){
    $('#edit_profile').submit(function(){
 
        //setup variables
        var form = $(this),
        formData = form.serialize(),
        formUrl = form.attr('action'),
        formMethod = form.attr('method'), 
        responseMsg = $('#div_edit_response')
        var button_submit=$('#edit_button')
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
                document.getElementById('div_edit_response').style.display="block";
                button_submit.html('All changes saved');}
              }
        });
 
        //prevent form from submitting
        return false;
    });
});

