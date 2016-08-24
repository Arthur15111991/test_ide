<?php
/*
Plugin Name: Application banners
Description: Allows you to create, edit custom banners for user application.
Version: 0.0.1
Author: Arthur Chernyshev
Author URI: https://vk.com/id28808075/
*/

include_once('config.class.php');
if (!class_exists('AppBanners' && class_exists('AppBanners'))) {

    class AppBanners extends AppBannersConfig
    {
        function __construct()
        {
            parent::__construct();
            add_action('admin_menu', array(&$this, 'fn_reg_admin_page'));
			add_action('init', array(&$this, 'fn_do_output_buffer'));
        }
		
		public function fn_do_output_buffer() {
			ob_start();
		}
		
        public function fn_reg_admin_page() 
        {
            $menu_page = add_menu_page(__('App Banners', BANNER_DOMAIN), __('App Banners', BANNER_DOMAIN), BANNER_ACCESS, 'app-banners', array(&$this, 'fn_manage_banners'));
            add_submenu_page('app-banners', __('Manage banners', BANNER_DOMAIN), __('Manage banners', BANNER_DOMAIN), BANNER_ACCESS, 'app-banners', array(&$this, 'fn_manage_banners'));
            add_submenu_page('app-banners', __('Banners editor', BANNER_DOMAIN), __('Banners editor', BANNER_DOMAIN), BANNER_ACCESS, 'banner-edit', array(&$this, 'fn_add_new_banner'));
            add_submenu_page('app-banners', __('App config', BANNER_DOMAIN), __('App config', BANNER_DOMAIN), BANNER_ACCESS, 'app-config', array(&$this, 'fn_manage_apps'));
        }

        public function fn_manage_banners() 
        {
            include_once('list.admin.class.php');
            $list = new BannersManage();
            $list->page();
        }

        public function fn_add_new_banner()
        {
            include_once('editor.admin.class.php');
            $list = new BannersEdit();
            $list->page();
        }

        public function fn_manage_apps()
        {
            include_once('app.config.admin.class.php');
            $list = new AppConfigManage();
            $list->page();
        }
    }
}

$custom_banners_options = new AppBanners();