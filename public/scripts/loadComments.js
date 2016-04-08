// load available code
$(document).ready(loadAvailableCode());

function loadAvailableCode() {
	//var filesPresent = false;
	$('#upload-list').html("");
    $.getJSON("/api/v1/files", {get_param: "files"}, function(data) {
		$.each(data, function(index, element) {
		    $.each(element, function(key, value) {
		    	// TODO: Get current user name
		    	/*if (value["createdBy"] == "Alex") {
			    	$('#upload-list').append('<p><a href="#" class="fileLink" data-id="' + value["id"] + '">File ' + value["id"] + ' by ' + value["createdBy"] + '</a></p>');
			    }*/
			    $('#upload-list').append('<p><a href="#" class="fileLink" data-id="' + value["id"] + '">File ' + value["id"] + ' by ' + value["createdBy"] + '</a></p>');
		    });
		});
	});
	/*if (!filesPresent) {
	    $('#review-list').html("<p>There are no files ready for you to review at this time.</p>");
	}*/
}

$("#upload-list").on("click", ".fileLink", function() {
	var id = $(this).attr('data-id');
    $.getJSON("/api/v1/files", {get_param: "files"}, function(data) {
		$.each(data, function(index, element) {
		    $.each(element, function(key, value) {
				if (value["id"] == id) {
					fileId = id;
				    loadComments(value["fileContent"]);
				}
		    });
		});
	});
});

function loadComments(code) {
	$('#intro').html("");
	$.getJSON("/api/v1/files/" + fileId + "/comments", {get_param: "comments"}, function(data) {
		$.each(data, function(index, element) {
		    $.each(element, function(key, value) {
				var lines = code.split("\n");
		    	var lineNum = parseInt(value["lineNumber"]);
				var charNum = parseInt(value["charNumber"]);
		    	var buildComment = '<span class="cspan" data-value="' + charNum + '"><button class="cmnt" data-value="<p class=&quot;input&quot; contenteditable=&quot;false&quot;>' + value["content"] + '</p></span>">(▼)</button><span class="comment" style="display: none;"></span></span>';
		    	//var line = lines[lineNum];
		    	//var pullComments = line.split()
		    	lines[lineNum] = lines[lineNum].substring(0, charNum) + buildComment + lines[lineNum].substring(charNum);
		    	code = lines.join("\n");
				$('#code').html(code);
		    });
		});
	});
}