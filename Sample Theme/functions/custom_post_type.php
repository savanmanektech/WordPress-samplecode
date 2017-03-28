<?php
add_action( 'init', 'create_post_type' );

function create_post_type()
{	
    include 'custom_post_type/slider/slider.php';   
    include 'custom_post_type/news/news.php';   
    include 'custom_post_type/project/project.php';   
    include 'custom_post_type/people/people.php';   
    include 'custom_post_type/studio/studio.php';   
    include 'custom_post_type/culture/culture.php';   
    include 'custom_post_type/profile/profile.php';   
    include 'custom_post_type/thought/thought.php';   
    include 'custom_post_type/symposiumseries/symposiumseries.php';   
    include 'custom_post_type/newsletter/newsletter.php';   
}
?>