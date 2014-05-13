<!DOCTYPE html>
<!--[if IE 8]>         <html class="lt-ie10 lt-ie9 ie8"> <![endif]-->
<!--[if IE 9]>         <html class="lt-ie10 ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php Sparky::title() ?></title>
	<meta name="description" content="<?php Sparky::description() ?>">
	<meta name="viewport" content="width=device-width">
	
	<?php wp_head(); ?>
	
	<!--
	<link rel="icon" type="image/png" href="<?= img('assets/favicon_64.png') ?>" />
	<link rel="apple-touch-icon" type="image/png" href="<?= img('assets/favicon_57.png') ?>" />
	<link rel="apple-touch-icon" type="image/png" href="<?= img('assets/favicon_114.png') ?>" sizes="114x114" />
	<link rel="apple-touch-icon" type="image/png" href="<?= img('assets/favicon_72.png') ?>" sizes="72x72" />
	<link rel="apple-touch-icon" type="image/png" href="<?= img('assets/favicon_144.png') ?>" sizes="144x144" />
	<link rel="shortcut icon" href="<?= img('assets/favicon.ico') ?>">
	-->
	
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Adamina' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
	<?php Assets::css() ?>
	<link href='/wp-content/themes/sparky/css/responsiveslides.css' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

	
</head>
<body <?php body_class() ?> >
	
	
	<header id="header">
		<div class="overlay">
			<div class="container">
				<hgroup>
					<h1><?php //echo get_bloginfo('name') ?>jamesquinn<span class="orange">.</span><span class="light-blue">ie</span></h1>
				</hgroup>
			</div>
		</div>
	</header>

	<nav id="nav-bar">
		<div class="container primary-navigation">
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Our work</a></li>
				<li><a href="#">Contact us</a></li>
			</ul>
		</div>
	</nav>
	
	<div id="page-body">
		<div class="container">
			<div class="layout-body">
				<div class="layout-content" role="main">
					<?= $this->content ?>
				</div>
			</div>
		</div>
	</div>
	
	<footer id="footer">
		<div class="container">
			Copyright &copy; <?= date('Y') ?>. All rights reserved.
		</div>
	</footer>
	
	<?php Assets::js() ?>

  <!-- SlidesJS Required: Link to jquery.slides.js -->
  <script src="/wp-content/themes/sparky/js/responsiveslides.min.js"></script>
  <script src="/wp-content/themes/sparky/js/jquery.backstretch.min.js"></script>
  <!-- End SlidesJS Required -->

  <!-- SlidesJS Required: Initialize SlidesJS with a jQuery doc ready -->
  <script>
    // Slideshow 4
      $("#slider4").responsiveSlides({
        auto: false,
        pager: false,
        nav: true,
        speed: 500
      });
  </script>
  <!-- End SlidesJS Required -->
	
</body>
</html>
