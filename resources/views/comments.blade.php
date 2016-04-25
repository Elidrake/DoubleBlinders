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
			<h2>Your Code</h2>
			<div id="intro">
			<p>Below are the coding assignments that you have uploaded. Choose one from the list to see any comments that have been left on it by other students who have reviewed it.</p>
			</div>
			<div id="upload-list"></div>
			<pre><code>
				<div id="code"></div>
			</code></pre>
		</section>
		<script src="/scripts/jquery-1.10.2.js"></script>
		<script src="/scripts/comments.js"></script>
		<script src="/scripts/loadComments.js"></script>
		<footer>
			<p>By Alex Guyot, John Oney, Dakota Trotter, and Carson Stelzer.</p>
		</footer>
	</body>
</html>