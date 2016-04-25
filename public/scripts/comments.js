// vars
var fileId = -1;
var groupId = -1;
/*var startLine = -1;
var startChar = -1;
var endLine = -1;
var endChar = -1;*/

// load comments
$(document).ready(prepCode());
//$(document).ready(loadComments());

// wrap lines in span tags
// TODO: extend line "clickability" to end of line
function prepCode() {
	var code = "";
    var lines = $('#code').text().split("\n");
    for (var i = 0; i < lines.length; i++) {
    	code += '<span class="line" id="line' + i + '">' + lines[i].replace(/</g, "&lt;") + '</span>\n';
    }
    $('#code').html(code);
}

// expand/contract comments on click
$("#code").on("click", "button.cmnt", function() {
	if ($(this).next("span.comment").html() == "") {
		$(this).next("span.comment").html($(this).attr("data-value"));
		var startLine = $(this).parent().attr("data-startLine");
		var startChar = $(this).parent().attr("data-start");
		var endLine = $(this).parent().attr("data-line");
		var endChar = $(this).parent().attr("data-end");
		var line = $("#" + startLine).html();
		if (startLine != endLine) {
			line = line.substring(0, startChar) + '<span id="startFlag" data-start="' + startChar + '">►[</span>' + line.substring(startChar);
			$("#" + startLine).html(line);
			line = $("#" + endLine).html();
			line = line.substring(0, endChar) + '<span id="endFlag" data-end="' + endChar + '">]◄</span>' + line.substring(endChar);
			$("#" + endLine).html(line);
		} else {
			line = line.substring(0, startChar) + '<span id="startFlag" data-start="' + startChar + '">►[</span>' + line.substring(startChar, endChar) + '<span id="endFlag" data-end="' + endChar + '">]◄</span>' + line.substring(endChar);
			$("#" + startLine).html(line);
		}
		$(this).next(".comment").slideToggle("slow");
		$(this).html("(▲)");
	} else {
		$(this).next(".comment").slideToggle("slow");
		$(this).attr("data-value", $(this).next("span.comment").html());
		$(this).next("span.comment").html("");
		$("#startFlag").remove();
		$("#endFlag").remove();
		$(this).html("(▼)");
	}
});

// focus stray clicks onto the comment input p
$("#code").on("click", "span.placeholder", function() {
	var p = $(event.target).parent("p.input");
	$(event.target).remove();
	p.focus();
});

// focus stray clicks onto the comment input p
$("#code").on("click", "p.input", function() {
	$(event.target).children("span.placeholder").remove();
	$(event.target).focus();
});

// selection start
$("#code").on("mouseup, touchend, click", function() {
	if (!$("#selStart").is(":visible")) {
		return;
	}
	if ($(event.target).attr("id") == undefined || $("#startFlag").length > 0) {
		return;
	}
	var userSelection;
	var charOffset;
	var buttonFlag = false;
	if (window.getSelection) {
	    userSelection = window.getSelection();
	    if(userSelection.anchorNode.parentElement.tagName == "BUTTON") {
			charOffset = userSelection.anchorNode.parentElement.parentElement.getAttribute('data-value');
			buttonFlag = true;
	    }
	}
	var range;
	if (userSelection.getRangeAt)
	    range = userSelection.getRangeAt(0);
	else { // Safari
	    range = document.createRange();
	    range.setStart(userSelection.anchorNode, userSelection.anchorOffset);
	    range.setEnd(userSelection.focusNode, userSelection.focusOffset);
	}
	if (!buttonFlag) {
		charOffset = range.endOffset;
		var lastCmnt = userSelection.anchorNode.previousSibling;
		if (lastCmnt) {
			charOffset += parseInt(lastCmnt.getAttribute('data-value'));
		}
	}
	var start = document.createElement("span");
	$(start).attr("id", "startFlag");
	$(start).attr("data-start", charOffset);
	start.innerHTML = '►[';
	if (!buttonFlag) {
		range.insertNode(start);	
	} else {
		$(start).insertAfter($(this).find('[data-value="' + charOffset + '"]'));
	}
});

// selection end
$("#code").on("mouseup, touchend, click", function() {
	if (!$("#selEnd").is(":visible")) {
		return;
	}
	if ($(event.target).attr("id") == undefined || $("#endFlag").length > 0) {
		return;
	}
	var userSelection;
	var charOffset;
	var buttonFlag = false;
	if (window.getSelection) {
	    userSelection = window.getSelection();
	    if(userSelection.anchorNode.parentElement.tagName == "BUTTON") {
			charOffset = userSelection.anchorNode.parentElement.parentElement.getAttribute('data-value');
			buttonFlag = true;
	    }
	}
	var range;
	if (userSelection.getRangeAt)
	    range = userSelection.getRangeAt(0);
	else { // Safari
	    range = document.createRange();
	    range.setStart(userSelection.anchorNode, userSelection.anchorOffset);
	    range.setEnd(userSelection.focusNode, userSelection.focusOffset);
	}
	if (!buttonFlag) {
		charOffset = range.endOffset;
		var lastCmnt = userSelection.anchorNode.previousSibling;
		if (lastCmnt) {
			charOffset += parseInt(lastCmnt.getAttribute('data-start'));
		}
	}
	var end = document.createElement("span");
	$(end).attr("id", "endFlag");
	$(end).attr("data-end", charOffset);
	end.innerHTML = ']◄';
	if (!buttonFlag) {
		range.insertNode(end);	
	} else {
		$(end).insertAfter($(this).find('[data-value="' + charOffset + '"]'));
	}
});

// comment -> start toggle
$('#addCmnt').on("click", function() {
	$("#addCmnt").animate({width: "toggle"});
	$("#selStart").animate({width: "toggle"});
});

// start -> end toggle
$('#selStart').on("click", function() {
	if ($("#startFlag").length == 0) {
		alert("Please click within the code to mark the start of your comment's selection.");
		return;
	}
	$("#selStart").animate({width: "toggle"});
	$("#selEnd").animate({width: "toggle"});
});

// end -> create toggle
$('#selEnd').on("click", function() {
	if ($("#endFlag").length == 0) {
		alert("Please click within the code to mark the end of your comment's selection.");
		return;
	}
	$("#selEnd").animate({width: "toggle"});
	$("#createCancel").animate({width: "toggle"});
});


// cancel comment selection
$('#cancel').on("click", function() {
	$("#startFlag").remove();
	$("#endFlag").remove();
	$("#createCancel").animate({width: "toggle"});
	$("#addCmnt").animate({width: "toggle"});
});

// create -> comment toggle
$('#create').on("click", function() {
	$("#createCancel").animate({width: "toggle"});
	var comment = document.createElement("span");
	$(comment).attr("class", "cspan");
	$(comment).attr("data-start", $("#startFlag").attr("data-start"));
	$(comment).attr("data-startLine", $("#startFlag").parent().attr("id"));
	$(comment).attr("data-end", $("#endFlag").attr("data-end"));
	$(comment).attr("data-line", $("#endFlag").parent().attr("id"));
	comment.innerHTML = '<button class="cmnt" data-value="">(▲)</button><span class="comment" style="display: block;"><p class="input" contenteditable="true"><span class="placeholder">Insert comment here...</span></p><button class="save">Save Comment</button></span></span>';
	$(comment).insertAfter($("#endFlag").parent());
});

// save comments on button click
$("#code").on("click", ".save", function() {
	var comment = $(this).prevAll("p.input").text().replace(/&/g,"&amp;").replace(/</g, "&lt;").replace(/"/g, "&quot;").replace(/'/g, "&#39;");
	if (comment == "Insert comment here...") {
		alert("Please input a comment before submitting.");
		return;
	}
	var lineNum = parseInt($("#endFlag").parent().attr("id").substring(4));
	var startLine = parseInt($("#startFlag").parent().attr("id").substring(4));
	var startChar = parseInt($(this).parents("span.cspan").attr("data-start"));
	var endChar = parseInt($(this).parents("span.cspan").attr("data-end"));
	var charNum = 0;
	comment = '►[' + startLine + ',' + startChar + ',' + lineNum + ',' + endChar + ']◄' + comment;
	//alert(comment);
	if (fileId != -1 && groupId != -1) {
		//alert("Comment: " + comment + "\n\nName: " + name + "\n\nLine Num: " + lineNum + "\n\ncharNum: " + charNum + "\n\nfileId: " + fileId);
		$.post("/api/v2/groups/" + groupId + "/files/" + fileId + "/comments", { lineNumber: lineNum, charNumber: charNum, content: comment });
	} else {
		alert("Error - no file or group specified - copy your comment and try reloading the page.");
	}
	$(this).parent().slideToggle("slow");
	$(this).parent().prev(".cmnt").attr("data-value", $(this).parent().html());
	// flip arrow direction
	$(this).parent().prev(".cmnt").html("(▼)");
	$(this).parent().html("");
	$("#startFlag").remove();
	$("#endFlag").remove();
	$("#addCmnt").animate({width: "toggle"});
});