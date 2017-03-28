<?php 
    $sidebarurl = get_admin_url( '', 'admin.php?page=');
    $myscreen = get_current_screen();
    $myscreen_id = $myscreen->id;
    $currentscreen_sluge = "site-options_page";
    
    
    $my_all_side_pages = $GLOBALS['all_main_pages'];    
    
if(!empty($my_all_side_pages)) {
?>

<div class="col-md-4">
    <div class="list-group">
        <?php $i=0; foreach($my_all_side_pages as $side_menu) { if($i==0) { $currentscreen_sluge="toplevel_page_"; } else { $currentscreen_sluge = "site-options_page_"; } ?>
            <?php if($side_menu['is_procted']!='yes') { ?>
            <a class="list-group-item <?php if($myscreen_id==$currentscreen_sluge.$side_menu['page_slug']) { echo "active"; } ?>" href="<?php echo $sidebarurl.$side_menu['page_slug']; ?>"><?php echo $side_menu['menu_name']; ?></a>
            <?php } else { ?>
                <?php if(get_option('developermode')=='enable' OR $_GET['developermode']=='enable') { ?>
                    <a class="list-group-item <?php if($myscreen_id==$currentscreen_sluge.$side_menu['page_slug']) { echo "active"; } ?>" href="<?php echo $sidebarurl.$side_menu['page_slug']; ?>"><?php echo $side_menu['menu_name']; ?></a>
                <?php } ?>
            <?php } ?>
        <?php $i++; } ?>
    </div>
</div>
<?php } ?>