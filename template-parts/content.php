<!doctype html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mustache Enthusiast</title>
</head>
<body>

<div id="body">
    <div id="featured">
        <img src="<?php bloginfo('template_url'); ?>/images/the-beacon.jpg" alt="">
        <div id="text-main">
            <h2>the beacon to all mankind</h2>
            <span>Our website templates are created with</span>
            <span>inspiration, checked for quality and originality</span>
            <span>and meticulously sliced and coded.</span>
            <a href="blog-single-post.html" class="more">read more</a>
        </div>
    </div>
        <div><h2 class="entry-title" itemprop="headline">Тест WP_Query
                <br/>
                <?php
                $my_posts = new WP_Query;
                $myposts = $my_posts->query(array(
                    'post_type' => 'post'
                ));
                var_dump($myposts);
                foreach ($myposts as $post) {
                    echo $post->post_title . '<br/>';
                    echo '<p>'. $post->post_content . '<p/>';
                }
//                print_r(the_content());
                wp_reset_postdata();

                ?>
                <br/>

            </h2>
        </div>
<!--        <div class="entry-image">-->
<!--        --><?php //if ( has_post_thumbnail()) :?>
<!--            <a href="--><?php //the_permalink(); ?><!--" title="--><?php //the_title_attribute(); ?><!--" >-->
<!--                --><?php //the_post_thumbnail(); ?>
<!--            </a>-->
<!--        --><?php //else:  ?>
<!--            <img src="http://dummyimage.com/800x250/f3f3f3/d1d1d1.jpg&text=Featured+Image" alt="Featured Image" itemprop="image">-->
<!--        --><?php //endif; ?>
<!--        </div> <!-- .entry-image -->
    <hr/>
    <ul>
        <li>
            <a href="gallery.html">
                <img src="<?php bloginfo('template_url'); ?>/images/the-father.jpg" alt="">
                <span>the father</span>
            </a>
        </li>
        <li>
            <a href="gallery.html">
                <img src="<?php bloginfo('template_url'); ?>/images/the-actor.jpg" alt="">
                <span>the actor</span>
            </a>
        </li>
        <li>
            <a href="gallery.html">
                <img src="<?php bloginfo('template_url'); ?>/images/the-nerd.jpg" alt="">
                <span>the nerd</span>
            </a>
        </li>
    </ul>
</div>

</body>
</html>
