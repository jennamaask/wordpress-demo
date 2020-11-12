<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php  wp_title('|', true, 'right'); ?></title>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
 <a href="#maincontent" class="skiplink">Go to Main Content</a>
 <?php wp_nav_menu( array(
        'theme_location' => 'primary',
        'container_class' => 'dropDownMenu'
      )); ?>
<header>
  <div class="main-nav">
    <div class="wrapper flex">
      <button class="menu-button">
        <span></span>
        <span></span>
        <span></span>
        <span class="visuallyhidden">Menu</span>
      </button>
      <?php wp_nav_menu( array(
        'theme_location' => 'primary',
        'container_class' => 'desktopMenu'
      )); ?>
    </div>
  </div> 
</header>

<main id="maincontent">
