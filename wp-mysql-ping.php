<?php
/*
Plugin Name: WordPress Database Ping
Description: WordPress Database Ping
Author: Nsp Code
Author URI: http://www.nsp-code.com
Version: 1.0.2
*/


if (!class_exists('wpdb2')) 
    {
        define('WPDBPING_PATH', ABSPATH.'wp-content/plugins/wordpress-database-ping');
        define('WPDBPING_URL', get_option('siteurl').'/wp-content/plugins/wordpress-database-ping');
        
        Class wpdb2 Extends wpdb 
            {

	            function _ping() 
                    {

		                $retry = 3;
		                $failed = 1;
                        
		                $ping = mysql_ping( $this->dbh ) ;
		                while( !$ping && $failed < $retry) 
                            {

			                    $this->dbh = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD, 1);
			                    $this->select(DB_NAME);

			                    if ( !DB_CHARSET && version_compare(mysql_get_server_info($this->dbh), '4.1.0', '>=')) 
                                    {
 				                        $this->query("SET NAMES '" . DB_CHARSET . "'");
 				                    }
                                    
			                    $ping = mysql_ping( $this->dbh ) ;
			                    if(!$ping ) 
                                    {
				                        sleep(2);
				                        $failed+=1;
				                    }
			                    }

		                if(!$ping ) 
                            {
			                    $this->print_error('Attempted to connect for ' . $retry	. ' but failed...');
			                }
		                }

	            function query($query) 
                    {
                        $this->_ping();
		                return parent::query($query);
		            }
	        }

	    $wpdb2 = new wpdb2(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
	    foreach(get_object_vars($wpdb) as $k=>$v) 
            {
		        if (is_scalar($v)) 
                    {
			            $wpdb2->$k = $v;
			        }
		    }
	    
        $wpdb =& $wpdb2;
        
        add_action('admin_print_styles', 'wpdbping_print_styles');
        function wpdbping_print_styles()
            {
                $myCssFile = WPDBPING_URL . '/css/plugin_styles.css';
                wp_register_style('WPdbpingSheets', $myCssFile);
                wp_enqueue_style( 'WPdbpingSheets'); 
            }
        
        add_action('admin_menu', 'wpdbping_plugin_menu'); 
        function wpdbping_plugin_menu() 
            {
                include (WPDBPING_PATH . '/include/options.php');
                include (WPDBPING_PATH . '/include/functions.php');
                add_options_page('WP DB Ping', 'WP DB Ping', 'manage_options', 'wpdbping-options', 'wpdbping_plugin_options');
            }
                                                                                                  
    }

?>