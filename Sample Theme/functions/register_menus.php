<?php 
$register_menus_options = get_option('register_menus_options');

if(!empty($register_menus_options['menu_id'][0]) AND !empty($register_menus_options['menu_name'][0]))
{
   
    add_action('init', 'register_my_menus');
    function register_my_menus() 
    {
        $register_menus_options = get_option('register_menus_options');

        
        if(!empty($register_menus_options['menu_id'][0]) AND !empty($register_menus_options['menu_name'][0]))
        {
            for($i=0;$i<count($register_menus_options['menu_id']);$i++)
            {
                if($register_menus_options['menu_id'][$i]!='' AND $register_menus_options['menu_name'][$i])
                {
                    $ar[] = array($register_menus_options['menu_id'][$i] => __($register_menus_options['menu_name'][$i]));
                }        
            }
            
            foreach($ar as $ars)
            {
                register_nav_menus($ars);
            }   
        }

    }
}


?>