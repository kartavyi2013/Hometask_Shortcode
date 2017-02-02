<?php
/**
 * Plugin Name:Hometask_Shortcode
 * Plugin URI: 
 * Description: Add googlemaps to content
 * Version: 1.0.0
 * Author: BabychRoman
 * License: GPL2
 */

add_shortcode( 'map', 'mgms_map' );
function mgms_map( $args ) {
	$args = shortcode_atts( array(
		'lat'    => '44.6000',
		'lng'    => '-110.5000',
		'zoom'   => '8',
		'height' => '300px'
	), $args, 'map' );


	$id = substr( sha1( "Google Map" . time() ), rand( 2, 10 ), rand( 5, 8 ) );
	ob_start();
	?>
	<div class='map' style='height:<?php echo $args['height'] ?>; margin-bottom: 1.6842em' id='map-<?php echo $id ?>'></div> 

	<script type='text/javascript'>
	var map;
	function initMap() {
	  map = new google.maps.Map(document.getElementById('map-<?php echo $id ?>'), {
	    center: {lat: <?php echo $args['lat'] ?>, lng: <?php echo $args['lng'] ?>},
	    zoom: <?php echo $args['zoom'] ?>
	  });
	}
	</script>

	<?php
	$output = ob_get_clean();
	return $output;
}


add_action( 'admin_enqueue_scripts', 'mgms_enqueue_assets' );
function mgms_enqueue_assets() {
	wp_enqueue_script( 
	  'google-maps', 
	  '//maps.googleapis.com/maps/api/js?key=AIzaSyBXctG_Vi99XjBqKc1oOWEXNPtaFoQo2hs&callback=initMap', 
	  array(), 
	  '1.0', 
	  true 
	);
}
