<?php

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


function wpse_131562_redirect() {
  if (
      ! is_user_logged_in()
      && (is_woocommerce() || is_cart() || is_checkout())
  ) {
      // feel free to customize the following line to suit your needs
      wp_redirect(home_url());
      exit;
  }
}
add_action('template_redirect', 'wpse_131562_redirect');

// function prefix_add_discount_line_two( $cart ) {

//   $discount = $cart->subtotal * 0.1;

//   $cart->add_fee( __( 'Down Payment', 'yourtext-domain' ) , -$discount );

// }
// add_action( 'woocommerce_cart_calculate_fees', 'prefix_add_discount_line_two' );


// function action_woocommerce_thankyou( $order_get_id ) { 

// }; 
       
// // add the action 
// add_action( 'woocommerce_thankyou', 'action_woocommerce_thankyou', 10, 1 ); 





// add_action( 'woocommerce_payment_complete', 'action_payment_complete' );
// function action_payment_complete( $order_id) {
//     echo '<pre>';
//     print_r($order);
//     echo '</pre>';

//     wp_die('mato');
// }


// 

$form= '<form action="/checkout" method="POST">
    <input type="hidden" name="apply_points" value="yes">
    <input type="hidden" name="number_of_points" value="<?php echo $number_of_points ?>">

    <p>You have <span><?php echo $number_of_points ?> points</span>!! Do you want to apply your points?</p>

    <label for="points_to_use">Points to Use</label>
    <input type="number" id="points_to_use" name="points_to_use">

    <input type="submit" value="Apply Points" >
  </form>';




add_action('woocommerce_cart_totals_after_order_total', 'fu_woocommerce_cart_totals_before_order_total');
function fu_woocommerce_cart_totals_before_order_total(){
  
  $number_of_points = 20;

  print_r($_POST);
  ?>
  <form action="" method="POST">
    <input type="hidden" name="apply_points" value="yes">
    <input type="hidden" name="number_of_points" value="<?php echo $number_of_points ?>">

    <p>You have <span><?php echo $number_of_points ?> points</span>!! Do you want to apply your points?</p>

    <label for="points_to_use">Points to Use</label>
    <input type="number" id="points_to_use" name="points_to_use">

    <input type="submit" value="Apply Points" >
  </form>
<?php
}


function prefix_add_discount_line( $cart ) {

  $get_the_points = 20;
  $points_to_use  = WC()->session->get('points_to_use');
  $apply_points = WC()->session->get('apply_points');
  
  if(!isset( $apply_points ) || $apply_points  !== 'yes' ) return;

  if(!isset( $points_to_use ) || !is_numeric($points_to_use) || empty($points_to_use)) return;

  if($get_the_points < intval($points_to_use)) return;
  

  $discount = $points_to_use * 500;
  $cart->add_fee( 'Down Payment' , -$discount );

}
add_action( 'woocommerce_cart_calculate_fees', 'prefix_add_discount_line', 20, 1 );


add_action( 'template_redirect', 'getfee_to_wc_session', 30 );
function getfee_to_wc_session() {
    if ( isset($_POST['points_to_use']) ) {
        WC()->session->set('points_to_use', esc_attr($_POST['points_to_use']));
    }
    
    if ( isset($_POST['apply_points']) ) {
        WC()->session->set('apply_points', esc_attr($_POST['apply_points']));
    }
}

function printr($value){
  echo '<pre>';
  print_r($value);
  echo '</pre>';
}



// add_action('wp_loaded',  'myfunction'); 
// //if not in class ('wp_loaded', 'myfunction')

// function myfunction(){

//  $cart = WC()->cart->get_cart();
//  printr($cart);
// }

