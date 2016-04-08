// vars
var fileId = -1;

// load comments
$(document).ready(prepCode());
//$(document).ready(loadComments());

// wrap lines in span tags
// TODO: extend line "clickability" to end of line
function prepCode() {
	var code = "";
    var lines = $('#code').text().split("\n");
    for (var i = 0; i < lines.length; i++) {
    	code += '<span class="line" id="line' + i + '">' + lines[i].replace(/</g, "&lt;") + '\n</span>';
    }
    $('#code').html(code);
}

// expand/contract comments on click
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

// add comments to lines on click
$("#code").on("click", ".line", function() {
	if ($(event.target).attr("id") == undefined) {
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
	/*else if (document.selection) { // Opera
	    userSelection = document.selection.createRange();
	}*/
	
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
	var comment = document.createElement("span");
	//numComments++;
	$(comment).attr("class", "cspan");
	$(comment).attr("data-value", charOffset);
	comment.innerHTML = '<button class="cmnt" data-value="">(▼)</button><span class="comment" style="display: block;"><p class="input" contenteditable="true"><span class="placeholder">Insert comment here...</span></p><input type="text" class="name" placeholder="Name" value=""><button class="save">Save Comment</button></span></span>';
	if (!buttonFlag) {
		range.insertNode(comment);	
	} else {
		$(comment).insertAfter($(this).find('[data-value="' + charOffset + '"]'));
	}
	//updateCNums();
});

$("#code").on("click", "button.save", function() {
	var comment = $(this).prevAll("p.input").text().replace(/&/g,"&amp;").replace(/</g, "&lt;").replace(/"/g, "&quot;").replace(/'/g, "&#39;");
	var name = $(this).prev("input.name").val();
	var lineNum = parseInt($(this).parents("span.line").attr("id").substring(4));
	var charNum = parseInt($(this).parents("span.cspan").attr("data-value"), lineNum);
	//console.log("Comment: " + comment + "\n\nName: " + name + "\n\nLine Num: " + lineNum + "\n\ncharNum: " + charNum + "\n\nfileId: " + fileId);
	if (fileId != -1) {
		//alert("Comment: " + comment + "\n\nName: " + name + "\n\nLine Num: " + lineNum + "\n\ncharNum: " + charNum + "\n\nfileId: " + fileId);
		$.post("/api/v1/files/" + fileId + "/comments", { lineNumber: lineNum, charNumber: charNum, userName: name, content: comment });
	}
});