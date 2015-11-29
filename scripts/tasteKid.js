$('.getPreview').on('click', function(ev){
	if($(this).html() == 'Preview'){
	ev.preventDefault();
	//console.info(ev);
	var myVars = {'filmID': $(this).attr('data-id')};
	var currentNode = $(this);
	$.get('data/getPreview.php', myVars, function(myData) {
		//console.dir(myData);
		//console.info(myData.filmDesc);
		//console.info($(this));
		//$("<p></p>", {text:myData.filmDesc, class : "previewText"}).insertAfter($(currentNode)).fadeIn(1000);
		$("<p></p>", {text:myData.filmDesc, class : "previewText"}).insertAfter($(currentNode)).slideDown(1000);
		$(currentNode).html('Hide Preview');
	}, 'json');
	//});
	}else{
		$(this).parent().children('.previewText').fadeOut(500, function(){
			$(this).parent().children('.previewText').remove();	
		});
		$(this).html('Preview');	
	}
});