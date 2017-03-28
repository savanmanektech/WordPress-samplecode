<?php
/*
Template Name: Newsletter
*/

get_header();
$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
$url = $src[0];
$meta = get_post_meta($post->ID);print_r($meta); 
$color = ($meta['banner_text_color'][0] != '') ? $meta['banner_text_color'][0] : '#FFF';

$feature =  @$meta['featured_image_or_featured_video'][0]; 
if($feature == 'video'){

$vid = $meta['featured_video'] [0];
     $video_url = wp_get_attachment_url( $vid );    ?>
    <div class="home-slider" style="position:fixed;">
    <video  autoplay  loop>
        <source src="<?php echo $video_url; ?>" type="video/mp4" />
    </video>  
    
    <div class="fix-title"> <div class="container">
                <h1 style="color:<?php echo $color; ?>"><?php the_title(); ?></h1>
            </div>
    </div>
    </div>
<?php }else{ ?>

 <div class="home-slider" style="position:fixed;">
<div class="inner_top_banner" style="background: url('<?php echo $url; ?>') no-repeat center">
    <div class="overlay_up">
        <div class="middel_sect">
            <div class="container">
                <h1 style="color:<?php echo $color; ?>"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
    <a class="godown_btn" href="#second_section">
        <img src="<?php echo get_template_directory_uri(); ?>/images/down-aroow.png">
    </a>
</div>
</div>

<?php } ?>
        
        
        <!-- inner page start -->
        <div class="inner_page direction_page" id="second_section" style="position: relative; top: 100vh; background: rgb(255, 255, 255) none repeat scroll 0% 0%; z-index: 1;">
            <div class="container">
                <div class="row">
                    <div class="direction_listing">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="side_bar_left">
                                <h2><?php echo _e("DIRECTIONS",'buchan_theme'); ?></h2>
                                <span class="small_line"></span>
                                <div class="side_menu">
                                   <div class="sidebar-single-bx">
									<?php						   
									   wp_nav_menu( array(
											'menu' => 'Directions menu'
										) ); 
									?>							
									</div>							
									<span class="small_line"></span>
									<ul class="ajax_nav">										
										<?php 		global $wpdb;	
											$years = $wpdb->get_results("SELECT DISTINCT YEAR( post_date ) AS year FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'thought' GROUP BY year ORDER BY post_date DESC");	
																					
											foreach ( $years as $year ) {
												echo  '<li><a data-term="thlink" data-type="thought" data-load="true" data-val="'. $year->year .'" href="javascript:void(0)">' .  $year->year . '</a></li>';
											}
										?>									
									</ul>   					
									<span class="small_line"></span>
									<ul>
									<?php	$args = array( 'post_type' => 'thought','posts_per_page'=>-1,'year'=>2016);
										$query =  new WP_Query( $args ); 
										while( $query->have_posts() ){ 
												$query->the_post();							
											echo '<li><a href="#'.$post->post_name.'">';the_title();echo '</a></li>';					
										}  //wp_reset_postdata();  ?>									
										</ul>  								
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 col-sm-9 col-xs-12">
							<div class="studio_right_cont">	
								<div class="studio-single-section contact_detail st-contact">
									<h2><?php echo _e("THOUGHTS",'buchan_theme'); ?></h2>
									<div class="line_tag"></div>
									<div id="main">							
										<?php
											global $post;
											$args = array( 'post_type' => 'thought','posts_per_page'=>-1,'year'=>2016);
											$query =  new WP_Query( $args ); $GLOBALS['wp_query'] = $query;
											wp_localize_script( 'ajax-pagination', 'ajaxpagination', array(
												'ajaxurl' => admin_url( 'admin-ajax.php' ),
												'query_vars' => json_encode( $query->query )
											));
											while( $query->have_posts() ){ 
													$query->the_post();							
												get_template_part( 'content', get_post_type() );							
											}  //wp_reset_postdata();  ?>						
									</div>	
								</div>	
							</div>
                        </div>
                    </div>
                </div>
            </div>

        <!--Search Button Script Start-->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="http://isotope.metafizzy.co/beta/isotope.pkgd.js"></script>
        <script type="text/javascript">
		
	
	
// quick search regex
var qsRegex;
var buttonFilter;
var regFilter;
var buttonFilters;

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.element-item',
  layoutMode: 'fitRows',
    getSortData: function() {
    var $this = $(this);
   
    var gtResult = buttonFilters ? { name : $this.is( buttonFilters )} : true;
 
    return gtResult;
  },
  filter: function() {
    var $this = $(this);
    var searchResult = qsRegex ? $this.text().match( qsRegex ) : true;
    var buttonResult = buttonFilter ? $this.is( buttonFilter ) : true;
    var regResult = regFilter ? $this.is( regFilter ) : true;
    return searchResult && buttonResult && regResult;
  },
  sortBy:'name'
});

$('.project-page-sidebar-cat').on( 'click', 'a', function() {
	regFilter = '';
  buttonFilter = $( this ).attr('data-filter');
  $grid.isotope();
   $(this).parent().parent().parent().nextAll('.sidebar-single-bx').hide();
  $('.filter-div').show();
});
$('.project-page-sidebar-reg').on( 'click', 'a', function() {
  regFilter = $( this ).attr('data-filter');
  $grid.isotope();  
});
$('.project-page-sidebar-sec').on( 'click', 'a', function() {
  regFilter = $( this ).attr('data-filter');
  $grid.isotope();
  
});
$('.prj-search-btn').on( 'click', 'a', function() {
	buttonFilter ='';
	regResult = '';
  //buttonFilters = $( this ).attr('data-sort'); 
  $(this).parent().parent().parent().nextAll('.sidebar-single-bx').hide();
  $('.search_box').show();
  $grid.isotope();
});
$('.filteraz').on( 'click', 'a', function() {
	
	buttonFilter ='';
	regResult = '';
  buttonFilters = $( this ).attr('data-sort');  alert(buttonFilters); 
  $grid.isotope();
});

$('.showbtn a').on( 'click', function() {
	
	$(this).parent().parent().parent().nextAll('.sidebar-single-bx').hide();
	$($(this).attr('data-show')).show();  
	
		$('.studio-single-section').hide();
		$('.studio-single-section'+$(this).attr('data-section')).show();

});


// use value of search field to filter
var $quicksearch = $('#quicksearch').keyup( debounce( function() {
	buttonFilter ='';
	regResult = '';
  qsRegex = new RegExp( $quicksearch.val(), 'gi' );
  $grid.isotope();
}) );


  // change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});
  

// debounce so filtering doesn't happen every millisecond
function debounce( fn, threshold ) {
  var timeout;
  return function debounced() {
    if ( timeout ) {
      clearTimeout( timeout );
    }
    function delayed() {
      fn();
      timeout = null;
    }
    setTimeout( delayed, threshold || 100 );
  };
}





            if (jQuery(window).width() > 767) {
                $(document).on('scroll', function () {
                    var t = $("#second_section").position().top;
                    if ($(window).scrollTop() > t) {
                        $(".side_bar_left").addClass("dofix");
                    } else {
                        $(".side_bar_left").removeClass("dofix");
                    }
                    //
                });
            }

       

            //Click event to godown_btn
            $(document).ready(function () {
                $('.godown_btn').click(function () {
                    var targetDiv = $(this).attr('href');
                    $('html, body').animate({
                        scrollTop: $(targetDiv).offset().top
                    }, 800);

                    return false;
                });

                //jQuery(function() {
            });

            var mobileHover = function () {
                $('*').on('touchstart', function () {
                    $(this).trigger('hover');
                }).on('touchend', function () {
                    $(this).trigger('hover');
                });
            };
            mobileHover();
            $(document).ready(function () {
                var h = $(window).height();
                $(".inner_top_banner").css({'height': h});
            });
            $(window).resize(function () {
                var h = $(window).height();
                $(".inner_top_banner").css({'height': h});
            });
			
			
			
			</script>
			
			
			
			
			

		
<?php get_footer(); ?>