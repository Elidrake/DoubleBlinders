var clicks = 0;
var numComments = $("span.cspan").length;

// load comments
$(document).ready(loadComments());

$("#code").on("click", "button.cmnt", function() {
	if ($(this).next("span.comment").html() == "") {
		$(this).next("span.comment").html($(this).attr("data-value"));
		$(this).next(".comment").slideToggle("slow");
	} else {
		$(this).next(".comment").slideToggle("slow");
		$(this).attr("data-value", $(this).next("span.comment").html());
		$(this).next("span.comment").html("");
	}
	// add flipping down arrow
});

$("#code").on("click", "span.placeholder", function() {
	var p = $(event.target).parent("p.input");
	$(event.target).remove();
	p.focus();
});

$("#code").on("click", "p.input", function() {
	$(event.target).children("span.placeholder").remove();
	$(event.target).focus();
});

$("code").on("click", ":not(span)", "#code", function() {
	if ($(event.target).parents("span.cspan").length) {
		return;
	}
	var userSelection;
	var buttonFlag = false;
	if (window.getSelection) {
	    userSelection = window.getSelection();
	    if(userSelection.anchorNode.parentElement.tagName == "BUTTON") {
			console.log("Error: Two comments next to each other");
			buttonFlag = true;
			return;
	    }
	}
	/*else if (document.selection) { // Opera
	    userSelection = document.selection.createRange();
	}*/
	
	var range;
	if (userSelection.getRangeAt)
	    range = userSelection.getRangeAt(0);
	else { // Safari
	    range = document.createRange();
	    range.setStart(userSelection .anchorNode, userSelection.anchorOffset);
	    range.setEnd(userSelection.focusNode, userSelection.focusOffset);
	    
	}
	var comment = document.createElement("span");
	numComments++;
	$(comment).attr("class", "cspan");
	comment.innerHTML = '<button class="cmnt" data-value="">(▼)</button><span class="comment" style="display: block;"><p class="input" contenteditable="true"><span class="placeholder">Insert comment here...</span></p><input type="text" class="name" placeholder="Name" value=""><button class="save">Save Comment</button></span></span>';
	range.insertNode(comment);
	updateCNums();
});

$("#code").on("click", "button.save", function() {
	var comment = $(this).prevAll("p.input").text().replace(/&/g,"&amp;").replace(/</g, "&lt;").replace(/"/g, "&quot;").replace(/'/g, "&#39;");
	var name = $(this).prev("input.name").val();
	var lineNum = getLineNum($(this).parents("span.cspan").attr("data-value"));
	var charNum = getCharNum($(this).parents("span.cspan").attr("data-value"), lineNum);
	//window.alert("Comment: " + comment + "\n\nName: " + name + "\n\nLine Num: " + lineNum + "\n\ncharNum: " + charNum);
	$.post("/api/v1/comments", { lineNumber: lineNum, charNumber: charNum, userName: name, content: comment });
});

function loadComments() {
	$.getJSON("/api/v1/comments", {get_param: "comments"}, function(data) {
		$.each(data, function(index, element) {
		    $.each(element, function(key, value) {
		    	var line = $("#code").text().split("\n").slice(value["lineNumber"]-1, parseInt(value["lineNumber"]));
		    	var otherComments = (line[0]).split("(▼)");
/* 		    	var addComment = line.substring(0, parseInt(value["charNumber"])); */
				var charNum = parseInt(value["charNumber"]);
				var totalLength = 0;
				var commentsBefore = 0;
		    	for(var i = 0; i < otherComments.length; i++) {
		    		if (totalLength + otherComments[i].length < charNum) {
		    			totalLength += otherComments[i].length;
		    			commentsBefore++;
		    		} else {
		    			break;
		    		}
		    	}
		    	charNum += commentsBefore * 3;
		    	var buildComment = '<span class="cspan"><button class="cmnt" data-value="<p class=&quot;input&quot; contenteditable=&quot;false&quot;>' + value["content"] + '</p><input type=&quot;text&quot; class=&quot;name&quot; value=&quot;' + value["userName"] + '&quot;></span>">(▼)</button><span class="comment" style="display: none;"></span></span>';
		    	var addComment = line[0].substring(0, charNum).replace(/</g, "&lt;") + buildComment + line[0].substring(charNum).replace(/</g, "&lt;");
		    	
				var before = $("#code").html().split("\n").slice(0, value["lineNumber"]-1);
				var after = $("#code").html().split("\n").slice(value["lineNumber"]);
				$("#code").html(before.join("\n") + ("\n") +  addComment + ("\n") + after.join("\n"));
				numComments++;
		    });
		});
		updateCNums();
	});
}

function getLineNum(cNum) {
    var delimiter = "(▼)";
    var tokens = $("#code").text().split(delimiter).slice(0, cNum);
    var result = tokens.join(delimiter);
    return (result.match(/\n/g) || []).length + 1;
}

function getCharNum(cNum, lineNum) {
    var tokens = $("#code").text().split("(▼)").slice(0, cNum);
    var line = tokens.join("");
    var charNum = line.split("\n").slice(lineNum-1, lineNum)[0].length;
	return charNum;
}

function updateCNums() {
	var count = 0;
	var comments = $("#code").children("span.cspan");
	for(var i = 0; i < comments.length; i++) {
		$(comments[i]).attr("data-value", ++count);
	}
}


















