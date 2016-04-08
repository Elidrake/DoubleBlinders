// load available code
$(document).ready(loadAvailableCode());

function loadAvailableCode() {
	//var filesPresent = false;
	$('#review-list').html("");
    $.getJSON("/api/v1/files", {get_param: "files"}, function(data) {
		$.each(data, function(index, element) {
		    $.each(element, function(key, value) {
		    	//filesPresent = true;
		    	$('#review-list').append('<p><a href="#" class="fileLink" data-id="' + value["id"] + '">File ' + value["id"] + ' by ' + value["createdBy"] + '</a></p>');
		    });
		});
	});
	/*if (!filesPresent) {
	    $('#review-list').html("<p>There are no files ready for you to review at this time.</p>");
	}*/
}

$("#review-list").on("click", ".fileLink", function() {
	var id = $(this).attr('data-id');
    $.getJSON("/api/v1/files", {get_param: "files"}, function(data) {
		$.each(data, function(index, element) {
		    $.each(element, function(key, value) {
				if (value["id"] == id) {
					fileId = id;
					$('#intro').html("");
					var content = value["fileContent"];
					var code = "";
				    var lines = content.split("\n");
				    for (var i = 0; i < lines.length; i++) {
				    	code += '<span class="line" id="line' + i + '">' + lines[i].replace(/</g, "&lt;") + '\n</span>';
				    }
				    $('#code').html(code);
			    	//$('#code').html(value["fileContent"].replace(/</g, "&lt;"));
				}
		    });
		});
	});
});