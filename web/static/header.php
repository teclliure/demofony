<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<title>Eivissa</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/icons.css.php" />
		<link rel="stylesheet" type="text/css" href="fonts/stylesheet.css" />
		<link rel="stylesheet" type="text/css" href="js/plugins/jquery-ui/css/overcast/jquery-ui-1.8.11.custom.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="css/ie.css" />
		<![endif]-->
		<link rel="shortcut icon" href="favicon.ico"/>
	</head>
	<body id="<?=$pageId?>" class="<?=$pageClass?>">

		<div id="container">
			<div id="top" class="misc misc-top-bar">
				<ul class="tools">
					<li class="social">
						<a href="#" class="misc misc-fb"></a>
						<a href="#" class="misc misc-tw"></a>
					</li>
					<li class="user">
						<a href="#">Crear cuenta</a><span>|</span><a href="#" class="login"><span class="misc misc-lock inline"></span>Entrar</a>
					</li>
					<li class="language">
						<select>
							<option>Catala</option>
							<option>Castellano</option>
						</select>
					</li>
					<!--<div class="accesibility line">
						<a href="#" class="a">a-</a><a href="#" class="aa">a+</a>
					</div>-->
				</ul>
			</div>
			<div id="header" class="misc misc-header-bar">
				<a href="index.php" class="logo misc misc-logo"></a>
				<ul>
					<li class="link">
						<a href="#">L'Ultim</a>
					</li>
					<li class="link">
						<a href="#">El mes visto</a>
					</li>
					<li class="filter">
						<select>
							<option>Per barri:</option>
						</select>
						<select>
							<option>Per categoria:</option>
						</select>
					</li>
					<li class="search">
						<form action="#" class="misc misc-search">
							<input name="q" />
						</form>
					</li>
				</ul>
			</div>
			<div id="main">
				<div class="main-inner">