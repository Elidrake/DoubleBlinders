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
			
			<p>If you haven't already, <a href="/upload">upload</a> your latest coding assignment.</p>
			
			<p>Once you've done that, other students can start leaving you comments. You can check the <a href="/comments">comments page</a> to see if any students have left you comments already.</p>
			
			<p>Once other students have uploaded their own code, you can check your <a href="/review">review page</a> to see if there is any code from other students that you have been assigned to review and comment on.</p>
			
			<h2>Reviewing another student's code</h2>
			
			<p>Commenting on another student's code is easy! Just tap or click within the code where you want to leave your comment and a new comment will be generated at that position. Tap or click on "Insert comment here", then type our your comment. When you're finished, just hit "Save Comment" and the comment will be anonymously sent. When the student who's code you commented on goes to their Comments page, they'll see your comment (although because all comments are anonymous, they won't know it was you who left it) in their code right where you inserted it!</p>
			
			<p>Feel free to test out the comment insertion system in the sample code below. When you're ready, check your <a href="/review">Review page</a> to see if you have been assigned any code to comment on yet.</p>
			
			<pre><code>
				<div id="code">#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;stdlib.h&gt;

int main (void){
    char* hi = "Hello, world!";
    
    int i;
    for (i = 0; i < 5; i++) {
        printf("%d: %s\n", i+1, hi);
    }
    
    for (i = 4; i > 0; i--) {
        printf("%d: %s\n", i, hi);
    }
}
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