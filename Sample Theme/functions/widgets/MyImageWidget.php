<?php
class MyImageWidget extends WP_Widget {

    function MyImageWidget() {
        // Instantiate the parent object
        parent::__construct(false, 'Image Widget', array('description' => __('The Simple Widget For Display Image in Sidebar.', 'text_domain')));
    }

    function widget($args, $instance) 
    {
        // Widget output

        $myimage_id = apply_filters('widget_title', $instance['mywidimage_id']);
        $imgheight = apply_filters('widget_title', $instance['mywidimage_height']);
        $imgwidt = apply_filters('widget_title', $instance['mywidimage_width']);

        echo wp_get_attachment_image($myimage_id, array($imgheight, $imgwidt));
    }

    function update($new_instance, $old_instance) {
        // Save widget options

        $instance = array();
        $instance['mywidimage_id'] = (!empty($new_instance['mywidimage_id']) ) ? strip_tags($new_instance['mywidimage_id']) : '';

        $instance['mywidimage_height'] = (!empty($new_instance['mywidimage_height']) ) ? strip_tags($new_instance['mywidimage_height']) : '';

        $instance['mywidimage_width'] = (!empty($new_instance['mywidimage_width']) ) ? strip_tags($new_instance['mywidimage_width']) : '';

        return $instance;
    }

    function form($instance) {
        // Output admin widget options form

        if (isset($instance['mywidimage_id'])) {
            $title = $instance['mywidimage_id'];
        } else {
            $title = __('Image ID', 'text_domain');
        }



        if (isset($instance['mywidimage_height'])) {
            $myimaheight = $instance['mywidimage_height'];
        } else {
            $myimaheight = __('Image Height', 'text_domain');
        }



        if (isset($instance['mywidimage_width'])) {
            $myimawidth = $instance['mywidimage_width'];
        } else {
            $myimawidth = __('Image Width', 'text_domain');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('mywidimage_id'); ?>"><?php _e('Image Id:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('mywidimage_id'); ?>" name="<?php echo $this->get_field_name('mywidimage_id'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('mywidimage_height'); ?>"><?php _e('Image Height:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('mywidimage_height'); ?>" name="<?php echo $this->get_field_name('mywidimage_height'); ?>" type="text" value="<?php echo esc_attr($myimaheight); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('mywidimage_width'); ?>"><?php _e('Image Width:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('mywidimage_width'); ?>" name="<?php echo $this->get_field_name('mywidimage_width'); ?>" type="text" value="<?php echo esc_attr($myimawidth); ?>" />
        </p>
        <?php
    }

}

function myplugin_register_widgets() {
    register_widget('MyImageWidget');
}

add_action('widgets_init', 'myplugin_register_widgets');
?>