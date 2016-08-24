<?php

if (!class_exists('AppBannersConfig')) {
    class AppBannersConfig
    {       
        public function __construct()
        {
            define('BANNER_DOMAIN', 'user-banners');
            $access = 'manage_options';
            define('BANNER_ACCESS', $access);
			define('BANNERS__PLUGIN_DIR', plugin_dir_path( __FILE__ ));			
        }
        
        public static function get_available_platforms()
        {
            $available_platforms = array(
                'android',
                'ios',
                'windowsphone',
                'amazon'
            );
            return $available_platforms;
        }
        
        public static function get_available_apps()
        {
            $available_apps = array(
                'drumpads24',
                'dubstepdrumpads24',
                'electrodrumpads24',
                'hiphopdrumpads24',
                'trapdrumpads24'
            );
            return $available_apps;
        }
    }
}