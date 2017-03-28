<?php 
add_action( 'admin_init', 'register_mybanner_settings' );
function register_mybanner_settings() 
{
    register_setting( 'my-own-theme-options-for-header', 'my_favicon_icon' );  
    register_setting( 'my-own-theme-options-for-header', 'logo_image' );
}
function banner_section_options_page() {
?>

<div class="wrap">
    <h2>Banner Section</h2>
    <?php settings_errors(); ?> 
    <form method="post" action="options.php">
        <?php settings_fields( 'my-own-theme-options-for-header' ); ?>
        <?php do_settings_sections( 'my-own-theme-options-for-header' ); ?>
        <?php include('bootstrap_theme_includes.php'); ?>
        <br />
        <div class="row">
            
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Banner Options</h3>
                    </div>
                    
                    <div class="panel-body">
                        
                        
                        
                        <label style="width: 100%;" for="upload_image">People</label>
                        <?php echo my_image_uploader('people_banner', 'Upload Image'); ?>
                        
                        <br />
                        <br />
                        
                        <label style="width: 100%;" for="upload_image">Studio</label>                            
                        <?php echo my_image_uploader('my_favicon_icon', 'Upload Image'); ?>
                        
                       
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
