<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left"><a href="<?php echo site_url() ?>"><strong>Fictional</strong> University</a></h1>
      <a href="<?php echo esc_url(site_url('/search')); ?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul>
            <li <?php if (is_page('about-us') or wp_get_post_parent_id(0) == 16) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/about-us') ?>">About Us</a></li>
            <li <?php if (get_post_type() == 'program') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('program') ?>">Programs</a></li>
            <li <?php if (get_post_type() == 'event' OR is_page('past-events')) echo 'class="current-menu-item"';  ?>><a href="<?php echo get_post_type_archive_link('event'); ?>">Events</a></li>
            <li <?php if (get_post_type() == 'campus') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('campus'); ?>">Campuses</a></li>
            <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/blog'); ?>">Blog</a></li>
            <li class="current-menu-item" style="display:flex; flex-direction: column; align-items: center;" id="get_cart" >
              <a href="#">Your cart</a>
              <div id="mini-cart" style="height: 300px; width:300px; background-color: white; display:none; ">
                <h2>Tu carrito</h2>
                <?php
                  $items = WC()->cart->get_cart();
                  foreach($items as $item => $values) { 
                    $_product =  wc_get_product( $values['data']->get_id()); 
                    echo "<b>".$_product->get_title().'</b>  <br> Quantity: '.$values['quantity'].'<br>'; 
                    $price = get_post_meta($values['product_id'] , '_price', true);
                    echo "  Price: ".$price."<br>";
                  } 
                ?>
              </div>
            </li>
            
          </ul>
        </nav>
        <div class="site-header__util">
          <?php if(is_user_logged_in()) { ?>
            <a href="<?php echo esc_url(site_url('/my-notes')); ?>" class="btn btn--small btn--orange float-left push-right">My Notes</a>
            <a href="<?php echo wp_logout_url();  ?>" class="btn btn--small  btn--dark-orange float-left btn--with-photo">
            <span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60); ?></span>
            <span class="btn__text">Log Out</span>
            </a>
            <?php } else { ?>
              <a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
              <a href="<?php echo wp_registration_url(); ?>" class="btn btn--small  btn--dark-orange float-left">Sign Up</a>
             <?php } ?>
          
          <a href="<?php echo esc_url(site_url('/search')); ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </header>

  <script>
    const cartButton = document.getElementById('get_cart');
    const miniCart = document.getElementById('mini-cart');
    if(cartButton){
      cartButton.addEventListener('click', function(e){
        e.preventDefault();
        if(miniCart.classList.contains('active-js')){
          
          miniCart.style.display = 'none';
          miniCart.classList.remove('active-js');
        }else{
          miniCart.style.display = 'block';
          miniCart.classList.add('active-js');
        }
      })
    }
  </script>
