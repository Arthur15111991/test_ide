<?php

if(!class_exists('BannersManage')) {
class BannersManage
{
    private function fn_delete_banner($wpdb, $banner_id)
    {
        $b_table = "dp24_banners";
        $ab_table = "dp24_apps_banners";
        $wpdb->delete($b_table, array('id' => $banner_id));
       return $wpdb->delete($ab_table, array('bannerId' => $banner_id));
    }

    public function page() 
    {
        //if (isset($_GET['noheader']))
            //require_once(ABSPATH . 'wp-admin/admin-header.php');
        global $wpdb;

        if (!empty($_GET['mode']) && $_GET['mode'] == 'delete') {
            self::fn_delete_banner($wpdb, $_GET['item_id']);
        }

        $b_table = "dp24_banners";?>
        <div class='wrap'>
            <h2><?php _e('Managing Banners', BANNER_DOMAIN); ?></h2>
        </div>

        <div class="clear"></div>
        <table class="widefat fixed" cellpadding="0">
            <thead>
                <tr>
                    <th id="t-idg" class="column-title" style="width:5%;"><?php _e('ID', BANNER_DOMAIN); ?></th>
                    <th id="t-name" class="column-title" style="width:31%;"><?php _e('Name', BANNER_DOMAIN);?></th>
                </tr>
            </thead>
            <body>
            <?php 
                $b_sql = "SELECT id, name FROM {$b_table} ORDER BY id";
                $banners = $wpdb->get_results($b_sql, ARRAY_A);
                foreach ($banners as $i => $banner) { ?>
                    <tr class="<?php echo (($i & 1) ? 'alternate' : ''); ?>">
                        <td class="post-title column-title"><?php echo $banner['id']; ?></td>
                        <td class="post-title column-title"><strong><a href="<?php echo admin_url('admin.php'); ?>?page=banner-edit&mode=edit&item_id=<?php echo $banner['id']; ?>"><?php echo $banner['name'];?></a></strong>
                            <span class="delete"><a href="<?php echo admin_url('admin.php'); ?>?page=app-banners&mode=delete&item_id=<?php echo $banner['id']; ?>"><?php _e('Remove', BANNER_DOMAIN);?></a></span>
                        </td>
                    </tr>
                <?php } ?>
            </body>
        </table>
        <?php
        }
    }
}

