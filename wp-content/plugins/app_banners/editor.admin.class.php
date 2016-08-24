<?php

include_once('viewer.class.php');

if(!class_exists('BannersEdit')) {    

    class BannersEdit
    {      
        private function fn_update_banner_data($wpdb, $banner_data, $banner_id = 0, $app_banner_data = array(), $is_update = false)
        {
            $banner_id = (!empty($banner_id)) ? intval($banner_id) : 0;
            $is_update = boolval($is_update);
            
            if (empty($banner_data['name'])) {
                return false;
            }
            
            $b_table = "dp24_banners";
            $ab_table = "dp24_apps_banners";
            $post_data = array(
                'name' => stripslashes($banner_data['name']),
                'imageName' => stripslashes($banner_data['image_name']),
                'link' => stripslashes($banner_data['link']),
                'comment' => stripslashes($banner_data['comments'])
            );
            $format_row = array( '%s', '%s', '%s', '%s');
            if ($is_update) {
                $wpdb->update($b_table, $post_data, array('id' => $banner_id), $format_row);	
            } else {
                $wpdb->insert($b_table, $post_data, $format_row);
                $banner_id = $wpdb->insert_id;
            }

            for ($i = 0; $i < count($app_banner_data['link_id']); $i++) {
                if (empty($app_banner_data['link'][$i]) || empty(intval($app_banner_data['order_by'][$i]))) {
                    continue;
                }
                $insert_rows = array (
                    'bannerId' => $banner_id,
                    'app' => $app_banner_data['app'][$i],
                    'platform' => $app_banner_data['platform'][$i],
                    'link' => stripslashes($app_banner_data['link'][$i]),
                    'orderBy' => $app_banner_data['order_by'][$i],
                    'isActive' => ($app_banner_data['is_active'][$i] == 'N' || empty($app_banner_data['is_active'][$i])) ? false : true,
                );
                $format_row = array( '%d', '%s', '%s', '%s', '%d', '%d');
                if (!empty($app_banner_data['link_id'][$i])) {
                    $wpdb->update($ab_table, $insert_rows, array('id' => $app_banner_data['link_id'][$i] ), $format_row);
                } else {
                    $wpdb->insert($ab_table, $insert_rows, $format_row);	
                }
            }
            return $banner_id;
        }

        private function fn_get_banner_data($wpdb, $banner_id)
        {
            $b_table = "dp24_banners";
            $ab_table = "dp24_apps_banners";
            $banner_data = $wpdb->get_row("SELECT * FROM {$b_table} WHERE id = " . intval($banner_id), ARRAY_A);
            return $banner_data;
        }

        private function fn_get_app_banner_data($wpdb, $banner_id)
        {
            $ab_table = "dp24_apps_banners";
            $app_banner_data = $wpdb->get_results("SELECT * FROM {$ab_table} WHERE bannerId = " . intval($banner_id) . " ORDER BY orderBy", ARRAY_A);
            return $app_banner_data;
        }

        private function fn_delete_app_banner_link($wpdb, $link_id)
        {
            $ab_table = "dp24_apps_banners";
            return $wpdb->delete($ab_table, array('id' => $link_id));
        }

        public function page()
        {            
            global $wpdb;
            $b_table = "dp24_banners";
            $ab_table = "dp24_apps_banners";

            if (isset($_GET['mode'])) {
                $mode = $_GET['mode'];
            } else {
                $mode = 'banner_add';		
            }

            if (isset($_GET['action'])) {
                $action = $_GET['action'];
            }

            if (isset($_GET['item_id'])) {
                $item_id = $_GET['item_id'];
            } else {
                $item_id = 0;
            }

            if(isset($_POST['update_banner'])) {
                $is_update = (!empty($_POST['banner_data']['id'])) ? true : false;
                $banner_id = self::fn_update_banner_data($wpdb, $_POST['banner_data'], $_POST['banner_data']['id'], $_POST['link_data'], $is_update);
                if (!self::fn_update_banner_data($wpdb, $_POST['banner_data'], $_POST['banner_data']['id'], $_POST['link_data'], $is_update)) {
                    echo "Error, banner name is empty";
                }
                wp_redirect(admin_url("admin.php?page=banner-edit&mode=edit&item_id=$banner_id"));
                exit;
            }

            if (isset($action) && $action == 'delete_link') {
                self::fn_delete_app_banner_link($wpdb, $_GET['link_id']);
            }


            if ($mode == 'edit') {
                $banner_data = self::fn_get_banner_data($wpdb, $item_id);
                $app_banner_data = self::fn_get_app_banner_data($wpdb, $item_id);
            } else {
                $banner_data = array();
                $app_banner_data = array();
            }
            Viewer::view( 'edit', serialize(array('mode' => $mode, 'item_id' => $item_id, 'banner_data' => $banner_data, 'app_banner_data' => $app_banner_data)));
        }
    }
}

