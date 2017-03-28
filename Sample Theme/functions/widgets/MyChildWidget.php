<?php
class MyChildWidget extends WP_Widget {

    function MyChildWidget() {
        // Instantiate the parent object
        parent::__construct(false, 'Child Post Widget', array('description' => __('The simple widget for display child post in Sidebar.', 'text_domain')));
    }

    function widget($args, $instance) 
    {
        $myqueried_object = get_queried_object(); 
        $cur_id = $myqueried_object->ID;
        $main_post_parent_id = $myqueried_object->post_parent;   
        $main_post_type = $myqueried_object->post_type;
        
        if($main_post_parent_id==0)
        {
            $main_post_id = $myqueried_object->ID;
            $main_post_name = get_the_title($main_post_id);
            $post_parent = $main_post_id;
        }
        else
        {
            $main_post_id = $myqueried_object->post_parent;
            $main_post_name = get_the_title($main_post_parent_id);
            $post_parent = $main_post_id;
        }
        
        $args = array(
            'post_parent' => $post_parent,
            'post_type'   => $main_post_type, 
            'posts_per_page' => -1
        );
        $mychildren_array = get_children( $args );
        
        if(!empty($mychildren_array))
        {
?>
        <ul id="childwidget">
            <?php 
                if($cur_id==$post_parent)
                {
                    $act2 = "active";
                }
                else
                {
                    $act2 = "";
                }
            ?>
            <li class="child_post_widget_parent <?php echo $act2; ?>"><a href="<?php echo get_permalink($post_parent); ?>"><?php echo $main_post_name; ?></a></li>
            <?php foreach($mychildren_array as $childre) { ?>
            <?php 
                $child_id = $childre->ID;
                $link = get_permalink($child_id);
                $title = $childre->post_title;
                if($cur_id==$child_id)
                {
                    $act = "active";
                }
                else
                {
                    $act = "";
                }
            ?>
            <li id="child_post_widget_child_<?php echo $child_id; ?>" class="child_post_widget_child <?php echo $act; ?>"><a href="<?php echo $link ?>"><?php echo $title; ?></a></li>
            <?php } ?>
        </ul>

<?php  
        }
        
    }

}

function mytheme_register_child_widgets() {
    register_widget('MyChildWidget');
}

add_action('widgets_init', 'mytheme_register_child_widgets');
?>