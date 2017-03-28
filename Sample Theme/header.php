<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>
            <?php
            global $page, $paged;
            wp_title('-', true, 'right');
            bloginfo('name');
            $site_description = get_bloginfo('description', 'display');
            if ($site_description && ( is_home() || is_front_page() ))
                echo " | $site_description";
            if ($paged >= 2 || $page >= 2)
                echo ' | ' . sprintf(__('Page %s', 'mytheme'), max($paged, $page));
            ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <link rel="icon" type="image/png" href="<?php echo get_option('my_favicon_icon'); ?>"/>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 
        <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>
        <?php
        wp_enqueue_script('jquery');
        wp_head();
        ?>
        <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo get_template_directory_uri(); ?>/css/bootsnav.css" rel="stylesheet"/>
        <!--slide-->
        <!--   <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fullPage.css" /> -->
        <!--  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/examples.css" /> -->
        <link href="<?php echo get_template_directory_uri(); ?>/css/custom.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css"/>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl.transitions.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/owl-theme.css"/>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css"/>
        <link href="<?php echo get_template_directory_uri(); ?>/css/responsive.css" rel="stylesheet"/>
        <link href="<?php echo get_template_directory_uri(); ?>/css/developer.css" rel="stylesheet"/>
        <!-- Custom Fonts -->
        <link href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/bootsnav.js"></script>
    </head>
    <body <?php body_class(); ?>>
        <div class="loader" style="display:none;"><img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif"></div>
        <header>
            <!-- Navigation -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-default navbar-brand-top bootsnav custom_nav">
                            <!-- Start Header Navigation -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                                    <i class="fa fa-bars"></i>
                                </button>
                            </div>
                            <!-- End Header Navigation -->
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="navbar-menu">
                                <ul class="nav navbar-nav" data-in="fadeInDown" data-out="fadeOutUp">							
                                    <?php
                                    $menu_name = 'Header Menu';
                                    $menu_items = wp_get_nav_menu_items($menu_name);
                                    foreach ((array) $menu_items as $key => $menu_item)
                                    {
                                        $title = $menu_item->title;
                                        $url = $menu_item->url;
                                        echo '<li><a href="' . $url . '">' . $title . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                            <div class="logo">
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <img src="<?php echo get_option('logo_image'); ?>" alt=""/>
                                </a>
                            </div>
                            <div class="search_language">
                                <ul>
                                    <li>
                                        <form action="<?php echo site_url(); ?>">
                                            <input class="search search_textbox" type="text" name="s" placeholder="search here..." value="<?php echo @$_GET['s']; ?>"/>
                                            <a href="#" class="open">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </form>
                                    </li>
                                    <?php echo do_action('wpml_add_language_selector'); ?>
                                    <!--  <li><a href="#">中文</a></li> -->
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->