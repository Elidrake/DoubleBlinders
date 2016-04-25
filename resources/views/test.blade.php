<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
 		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1.0">
		<title>University of Arizona Code Review</title>
		<link rel="stylesheet" type="text/css" href="/style.css" />
	</head>
	<body>
		<header>
				<a href="/"><img id="logo" src="/images/logo@1x.png" alt="U of A Code Review Logo" ></a>
		</header>
		<nav>
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="/review">Review Code</a></li>	
				<li><a href="/comments">View Comments</a></li>
				<li><a href="/upload">Upload</a></li>
				<li><a href="/classes">Classes</a></li>
				<li><a href="/account/logout">Logout</a></li>
			</ul>
		</nav>
		<section>
			<h2>Welcome to your U of A Code Review home page!</h2>
			<div id="addCmnt"><button>Add&nbsp;Comment</button></div>				<div id="selStart"><button>Choose&nbsp;Selection&nbsp;Start</button></div>
			<div id="selEnd"><button>Choose&nbsp;Selection&nbsp;End</button></div>
			<div id="createCancel"><button id="create">Create&nbsp;Comment</button><br><br><button id="cancel">Cancel</button></div>
			<pre><code>
				<div id="code">#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;stdlib.h&gt;

// load available assignments
$(document).ready(loadAvailableAssignments());

function loadAvailableAssignments() {
	$('#assignment-list').html("");
	// get user's groups
	var numGroups = 0;
	$.ajax({
	    async: false,
	    type: 'GET',
	    url: '/api/v2/groups',
	    success: function(data) {
	    	numGroups = data['groups'].length;
	    	// for each group...
			$.each(data['groups'], function(key, value) {
				$('#assignment-list').append('<h2>' + value['groupName'] + '</h2>');
	        	// load assignments for the group
	        	var numAssignments = 0;
				$.ajax({
				    async: false,
				    type: 'GET',
				    url: '/api/v2/groups/' + value['id'] + '/assignments',
				    success: function(data2) {
				    	numAssignments = data2['assignments'].length;
				    	// for each group...
						$.each(data2['assignments'], function(key2, value2) {
				        	// load assignments for the group
				        	$('#assignment-list').append('<p><a href="#" class="uploadLink" data-group="' + value['id'] +'" data-assignment="' + value2['id'] + '">' + value2['assignmentName'] + '</a></p>');
						});
				    }
				});
				if (numAssignments == 0) {
					$('assignment-list').append('<p>No pending assignments for this class</p>');
				}
			});
	    }
	});
	if (numGroups == 0) {
	    $('#assignment-list').html("<p>You aren't enrolled in any classes yet! Your professors assign you to classes based on your U of A email, so make sure that you signed up with your official U of A email address. It's also possible that you're checking in too soon, and classes have not been created.</p><p>If you think there's a mistake and you haven't been added to your class, you should contact your professor and they will look into it for you.</p>");
	}
}

$("#assignment-list").on("click", ".uploadLink", function() {
	$("#assignment-list").html('<form action="/api/v2/files" method="POST" enctype="multipart/form-data">' +
'				<input type="file" name="file" id="file">' +
'				<input type="hidden" name="group" value="' + $(this).attr('data-group') + '">' +
'				<input type="hidden" name="group" value="' + $(this).attr('data-assignment') + '">' +
'				<p><input type="submit" value="Send"></p>' +
'			</form>');
});
				</div>
			</code></pre>
			<!-- END SAMPLE CODE BLOCK -->
		</section>
		<script src="/scripts/jquery-1.10.2.js"></script>
		<script src="/scripts/comments.js"></script>
		<script src="/scripts/review.js"></script>
		<footer>
			<p>By Alex Guyot, John Oney, Dakota Trotter, and Carson Stelzer.</p>
		</footer>
	</body>
</html>