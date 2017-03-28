<?php 
add_action('admin_menu', 'site_options_menu', 999);
function site_options_menu() {
    
    $ters = $GLOBALS['all_main_pages'];       
    add_menu_page($ters[0]['menu_name'], $ters[0]['menu_name'], 'administrator', $ters[0]['page_slug'], $ters[0]['page_slug'], 'dashicons-welcome-widgets-menus');    
    foreach($ters as $site_option) 
    {
        if($site_option['menu_name']!=$ters[0]['menu_name'] AND $site_option['is_procted']!='yes')
        {
            add_submenu_page( $ters[0]['page_slug'], $site_option['menu_name'], $site_option['menu_name'], 'administrator', $site_option['page_slug'], $site_option['page_slug'] );
        }
        elseif($site_option['menu_name']!=$ters[0]['menu_name'] AND $site_option['is_procted']=='yes' AND (get_option('developermode')=='enable' OR $_GET['developermode']=='enable'))
        {
            add_submenu_page( $ters[0]['page_slug'], $site_option['menu_name'], $site_option['menu_name'], 'administrator', $site_option['page_slug'], $site_option['page_slug'] );
        }        
    }
 
}

foreach($all_main_pages as $site_option) 
{
    
    /*Create page*/
    if($site_option['create_page']=="yes")
    {
        $my_page_slug = $site_option['page_slug'];
        $file = TEMPLATEPATH."/functions/theme_option_page/".$site_option['php_page_name'];
        if(!file_exists($file))
        {
            $txt = "<?php
add_action( 'admin_init', '".$my_page_slug."_settings' );
function ".$my_page_slug."_settings() 
{ 
    register_setting( 'my-own-theme-options-for-".$my_page_slug."', 'text_field' );
    register_setting( 'my-own-theme-options-for-".$my_page_slug."', 'image_field' );
        

}
function ".$my_page_slug."() {
?>

<div class='wrap'>
    <h2>".$site_option['menu_name']."</h2>
    <?php settings_errors(); ?> 
    <form method='post' action='options.php'>
        <?php settings_fields( 'my-own-theme-options-for-".$my_page_slug."' ); ?>
        <?php do_settings_sections( 'my-own-theme-options-for-".$my_page_slug."' ); ?>
        <?php include('bootstrap_theme_includes.php'); ?>
        <br />
        <div class='row'>
            
            <div class='col-md-8'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>".$site_option['menu_name']."</h3>
                    </div>
                    <div class='panel-body'>
                        
                        <label for='text_field'>Text Field</label>
                        <input id='text_field' type='text' name='text_field' value='<?php echo get_option('text_field'); ?>' class='form-control' />
                        
                        <br />

                        <label style='width: 100%;' for='image_field'>Image Field</label>
                        <?php echo my_image_uploader('image_field', 'Upload Image'); ?>
                        
                    </div>
                </div>
            </div>
            
            <?php include 'option_page_sidebar.php'; ?>
            
        </div>
   
        <?php submit_button(); ?>
        
    </form>
</div>
<?php } 
/*My Theme Option*/
?>
";
            
            $myfile = fopen($file, "w");
            fwrite($myfile, $txt);
        }
    }
    /*end of Create page*/
    
    /*include all pages*/
    if($site_option['is_procted']!='yes')
    {
        include $site_option['php_page_name'];
    }
    elseif($site_option['is_procted']=='yes' AND (get_option('developermode')=='enable' OR $_GET['developermode']=='enable'))
    {
        include $site_option['php_page_name'];
    }
    /*end of include all pages*/
}


/*Remove admin menu page*/
function remove_my_own_menu()
{
    $avlpage = get_option('admin_menu_options_page');
    //delete_option('admin_menu_options_page');
    
    if(!empty($avlpage))
    {
        for($i=0;$i<count($avlpage);$i++)
        {
            if($avlpage[$i]['menu_type']=='main_menu' AND $avlpage[$i]['menu_slug']!='')
            {
                remove_menu_page($avlpage[$i]['menu_slug']);
            }
            elseif($avlpage[$i]['menu_type']=='sub_menu' AND $avlpage[$i]['menu_slug']!='' AND $avlpage[$i]['parent_menu_slug']!='') 
            {
                remove_submenu_page($avlpage[$i]['parent_menu_slug'], $avlpage[$i]['menu_slug']);
            }
        }
    }          
}
add_action( 'admin_menu', 'remove_my_own_menu', 999 );
/*end of Remove admin menu page*/

/*Image Upload function*/
function my_image_uploader($name, $button_label)
{
    if($button_label=='')
    {
        $button_label = 'Upload';
    }
    $retur = '';
    
    $retur ='<input type="hidden" id="'.$name.'" name="'.$name.'" value="'.get_option($name).'" />';
    
    $retur.='<input type="button" style="height: 33px; line-height: 32px;" id="'.$name.'_button" name="'.$name.'_button" value="'.$button_label.'" class="button button-primary button-large" />';
    
    if(get_option($name)!='') 
    {
        $retur.=' <a class="viewimg" href="'.get_option($name).'" target="_new">
        <img src="'.get_option($name).'" style="width:50px; height:auto; margin-left:10px;" />
    </a> ';
    }
    
    
    
    $retur.= " <script type='text/javascript'>
        jQuery(document).ready(function() {
            var uploadID;
            jQuery('#".$name."_button').click(function() {
                formfield = jQuery('#".$name."_button').attr('name');
                uploadID = jQuery(this).prev('input');
                //alert(uploadID.attr('id'));
                tb_show('".$button_label."', 'media-upload.php?type=image&amp;TB_iframe=true');
                    
                window.restore_send_to_editor = window.send_to_editor;
                window.send_to_editor = function(html) {
                    imgurl = jQuery('img',html).attr('src');
                    if(uploadID.val()!='')
                    {
                        uploadID.next().next().remove();
                    }
                    uploadID.val(imgurl);  
                    var tsc = '<a class="."viewimg2"." target="."_new"."><img style="."width:50px;height:auto;margin-left:10px;"." /></a>';

                    uploadID.next().after(tsc); 
                    uploadID.next().next().attr('href',imgurl);   
                    uploadID.next().next().children().attr('src',imgurl);   
                    tb_remove();
                }
                return false;
            });
            
            jQuery('.viewimg').on('click',function(){
                var myview =  jQuery(this).attr('href');
                tb_show('', myview);
                return false;
            });

            jQuery('.viewimg2').on('click',function(){
                var myview2 =  jQuery(this).attr('href');
                tb_show('', myview2);
                return false;
            });

        });       
    </script> ";
    return $retur;
}

/*end of Image Upload function*/
?>