<html>
	<head>

		<style type="text/css">
		
		html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-weight: inherit;
	font-style: inherit;
	font-size: 100%;
	font-family: inherit;
	vertical-align: baseline;
}
/* remember to define focus styles! */
:focus {
	outline: 0;
}
body {
	line-height: 1;
	color: black;
	background: white;
}
ol, ul {
	list-style: none;
}
/* tables still need 'cellspacing="0"' in the markup */
table {
	border-collapse: separate;
	border-spacing: 0;
}
caption, th, td {
	text-align: left;
	font-weight: normal;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: "";
}
blockquote, q {
	quotes: "" "";
}
		
		
		

body {
	background-color: gray;
}

#content {
	width: 800px;
	margin-left:auto;
	margin-right:auto;
	

}

#title {
	font-family:helvetica;
	width:100%;
	text-align:center;
	color: #69f;
	font-size: 48px;
	font-weight:bold;
	padding:0px;
}

#subtitle {
	font-family:helvetica;
	width:100%;
	text-align:center;
	color: #FFF;
	font-size: 16px;
}

.search_box {
	float:left;
	width: 300px;
	margin:30px;
	
	padding:10px;
	
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	-o-border-radius: 10px;
}

.search_box input {
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-o-border-radius: 5px;
}

.search_box button {
	float:right;
}

#buy_box {
	background-color:#69F;
}

#sell_box {
	background-color:#69F;
}

		</style>

	</head>
<body>

<div id="content">
	<h1 id="title">ButlerBooks</h1><br />
	<h2 id="subtitle">Columbia textbook listings</h2><br />
	<div id="buy_box" class="search_box">	
		Buy<br>
		<form action="buy_search.php" method="GET">
			<input name="query" id="buy_input"  value="Title, Author, ISBN or Class" onclick="this.value=''" size=35 />
			<button>buy</button>
		</form>
	</div>


	<div id="sell_box" class="search_box"> 
		Sell<br>
		<form action="sell_search.php" method="GET">
			<input name="query" id="sell_input"  value="Title, Author, ISBN or Class" onclick="this.value=''" size="35" />
			<button>sell</button>
		</form>
	</div>

</div>	
</body>
</html>
