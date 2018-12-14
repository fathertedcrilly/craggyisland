<?php
/*
Plugin Name: Craggy Island
Version: 1.0.1
Description: Adds classic Father Ted quotes and more to your admin dashboard.
Author: Father Ted Crilly (& Father Dougal Mcguire)
Author URI: https://github.com/fathertedcrilly
Text Domain: craggy-island
*/

if( !defined( 'ABSPATH' ) ) {
	exit;
}

if( !class_exists( 'CraggyIsland' ) ) {

	class CraggyIsland {

		public function __construct() {

			add_action( 'admin_notices', array( $this, 'display_quote' ) );
			add_action( 'admin_head', array( $this, 'display_quote_css' ) );
			add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widget' ) );

		}

		public function add_dashboard_widget() {

			// Adds dashboard widget

			wp_add_dashboard_widget(
				'dashboard_widget',
				__( 'Craggy Island Quote', 'craggy-island' ),
				array( $this, 'dashboard_widget_function' ) // Display function.
			);

		}

		public function display_quote() {

			// Header quote display

			$quote = $this->get_quotes( 'single' );

			if( !empty( $quote ) ) {
				echo '<p id="craggy-island-quote">' . $quote . '</p>';
			}

		}

		public function dashboard_widget_function() {

			// Dashboard widget quote display

			$quote = $this->get_quotes( 'single' );

			if( !empty( $quote ) ) {
				echo $quote;
			}

		}

		public function display_quote_css() {

			// CSS

			$float = is_rtl() ? 'left' : 'right';

			echo '
			<style type="text/css">
				#craggy-island-quote {
					float: ' . $float . ';
					padding-$x: 5px;
					padding-top: 8px;
					margin: 0;
					font-size: 11px;
					font-style: italic;
				}
			</style>
			';

		}

		public function get_quotes( $return_type ) {

			// Returns a single quote string or array of quotes depending on return type

			if( !empty( $return_type ) ) {

				$quotes = array(
					__( "That money was just resting in my account.", "craggy-island" ),
					__( "I love my brick.", "craggy-island" ),
					__( "That's mad, Ted.", "craggy-island" ),
					__( "Shoddy workmanship, that's what it is.", "craggy-island" ),
					__( "Feic, arse, drink, girls.", "craggy-island" ),
					__( "Which one do you prefer, Oasis or Blur?", "craggy-island" ),
					__( "You're going on my list, Tony.", "craggy-island" ),
					__( "Looks like rain, Ted.", "craggy-island" ),
					__( "Doesn't Mary have a lovely bottom? (Of course, they ALL have lovely bottoms.)", "craggy-island" ),
					__( "Go on, go on, go on, go on...", "craggy-island" ),
					__( "Down with that sort of thing.", "craggy-island" ),
					__( "These are small, but the ones out there are far away.", "craggy-island" ),
					__( "Is there anything to be said for another mass?", "craggy-island" ),
					__( "Who would he be like? Hitler or one of those mad fellas?", "craggy-island" ),
					__( "Cowboys ted, a bunch of cowboys.", "craggy-island" ),
					__( "That would be a ecumenical matter.", "craggy-island" ),
					__( "Spider-Baby- It's got the body of a spider, and the mind of a baby.", "craggy-island" ),
					__( "It's Ireland's largest lingerie section' I understand.", "craggy-island" ),
					__( "We're all going to heaven lads, wahey!!", "craggy-island" ),
				);

				if( $return_type == 'all' ) {

					return $quotes;

				} else {

					return wptexturize( $quotes[ mt_rand( 0, count( $quotes ) - 1 ) ] );

				}

			} else {

				return false;

			}

		}

	}

	new CraggyIsland();

}