<?php 
    $mode = $args['mode'];
    $banner_data = $args['banner_data'];
    $app_banner_data = $args['app_banner_data'];
    $item_id = $args['item_id']; ?>
    
    <div class="wrap">
        <h2><?php echo ( ( ($mode === 'banner_add')) ? __('New Banner', BANNER_DOMAIN) : __('Edit Banner', BANNER_DOMAIN) . ' (' . 'ID ' . $item_id . ')' ); ?></h2>
        <form method="post" action="">
            <input type="hidden" name="banner_data[id]" value="<?php if ($mode == 'edit') echo $banner_data['id'];?>" >
            <div id="post-body" style="width:450px; float:left;">
            <div id="banner-title">
                <p>
                    <label for="title"><?php _e('Name', BANNER_DOMAIN); ?></label>
                    <input id="title" type="text" style="width:100%;" size="30" name="banner_data[name]" value="<?php if ($mode == 'edit') echo $banner_data['name']; ?>">
                </p>
            </div>
            <div class="banner-comments">
                <p>
                    <label for="comments"><?php echo __('Comments', BANNER_DOMAIN).':'; ?></label>
                    <textarea id="comments" name="banner_data[comments]" style="width:100%; height: 80px;" ><?php if ($mode == 'edit')  echo $banner_data['comment']?></textarea>
                </p>
            </div>
            <div id="banner-image-name">
                <p>
                    <label for="image_name"><?php _e('image_name', BANNER_DOMAIN); ?></label>
                    <input id="image_name" style="width:100%;" type="text" size="30" name="banner_data[image_name]" value="<?php if ($mode == 'edit')  echo $banner_data['imageName']; ?>">
                </p>
            </div>
            <div id="banner-link">
            <p>
                <label for="link"><?php _e('link', BANNER_DOMAIN); ?></label>
                <input id="link" style="width:100%;" type="text" size="30" name="banner_data[link]" value="<?php if ($mode == 'edit')  echo $banner_data['link']; ?>">
            </p>
        </div>
        <button id="submit_button" class="color-btn color-btn-left" name="update_banner" type="submit">
            <?php _e('Save', BANNER_DOMAIN) ?>
        </button>
    </div>

    <div id="app_links" style="float:right; max-width:390px">
        <div class="container">
            <?php $available_platforms = AppBannersConfig::get_available_platforms();
                $available_applications = AppBannersConfig::get_available_apps();
                if ($mode == 'edit') foreach ($app_banner_data as $key => $value) { ?>
                    <div style="border: 1px solid green; margin:5px; padding: 10px; text-align: center;">
                    <input type="hidden" name="link_data[link_id][]" value="<?php echo $value['id']?>">
                    <select id="platform[]" name="link_data[platform][]">
                        <?php foreach($available_platforms as $platform) { ?>
                            <option <?php if ($value['platform'] == $platform) {?> selected <?php } ?> value="<?php echo $platform ?>"><?php echo $platform ?></option> <?php } ?>
                    </select>
                    <select id="app[]" name="link_data[app][]">
                        <?php foreach($available_applications as $applications) { ?>
                            <option <?php if ($value['app'] == $applications) {?> selected <?php } ?> value="<?php echo $applications ?>"><?php echo $applications ?></option> <?php } ?>
                    </select>

                    <input type="text" id="link[]" name="link_data[link][]" placeholder="link" value="<?php echo $value['link'];?>">
                    <input type="text" id="order_by[]" name="link_data[order_by][]" placeholder="order by" value="<?php echo $value['orderBy'];?>">						
                    <input class="is_hidden_active" type="hidden" name="link_data[is_active][]" id="is_active" value="N">
                    <input class="is_active" type="checkbox" name="link_data[is_active][]" id="is_active" value="Y" <?php checked(1, $value['isActive']); ?>>
                    <label for="is_active"><?php _e('status', BANNER_DOMAIN); ?></label>
                    <p>
                        <span class="delete"><a href="<?php echo admin_url('admin.php'); ?>?page=banner-edit&mode=edit&item_id=<?php echo $item_id; ?>&action=delete_link&link_id=<?php echo $value['id']; ?>"><?php _e('Remove link', BANNER_DOMAIN);?></a></span>
                    </p>
                </div>
                <?php } ?>

                <div id="link_data" style="border: 1px solid green; margin:5px; padding: 10px; text-align: center;">
                    <h2><?php _e('New app link', BANNER_DOMAIN); ?></h2>
                    <input type="hidden" value="" name="link_data[link_id][]" value="">
                    <select id="platform[]" name="link_data[platform][]">
                        <?php foreach($available_platforms as $platform) { ?>
                            <option value="<?php echo $platform ?>"><?php echo $platform ?></option> <?php } ?>
                    </select>
                    <select id="app[]" name="link_data[app][]">
                        <?php foreach($available_applications as $applications) { ?>
                            <option value="<?php echo $applications ?>"><?php echo $applications ?></option> <?php } ?>
                    </select>
                    <input type="text" id="link[]" name="link_data[link][]" value="" placeholder="link">
                    <input type="text" id="order_by[]" name="link_data[order_by][]" value="1" placeholder="order by">
                    <input class="is_hidden_active" type="hidden" name="link_data[is_active][]" id="is_active" value="N">
                    <input class="is_active" type="checkbox" name="link_data[is_active][]" id="is_active[]" value="Y">
                    <label for=""><?php _e('status', BANNER_DOMAIN); ?></label>
                </div>
            </div>

            <button type="button" id="clone_button"><?php _e('Add_link', BANNER_DOMAIN) ?></button>
        </div>
    </form>

    <script type="text/javascript">
    /* <![CDATA[ */
        jQuery(document).ready(function() {
            jQuery('#app_links').find('.is_active').each(function() {
                var _flag = jQuery(this).is(':checked');
                if (_flag) {
                    jQuery(this).prev().attr('disabled', true);
                }
            });
        });

        jQuery('#clone_button').click(function() {
            jQuery('#link_data').clone().appendTo('.container');
        });

        jQuery('.is_active').change(function() {
            var _flag = jQuery(this).is(':checked');
            var _hidden_status = jQuery(this).prev();
            if (_hidden_status.attr('class') != 'is_hidden_active') {
                console.log('Error : hidden_status element is not found');
                return;
            }
            if (_flag) {
                _hidden_status.attr('disabled', true);
            } else {
                _hidden_status.attr('disabled', false);
            }			
        });
    /* ]]> */
    </script>
</div>