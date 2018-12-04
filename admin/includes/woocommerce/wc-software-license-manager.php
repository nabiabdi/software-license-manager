<?php

// Description:   Seamless integration between Woocommerce and Software License Manager(adopted from EDD Software License Manager -thanks to flowdee <coder@flowdee.de>)
// Author:          Omid Shamlu
// Author URI:      http://wp-master.ir


if (!class_exists('WOO_SLM')) {
	class WOO_SLM {
		private static $instance;
		public static function instance() {
			if (!self::$instance) {
				self::$instance = new WOO_SLM();
				self::$instance->setup_constants();
				self::$instance->includes();
			}
			return self::$instance;
		}
		private function setup_constants() {
			// Plugin version
			define('WOO_SLM_VER', '2.2.0');
			// get api settinsg from options table
			define('WOO_SLM_API_URL', 	   get_site_url().'/');
			define('WOO_SLM_API_SECRET',   SLM_Helper_Class::slm_get_option('lic_creation_secret'));
			define('KEY_API',  			   SLM_Helper_Class::slm_get_option('lic_creation_secret'));
			define('KEY_API_PREFIX',  	   SLM_Helper_Class::slm_get_option('lic_prefix'));
		}
		private function includes() {
			// log files and scripts
			require_once SLM_ADMIN_ADDONS . 'woocommerce/includes/helper.php';

			// purchases and emails
			require_once SLM_ADMIN_ADDONS . 'woocommerce/includes/emails.php';
			require_once SLM_ADMIN_ADDONS . 'woocommerce/includes/purchase.php';
		}
	}
	return WOO_SLM::instance();
}