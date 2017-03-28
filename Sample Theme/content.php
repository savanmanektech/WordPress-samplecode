<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

 $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->id), 'full' ); 
							$url = $src[0]; ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="left_imgtag">
                                        <img src="<?php echo $url; ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="right_content">
                                        <span class="date"><?php echo get_the_date(); ?> </span>
                                        <h2><?php the_title(); ?></h2>
                                        <span class="small_line"></span>                                     
										<?php the_excerpt(); ?>
                                        <span class="read_more"><a href="<?php the_permalink() ?>">READ MORE</a></span>
                                        <div class="social_share">
                                            <h4>SHARE</h4>
                                            <ul>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                                <li><a href="#"><i class="fa fa-weibo"></i></a></li>
                                                <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"><div class="line_tag"></div></div>
                            </div>
