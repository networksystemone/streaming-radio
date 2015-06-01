var playerCompatible = true 
var play = false; 

var tracks ;
var itemcurrent ;

$.ajax({
    async: false,
    url: "../mp3_json.php",
    type: 'GET',
    data:{'page':page, 'id': id},
    dataType: 'json',
    success: function(json) {
    	if(json==0) tracks="";
    	else tracks=json;
    	
    }
});

var currentTrack = 0;
var timer = null; 
	
	$('document').ready(function(){	
		
		
			$('#compatibility').css('display','none');
			$('header').css('display','block');
			$('#contentContainer').css('display','block');

			var item = tracks[0];
			itemcurrent=item;
			idd=item['track'];
			$('#audioPlayer').attr('src','../'+item['file']);
			$('#audioPlayer')[0].load();

			
			$('#audioPlay').on('canPlay', function(){
				alert('toto');
			});

	});
	



function changeSong(id){
	 var item = tracks[id];
	 itemcurrent=item;
	$('#audioPlayer').attr('src','../'+item['file']);
	$('#audioPlayer')[0].load();
	if(play) $('#audioPlayer')[0].play();
}


function PlayPause(id){
				id-- ;
				var idd=itemcurrent['track']-1 ;
				if(play){	
					if(id==idd){
						play = false;
						$('#audioPlayer')[0].pause();
						$('#playItem'+idd).attr('class','glyphicon glyphicon-play');
					}else{
					 play = true;
					 changeSong((id));
					 $('#playItem'+idd).attr('class','glyphicon glyphicon-play');
					 $('#playItem'+id).attr('class','glyphicon glyphicon-pause');
					}
					}else{
						if(id==idd){
						play = true;
						$('#audioPlayer')[0].play();
						$('#playItem'+id).attr('class','glyphicon glyphicon-pause');
						}else{
						play = true;
						changeSong((id));
						$('#playItem'+id).attr('class','glyphicon glyphicon-pause');}

				}
}

	
				
		
