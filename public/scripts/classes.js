// get user info
var user = (function () {
	var role;
	$.ajax({
	     async: false,
	     type: 'GET',
	     url: '/api/v1/account',
	     success: function(data) {
	          role = data['account']['role'];
	     }
	});
    return role;
})();

// load available code
$(document).ready(loadAvailableClasses());

function loadAvailableClasses() {
	$('#class-list').html("");
	var numGroups = 0;
	$.ajax({
	    async: false,
	    type: 'GET',
	    url: '/api/v2/groups',
	    success: function(data) {
	    	numGroups = data['groups'].length;
			$.each(data['groups'], function(key, value) {
	        	$('#class-list').append('<p>' + value["groupName"] + '</p>');
			});
	    }
	});
	if (numGroups == 0) {
	    $('#class-list').html("<p>You aren't enrolled in any classes yet! Your professors assign you to classes based on your U of A email, so make sure that you signed up with your official U of A email address. It's also possible that you're checking in too soon, and classes have not been created.</p><p>If you think there's a mistake and you haven't been added to your class, you should contact your professor and they will look into it for you.</p>");
	}
	if (user == 1) {
	    $('#instr').html("<h2>Create A New Class</h2>");
	    $('#new').html('<a href="#" class="newClass">Create new class</a>');
	}
}

$("#new").on("click", ".newClass", function() {
	$("#new").html('<form action="/api/v2/groups" method="POST" enctype="multipart/form-data" id="groupForm"><p><label>Class name: </label><input type="text" name="groupName" required></p><p><label>Please input a comma separated list of student emails below. The students associated with these emails will be added to the class automatically once they have created an account.</label><br><br><textarea name="users" placeholder="student1@email.arizona.edu,student2@email.arizona.edu,student3@email.arizona.edu" form="groupForm" style="width: 95%; height: 100px;" required></textarea></p><p><input type="submit" value="Create Class"></p></form>');
});