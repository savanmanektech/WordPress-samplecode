<?php
add_action( 'admin_init', 'register_mysocial_settings' );
function register_mysocial_settings() 
{ 
    register_setting( 'my-own-theme-options-for-social', 'developermode' );
    //register_setting( 'my-own-theme-options-for-social', 'facebook_val' );
    register_setting( 'my-own-theme-options-for-social', 'twitter_val' );
    register_setting( 'my-own-theme-options-for-social', 'linkedin_val' );
    register_setting( 'my-own-theme-options-for-social', 'instagram_val' );
    register_setting( 'my-own-theme-options-for-social', 'pinterest_val' );
    register_setting( 'my-own-theme-options-for-social', 'weibo_val' );
    register_setting( 'my-own-theme-options-for-social', 'twitter_share_val' );
    register_setting( 'my-own-theme-options-for-social', 'linkedin_share_val' );
    register_setting( 'my-own-theme-options-for-social', 'instagram_share_val' );
    register_setting( 'my-own-theme-options-for-social', 'pinterest_share_val' );
    register_setting( 'my-own-theme-options-for-social', 'weibo_share_val' );
    register_setting( 'my-own-theme-options-for-social', 'envelope_share_val' );
}
function social_links_options_page() {
?>

<div class="wrap">
    <h2>Social Links</h2>
    <?php settings_errors(); ?> 
    <form method="post" action="options.php">
        <?php settings_fields( 'my-own-theme-options-for-social' ); ?>
        <?php do_settings_sections( 'my-own-theme-options-for-social' ); ?>
        <?php include('bootstrap_theme_includes.php'); ?>
        <br />
        <div class="row">
            
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Social Links</h3>
                    </div>
                    <div class="panel-body">
                        
                 <!--       <label for="facebook_val">Facebook</label>
                        <input id="facebook_val" type="text" name="facebook_val" value="<?php echo get_option('facebook_val'); ?>" class="form-control" />
                        
                        <br /> -->
                        
                        <label for="twitter_val">Twitter</label>
                        <input id="twitter_val" type="text" name="twitter_val" value="<?php echo get_option('twitter_val'); ?>" class="form-control" />
                        
                        <br /> 
						
						<label for="linkedin_val">Linked In</label>
                        <input id="linkedin_val" type="text" name="linkedin_val" value="<?php echo get_option('linkedin_val'); ?>" class="form-control" />
                        
                        <br />
						
						<label for="instagram_val">Instagram</label>
                        <input id="instagram_val" type="text" name="instagram_val" value="<?php echo get_option('instagram_val'); ?>" class="form-control" />
                        
						<br />
                        
                        <label for="pinterest_val">Pinterest</label>
                        <input id="pinterest_val" type="text" name="pinterest_val" value="<?php echo get_option('pinterest_val'); ?>" class="form-control" />
						
						<br />
                        
                        <label for="weibo_val">Weibo</label>
                        <input id="weibo_val" type="text" name="weibo_val" value="<?php echo get_option('weibo_val'); ?>" class="form-control" />
						
                        <br />
						<label for="weibo_val">Sharing Option</label>
                       <br /> <input id="twitter_share_val" type="checkbox" name="twitter_share_val" value="enable" class="form-control" <?php if(get_option('twitter_share_val')=='enable') { ?> checked="checked" <?php } ?> />Twitter
					  <br /> <input id="linkedin_share_val" type="checkbox" name="linkedin_share_val" value="enable" class="form-control" <?php if(get_option('linkedin_share_val')=='enable') { ?> checked="checked" <?php } ?> />Linked In
					  <br /> <input id="instagram_share_val" type="checkbox" name="instagram_share_val" value="enable" class="form-control" <?php if(get_option('instagram_share_val')=='enable') { ?> checked="checked" <?php } ?> />Instagram
					    <br /> <input id="pinterest_share_val" type="checkbox" name="pinterest_share_val" value="enable" class="form-control" <?php if(get_option('pinterest_share_val')=='enable') { ?> checked="checked" <?php } ?> />Pinterest
						  <br /> <input id="weibo_share_val" type="checkbox" name="weibo_share_val" value="enable" class="form-control" <?php if(get_option('weibo_share_val')=='enable') { ?> checked="checked" <?php } ?> />Weibo 
						  <br /> <input id="envelope_share_val" type="checkbox" name="envelope_share_val" value="enable" class="form-control" <?php if(get_option('envelope_share_val')=='enable') { ?> checked="checked" <?php } ?> />Envelope
						
						<br />
						
                        <?php if(get_option('developermode')=='enable' OR $_GET['developermode']=='enable') { ?>
                        <br />
                        
                        <label for="developermode">
                            Developer Mode
                            <br />
                            <input style="margin: 0px;" <?php if(get_option('developermode')=='enable') { ?> checked="checked" <?php } ?> type="checkbox" name="developermode" id="developermode" value="enable" />
                            <span style="font-weight: normal;">Enable</span>
                        </label>
                        <?php } ?>
                        
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
