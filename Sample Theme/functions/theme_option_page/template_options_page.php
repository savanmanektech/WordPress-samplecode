<?php
add_action( 'admin_init', 'register_mytemplate_settings' );
function register_mytemplate_settings() 
{ 
    register_setting( 'my-own-theme-options-for-template', 'register_menus_options' );
}
function template_options_page() {
?>
<?php 
    $avlpage = get_option('template_options_page');
    if($_GET['action']=='delete' AND $_GET['id']!='')
    {
        $id = $_GET['id'];
        $file = TEMPLATEPATH."/".$avlpage[$id]['file_name'].".php";
        
        for($i=0;$i<count($avlpage);$i++) 
        {
            if($i!=$id)
            {
               $newval[] =  $avlpage[$i]; 
            }                
        }
        update_option( 'template_options_page', $newval );
        
        if (!unlink($file))
        {
            wp_redirect( get_admin_url( '', 'admin.php?page=template_options_page&action=delete&status=0') );
            exit;
        }
        else
        {
            wp_redirect( get_admin_url( '', 'admin.php?page=template_options_page&action=delete&status=1') );
            exit;
        }
    }
    
    if($_POST['save']=='Save Changes')
    {
        
        if($_POST['based_on']!='')
        {
            $return = file_get_contents(TEMPLATEPATH."/".$_POST['based_on']);
            $txt = "<?php
            /*
            Template Name: ".$_POST['template_name']."
            */
            ?>
            ".$return;            
        }
        else
        {
            $txt = "<?php
            /*
            Template Name: ".$_POST['template_name']."
            */
            ?>
            <?php get_header();?>

            <?php get_footer(); ?>
            ";
        }
        $file = TEMPLATEPATH."/".$_POST['file_name'].".php";
        if(file_exists($file))
        {
            wp_redirect( get_admin_url( '', 'admin.php?page=template_options_page&action=add&status=0') );
            exit;
        }
        
        $myfile = fopen($file, "w");
        fwrite($myfile, $txt);
        
        
        if(!empty($avlpage))
        {
            
            $val = array("file_name"=>$_POST['file_name'], "template_name"=>$_POST['template_name'], "based_on"=>$_POST['based_on']);            
            array_push($avlpage,$val);
        }
        else
        {
            $avlpage = NULL;
            $avlpage[] = array("file_name"=>$_POST['file_name'], "template_name"=>$_POST['template_name'], "based_on"=>$_POST['based_on']);
        }
        //$avlpage = NULL;
        update_option( 'template_options_page', $avlpage );
        
        wp_redirect( get_admin_url( '', 'admin.php?page=template_options_page&action=add&status=1') );
        exit;
    }
   
?>
<div class="wrap">
    <h2>Template Pages</h2>
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
        <?php settings_fields( 'my-own-theme-options-for-template' ); ?>
        <?php do_settings_sections( 'my-own-theme-options-for-template' ); ?>
        <?php include('bootstrap_theme_includes.php'); ?>
        <br />
        <div class="row">
            
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Create Template</h3>
                    </div>
                    <div class="panel-body">
                      
                        <label for="file_name">File Name</label>
                        <input required id="file_name" type="text" name="file_name" class="form-control" />
                        
                        <br />
                        
                        <label for="template_name">Template Name</label>
                        <input required id="template_name" type="text" name="template_name" class="form-control" />
                        <br />
                        <label for="based_on">Based On</label>
                        <select id="based_on" name="based_on" class="form-control">
                            <option value="">Don't Want</option>
                            <option value="page.php">page.php</option>
                            <option value="single.php">single.php</option>
                            <option value="archive.php">archive.php</option>
                        </select>
                        
                        <br />
                     
                    </div>
                </div>
            </div>
            
            <?php include 'option_page_sidebar.php'; ?>
            
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Available Templates</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>File Name</th>
                                    <th>Template Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $avlpage = get_option('template_options_page'); ?>
                                <?php if(!empty($avlpage)) { for($i=0;$i<count($avlpage);$i++) { ?>
                                <tr>
                                    <td><?php echo $i+1; ?></td>
                                    <td><?php echo $avlpage[$i]['file_name'] ?></td>
                                    <td><?php echo $avlpage[$i]['template_name'] ?></td>
                                    <td><a OnClick="return confirm('Are you sure want delete this Template?');" href="<?php echo get_admin_url( '', 'admin.php?page=template_options_page&action=delete&id='.$i);?>" class="btn btn-xs btn-default">Delete</a></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                        
                        
                     
                    </div>
                </div>
            </div>
            
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
