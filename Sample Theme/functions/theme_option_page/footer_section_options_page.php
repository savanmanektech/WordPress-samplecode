<?php 
add_action( 'admin_init', 'register_myfooter_settings' );
function register_myfooter_settings() 
{ 
    register_setting( 'my-own-theme-options-for-footer', 'my_footer_text' );
    register_setting( 'my-own-theme-options-for-footer', 'my_image2' );    
}
function footer_section_options_page() {
    
?>
<div class="wrap">
    <h2>Footer Section</h2>
    <?php settings_errors(); ?> 
    <form method="post" action="options.php">
        <?php settings_fields( 'my-own-theme-options-for-footer' ); ?>
        <?php do_settings_sections( 'my-own-theme-options-for-footer' ); ?>
        <?php include('bootstrap_theme_includes.php'); ?>
        <br />
        <div class="row">
            
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Footer Sections</h3>
                    </div>
                    <div class="panel-body">
                       
                        <label for="facebook_val">Footer Option</label>
                        <?php
                            $content = get_option('my_footer_text');
                            $editor_id = 'my_footer_text';
                            wp_editor( $content, $editor_id );
                        ?>
                        
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
