<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1, initial-scale=1.0, user-scalable=no">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <?php
    global $cakes_opt;
    $favicon = $cakes_opt['general-favicon']['url'];
  ?>
  <!-- favicon -->
  <link rel="icon" href="<?php echo esc_url($favicon); ?>" type="image/png">

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="loader">
    <img src="<?php echo get_template_directory_uri(); ?>/img/loader.gif" alt="loader">
</div>
<header id="header" role="banner">
  <div class="container">

  <?php if($cakes_opt['social-header'] == 1): ?>
    <nav class="social" id="headerShareLinksHover">
      <a href="#" class="share-link"></a>
      <ul>
        <?php if ( !empty(esc_url($cakes_opt['s_facebook']))): ?>
          <li class="facebook" style="top:-65px;" data-top="-65px">
            <a href="<?php echo $s_facebook; ?>" target="_blank"></a>
          </li>
        <?php endif; ?>
        <?php if ( !empty(esc_url($cakes_opt['s_twitter']))): ?>
          <li class="twitter" style="top:-130px;" data-top="-130px">
            <a href="<?php echo esc_url($cakes_opt['s_twitter']); ?>/" target="_blank"></a>
          </li>
        <?php endif; ?>
        <?php if ( !empty(esc_url($cakes_opt['s_gplus']))): ?>
          <li class="google-plus" style="top:-195px;" data-top="-195px">
            <a href="<?php echo esc_url($cakes_opt['s_gplus']); ?>" target="_blank"></a>
          </li>
        <?php endif; ?>
        <?php if ( !empty(esc_url($cakes_opt['s_pinterset']))): ?>
          <li class="pinterest" style="top:-260px;" data-top="-260px">
            <a href="<?php echo esc_url($cakes_opt['s_pinterset']); ?>" target="_blank"></a>
          </li>
        <?php endif; ?>
        <?php if ( !empty(esc_url($cakes_opt['s_linkedin']))): ?>
          <li class="linkedin" style="top:-325px;" data-top="-325px">
            <a href="<?php echo esc_url($cakes_opt['s_linkedin']); ?>" target="_blank"></a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  <?php endif; ?>

    <a href="#" class="show-nav"></a>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo mobile">
      <span class="icon"></span>
      <h1><?php echo $cakes_opt['logo-top-title']; ?></h1>
      <strong><?php echo $cakes_opt['logo-bottom-title']; ?></strong>
    </a>
    <div class="hgroup">
      <a href="#" class="close-nav"></a>
      <nav class="main-nav">
        <div class="left">
          <?php wp_nav_menu( array( 'theme_location' => 'left' ) ); ?>
        </div>
        <div class="wrap-logo">
          <a href="/" class="logo" title="Invisio">
            <span class="icon"></span>
            <h1>Invisio</h1>
            <strong>cakes</strong>
          </a>
        </div>
        <div class="right">
          <?php wp_nav_menu( array( 'theme_location' => 'right' ) ); ?>
        </div>
      </nav>
      <div class="search">
        <a href="#" class="search-link"></a>
        <div class="search-form">
          <form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="text" placeholder="Keyword" id="s" name="s" class="field">
            <input type="submit" value="">
          </form>
        </div>
      </div>
    </div>
  </div>
</header>

