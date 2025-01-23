<?php get_header('home'); ?>
<div class="container-fluid" id="main-container">
    <div id="feature" class="row">
        <ul>
            <?php 
            global $wp_query;
                query_posts(
                array_merge(
                $wp_query->query,
                array('posts_per_page' => -1)
                )
            );
            if (have_posts()): $numPosts = $wp_query->found_posts;?>
            <?php
                $counter = 0;
                // Start the loop.
                while (have_posts()):
                the_post();
                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                //Store the featured image
                $thumb_id = get_post_thumbnail_id();
                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
                $thumb_url = $thumb_url_array[0]; 
                

                if($numPosts >= 5){
                    switch ($counter) {
                    case 0:
                    ?>
                        <li class="col-md-6 col-sm-6 col-xs-12 full-height main-feature-arrow">
                            <a href="<?php the_permalink(); ?>">
                                <figure style="background-image:url('<?php echo $thumb_url; ?>')"></figure>
                                <div class="blog-item-inner-main-feature">
                                    <footer>
                                        <div class="row">
                                            <aside class="col-md-5 col-sm-5 col-xs-12 left-aside background-trans-grey">
                                                <h2> <?php the_title();?> </h2>
                                            </aside>
                                            <aside class="col-md-7 col-sm-7 col-xs-12 right-aside hidden-xs">
                                                <h2 class="no-margin"><?php echo substr(the_excerpt(), 0, 30) . "..."; ?></h2>
                                                Read more. <span class="arrow fa fa-arrow-circle-o-right fa-lg"></span>
                                            </aside>
                                        </div>
                                    </footer>
                                </div> 
                            </a>
                        </li>
                    <?php
                    break;
                    case 1:
                    ?>
                        <li id="featured-2" class="col-md-3 col-sm-3 col-xs-12 half-height green">
                            <a href="<?php the_permalink(); ?>">
                                <figure style="background-image:url('<?php echo $thumb_url; ?>')"></figure>
                                <div class="blog-item-inner">
                                    <footer>
                                        <figcaption>
                                            <h2><?php the_title(); ?></h2>
                                        </figcaption>
                                    </footer>
                                </div>
                            </a>
                        </li>
                    <?php
                    break;
                    case 2:
                    ?>
                        <li id="featured-3" class="col-md-3 col-sm-3 col-xs-12 half-height pink" >
                            <a href="<?php the_permalink(); ?>">
                                <figure style="background-image:url('<?php echo $thumb_url; ?>')"></figure>
                                <div class="blog-item-inner">
                                    <footer>
                                        <figcaption>
                                            <h2><?php the_title();?></h2>
                                        </figcaption>                                        
                                    </footer>
                                </div>
                            </a>
                        </li>
                    <?php
                    break;
                    case 3:
                    ?>
                        <li id="featured-4" class="col-md-3 col-sm-3 col-xs-12 purple">
                            <a href="<?php the_permalink(); ?>">
                                <figure style="background-image:url('<?php echo $thumb_url; ?>')"></figure>
                                <div class="blog-item-inner">
                                    <footer>
                                        <figcaption>
                                            <h2><?php the_title(); ?></h2>
                                        </figcaption>
                                    </footer>
                                </div>
                            </a>
                        </li>
                    <?php
                    break;
                    case 4:
                    ?>
                        <li id="featured-5" class="col-md-3 col-sm-3 col-xs-12 grey">
                            <a href="<?php the_permalink(); ?>">
                                <figure style="background-image:url('<?php echo $thumb_url; ?>')"></figure>
                                <div class="blog-item-inner">
                                    <footer>
                                        <figcaption>
                                            <h2><?php the_title(); ?></h2>
                                        </figcaption>
                                    </footer>
                                </div>
                            </a>
                        </li>
                    </ul>
            </div>
                <?php
                break;
                default:
                    break;
            }
        }else if($numPosts < 5){
            switch($counter){
                case 0:
                    ?>
                    <li class="col-md-6 col-sm-6 col-xs-12 full-height main-feature-arrow" style="<?php if($numPosts == 1){echo 'width:100%;';} ?>">
                            <a href="<?php the_permalink(); ?>">
                                <figure style="background-image:url('<?php echo $thumb_url; ?>')"></figure>
                                <div class="blog-item-inner-main-feature">
                                    <footer>
                                        <div class="row">
                                            <aside class="<?php if($numPosts == 1){ echo 'col-md-3 col-sm-4 col-xs-4';}else{ echo 'col-md-5 col-sm-5 col-xs-12';} ?> left-aside background-trans-grey">
                                                <h2> <?php the_title();?> </h2>
                                            </aside>
                                            <aside class="<?php if($numPosts == 1){echo 'col-md-7 col-sm-6 col-xs-6';}else{echo 'col-md-7 col-sm-5 col-xs-12';}  ?> right-aside">
                                                <h2 class="no-margin"><?php echo the_excerpt(); ?></h2>
                                                Read more. <span class="arrow fa fa-arrow-circle-o-right fa-lg"></span>
                                            </aside>
                                        </div>
                                    </footer>
                                </div> 
                            </a>
                        </li>
                    <?php
                    break;
                case 1:
                    ?>
                        <li id="featured-2" class="green <?php if($numPosts == 3){ echo 'col-md-6 col-sm-6 col-xs-12 var-height';}else if($numPosts == 2){echo 'col-md-6 col-sm-6 col-xs-12 full-height\" style="height:100%;"';}else{echo 'col-md-3 col-sm-3 col-xs-12';} ?>">
                            <a href="<?php the_permalink(); ?>">
                                <figure style="background-image:url('<?php echo $thumb_url; ?>')"></figure>
                                <div class="blog-item-inner">
                                    <footer>
                                        <figcaption>
                                            <h2><?php the_title(); ?></h2>
                                        </figcaption>
                                    </footer>
                                </div>
                            </a>
                        </li>
                    <?php
                    break;
                case 2:
                    ?>
                        <li id="featured-3" class="half-height pink <?php if($numPosts == 4){echo 'col-md-3 col-sm-3 col-xs-12 var-height';}else if($numPosts == 3){ echo 'col-md-6 col-sm-6 col-xs-12 var-height';}else{ echo 'col-md-6 col-sm-6 col-xs-12';} ?>" >
                            <a href="<?php the_permalink(); ?>">
                                <figure style="background-image:url('<?php echo $thumb_url; ?>')"></figure>
                                <div class="blog-item-inner">
                                    <footer>
                                        <figcaption>
                                            <h2><?php the_title();?></h2>
                                        </figcaption>                                        
                                    </footer>
                                </div>
                            </a>
                        </li>
                    <?php
                    break;
                case 3:
                    ?>
                        <li id="featured-4" class="purple <?php if($numPosts == 4){echo 'col-md-6 col-sm-6 col-xs-12';}else{ echo 'col-md-3 col-sm-3 col-xs-12';} ?>">
                            <a href="<?php the_permalink(); ?>">
                                <figure style="background-image:url('<?php echo $thumb_url; ?>')"></figure>
                                <div class="blog-item-inner">
                                    <footer>
                                        <figcaption>
                                            <h2><?php the_title(); ?></h2>
                                        </figcaption>
                                    </footer>
                                </div>
                            </a>
                        </li>
                    <?php
                    break;
            }
            //echo "</ul>";
        }
        $counter++;
        if ($counter == 5) {
        ?>      
            <div id="other-posts" class="row"> 
        <?php
        }else if($counter > 5){
            ?>
                <div class="col-md-3 col-sm-3 col-xs-12 misc-post purple">
                    <a href="<?php the_permalink(); ?>">
                        <figure style="background-image:url('<?php echo $thumb_url; ?>')"></figure>
                        <div class="cover-desc">
                            <footer class="center center-block">
                                <div class="other-post-inner-div">
                                    <h2><?php the_title(); ?></h2>
                                    <br/> <span class="fa fa-neuter fa-lg mag-glass fa-2x"></span>
                                </div>
                            </footer>
                        </div>
                    </a>
                </div>
            <?php
        }
    // End the loop.
    endwhile;
        ?>
            </div>
        
        <?php
    // Previous/next page navigation.
    the_posts_pagination(array(
        'prev_text' => __('Previous page', 'twentyfifteen'),
        'next_text' => __('Next page', 'twentyfifteen'),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentyfifteen') . ' </span>',
    ));
// If no content, include the "No posts found" template.
else:
    get_template_part('content', 'none');
endif;
?>
<script>
            var otherPosts = document.getElementsByClassName("misc-post");
            for(var i = 0; i < otherPosts.length; i++){
                console.log("width:" + otherPosts[i].clientWidth + "px");
                otherPosts[i].style.height = (otherPosts[i].clientWidth - 30) + "px";
            }
    window.onresize = function(event){
        var otherPosts = document.getElementsByClassName("misc-post");
            for(var i = 0; i < otherPosts.length; i++){
                console.log("width:" + otherPosts[i].clientWidth + "px");
                otherPosts[i].style.height = (otherPosts[i].clientWidth - 30) + "px";
            }
    };
    
</script>
<?php
get_footer('blog');
?>