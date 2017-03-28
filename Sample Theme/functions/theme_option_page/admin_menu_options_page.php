<?php
add_action( 'admin_init', 'register_myamdin_menu_register_settings' );
function register_myamdin_menu_register_settings() 
{ 
    register_setting( 'my-own-theme-options-for-admin-menu-register', 'register_menus_options' );
}


function admin_menu_options_page() {
?>
<?php 
    $avlpage = get_option('admin_menu_options_page');
    
    if($_GET['action']=='delete' AND $_GET['id']!='')
    {
        $id = $_GET['id'];        
        for($i=0;$i<count($avlpage);$i++) 
        {
            if($i!=$id)
            {
               $newval[] =  $avlpage[$i]; 
            }                
        }
        update_option( 'admin_menu_options_page', $newval );    
        wp_redirect( get_admin_url( '', 'admin.php?page=admin_menu_options_page&action=delete&status=1') );
        exit;
    }
    
    if($_POST['save']=='Save Changes')
    {
        if(!empty($avlpage))
        {
            
            $val = array("menu_type"=>$_POST['menu_type'], "parent_menu_slug"=>$_POST['parent_menu_slug'], "menu_slug"=>$_POST['menu_slug']);            
            array_push($avlpage,$val);
        }
        else
        {
            $avlpage = NULL;
            $avlpage[] = array("menu_type"=>$_POST['menu_type'], "parent_menu_slug"=>$_POST['parent_menu_slug'], "menu_slug"=>$_POST['menu_slug']);   
        }
        //$avlpage = NULL;
        update_option( 'admin_menu_options_page', $avlpage );
        
        wp_redirect( get_admin_url( '', 'admin.php?page=admin_menu_options_page&action=add&status=1') );
        exit;
    }
   
?>
<div class="wrap">
    <h2>Admin Menus</h2>
    <?php if(($_GET['action']=='add' AND $_GET['status']=='1') OR ($_GET['action']=='delete' AND $_GET['status']=='1')) { ?>
    <div id="setting-error-settings_updated" class="updated settings-error below-h2">
        <p>
            <strong>Settings saved.</strong>
        </p>
    </div>
    <?php } ?>
    
    <?php if($_GET['action']=='add' AND $_GET['status']=='0') { ?>
    <div id="setting-error-settings_updated" class="error settings-error below-h2">
        <p>
            <strong>Sorry! Filename is already exist.</strong>
        </p>
    </div>
    <?php } ?>
    
    <?php if($_GET['action']=='delete' AND $_GET['status']=='0') { ?>
    <div id="setting-error-settings_updated" class="error settings-error below-h2">
        <p>
            <strong>Sorry! File is not delete</strong>
        </p>
    </div>
    <?php } ?>
    
    <?php //settings_errors(); ?> 
    <form method="post">
        <?php settings_fields( 'my-own-theme-options-for-admin-menu-register' ); ?>
        <?php do_settings_sections( 'my-own-theme-options-for-admin-menu-register' ); ?>
        <?php include('bootstrap_theme_includes.php'); ?>
        <br />
        <div class="row">
            
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hide a Menu</h3>
                    </div>
                    <div class="panel-body">
                      
                        <label for="menu_type">Select Menu Type</label>
                        <select id="menu_type" name="menu_type" class="form-control">
                            <option value="main_menu">Main Menu</option>
                            <option value="sub_menu">Sub Menu</option>
                        </select>
                        
                        <script>
                        jQuery(document).ready(function($){
                            $("#menu_type").change(function(){
                                
                                if($(this).val()=='sub_menu')
                                {
                                    $(".permen").show();
                                    $(".permen #parent_menu_slug").attr("required","required");                                    
                                }
                                else
                                {
                                    $(".permen").hide();
                                    $('.permen #parent_menu_slug').removeAttr("required");
                                }
                                
                            });                          
                        });
                        </script>
                        
                        <div style="display: none;" class="permen">
                            
                            <br />

                            <label for="parent_menu_slug">Parent Menu Slug</label>
                            <input id="parent_menu_slug" type="text" name="parent_menu_slug" class="form-control" />
                        
                        </div>
                        
                        <br />
                        
                        <label for="menu_slug">Menu Slug</label>
                        <input required id="menu_slug" type="text" name="menu_slug" class="form-control" />
                        
                        <br />
                        
                    </div>
                </div>
            </div>
            
            <?php include 'option_page_sidebar.php'; ?>
            <?php $avlpage = get_option('admin_menu_options_page'); ?>
            <?php if(!empty($avlpage)) { ?>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hided Menus</h3>
                    </div>
                    <div class="panel-body">
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Menu Type</th>
                                    <th>Parent Menu Slug</th>
                                    <th>Menu Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php for($i=0;$i<count($avlpage);$i++) { ?>
                                <tr>
                                    <td><?php echo $i+1; ?></td>
                                    <td><?php echo $avlpage[$i]['menu_type'] ?></td>
                                    <td><?php echo $avlpage[$i]['parent_menu_slug'] ?></td>
                                    <td><?php echo $avlpage[$i]['menu_slug'] ?></td>
                                    <td><a OnClick="return confirm('Are you sure want un-hide this Admin menu?');" href="<?php echo get_admin_url( '', 'admin.php?page=admin_menu_options_page&action=delete&id='.$i);?>" class="btn btn-xs btn-default">Delete</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
            <?php } ?>
            
        </div>
        <p class="submit">
            <input id="submit" class="button button-primary" type="submit" value="Save Changes" name="save">
        </p>
        <?php //submit_button(); ?>
        
    </form>
</div>
<?php } 
/*My Theme Option*/
?>
