<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
 		<meta name="viewport" content="width=550px">
		<meta name="viewport" content="initial-scale=1.0">
		<title>University of Arizona Code Review</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<header>
				<h1><a href="/">University of Arizona &lt;&nbsp;Code&nbsp;Review&nbsp;/></a></h1>
		</header>
		<nav>
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="/review">Review</a></li>	
				<li><a href="/comments">Comments</a></li>
				<li><a href="/upload">Upload</a></li>
				<li><a href="/account/logout">Logout</a></li>
			</ul>
		</nav>
		</nav>
		<section>		
			<form action="/api/v1/files" method="POST" enctype="multipart/form-data">			
				<input type="file" name="file" id="file">
				<p>
				<input type="submit" value="Send">
				</p>
			</form>
		</section>
		<footer>
			<p>By Alex Guyot, John Oney, Dakota Trotter, and Carson Stelzer.</p>
		</footer>
	</body>
</html>