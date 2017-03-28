<?php 
add_action( 'admin_init', 'register_mymenu_register_settings' );
function register_mymenu_register_settings() 
{ 
    register_setting( 'my-own-theme-options-for-menu-register', 'register_menus_options' );
}
function register_menu_options_page()
{
    
?>
<div class="wrap">
    <h2>Register Menus</h2>
    <?php settings_errors(); ?> 
    <form method="post" action="options.php">
        <?php settings_fields( 'my-own-theme-options-for-menu-register' ); ?>
        <?php do_settings_sections( 'my-own-theme-options-for-menu-register' ); ?>
        <?php include('bootstrap_theme_includes.php'); ?>
        <br />
        <div class="row">
            
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register Menus</h3>
                    </div>
                    <div class="panel-body">
                       
                         <style type="text/css">
		
		.repatertab
		{
			border:1px solid #CCC;
			border-collapse:collapse;
		}
		.repatertab td, .repatertab th
		{
			border:1px solid #CCC;
			padding:5px;
		}
		.repatertab tr
		{
			border:1px solid #CCC;
		}
		.repatertab th
		{
			background:#DDDDDD;
                        text-align: center;
		}
		.repatertab tr:nth-child(even) {background: #FFF}
		.repatertab tr:nth-child(odd) {background: #EEE}
		.repatertab .sort
		{
			cursor:move;
		}
		
	</style>
      
      <script type="text/javascript">
      	jQuery(document).ready(function($){
			$("#addnewfield").live("click",function(){
				$("#sortable tr").find('input[type=button]').removeAttr('disabled');
				var clo = $("#sortable tr:last-child").clone();
				
				clo.find('.sort').text(($(".repatertab tr").size()));
				clo.find('input[type=text]').val('').end().insertAfter("#sortable tr:last-child");
			});
						
			$(".removethis").live("click",function(){
				if($(".repatertab tr").size()>2)
				{
					$(this).parent().parent().remove();
				}
				else
				{
					$(".removethis").attr('disabled','disabled');
				}
			});
                        
                        //jQuery( "#sortable" ).sortable({cancel: 'input,button,textarea'});
		});
	</script>

     
                  
         
                              
                              	<table class="repatertab" width="100%">
                                    <thead>
                                    <tr>
                                    	<th>#</th>
                                        <th>Menu ID</th>
                                        <th>Menu Name</th>
                                        <th>Remove</th>
                                    </tr>
                                    </thead>
                                    <tbody id="sortable">
                                    <?php 
                                        $outputdata = get_option('register_menus_options');

                                        if(empty($outputdata))
                                        {
                                            
                                            $countrec = 1;
                                        }
                                        else
                                        {
                                            $countrec = count($outputdata['menu_id']);
                                        }
                                        
                                    ?>
                                    <?php for($i=0;$i<$countrec;$i++) { ?>
                                        <?php 
                                        if(!empty($outputdata))
                                        {
                                            if($outputdata['menu_id'][$i]!='') 
                                            { 
                                                $menu_id = $outputdata['menu_id'][$i]; 
                                            }
                                            if($outputdata['menu_name'][$i]!='') 
                                            { 
                                                $menu_name = $outputdata['menu_name'][$i]; 
                                            }
                                        }
                                        
                                        ?>
                                          <tr id="myrow<?php echo $i?>">
                                          	<td class="sort" align="center" valign="middle" width="50px">
                                                    <?php echo $i+1; ?>
                                                </td>
                                                
                                                <td align="center" valign="middle">
                                                    <input type="text" class="form-control" placeholder="menu_id" value="<?php echo $menu_id; ?>" name="register_menus_options[menu_id][]" />
                                                </td> 
                                                
                                                <td align="center" valign="middle">
                                                    <input type="text" class="form-control" placeholder="Menu Name" value="<?php echo $menu_name; ?>" name="register_menus_options[menu_name][]" />
                                                </td> 
                                                
                                                <td align="center" valign="middle">
                                                    <input class="button removethis" type="button" value="Remove" />
                                                </td> 
                                          </tr>
                                    <?php } ?>
                                    </tbody>
                                    </table>	
        <br />
                              	<input class="button addnewbutton" type="button" id="addnewfield" value="add new" />
                              
                  
                                         
               
                       
                    </div>
                </div>
            </div>
            
            <?php include 'option_page_sidebar.php'; ?>
            
        </div>
   
        <?php submit_button(); ?>
        
    </form>
</div>
<?php
}
?>