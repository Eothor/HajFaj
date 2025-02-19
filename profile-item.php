<?php

global $wp_query, $ae_post_factory, $post;
$post_object = $ae_post_factory->get( PROFILE );
$current = $post_object->current_post;
if(!$current){
    return;
}
?>
<div <?php post_class( 'col-md-6 col-sm-12 col-xs-12 profile-item' ); ?>>
	<div class="profile-content"> <a href="<?php echo $current->permalink; ?>" title="<?php _e('View Profile', ET_DOMAIN);?>"><img alt="" id="greenbutton" src="http://46.101.202.120/wp-content/themes/freelanceengine/img/plus.png"></a>
        <ul class="top-profile">
            <li class="img-avatar">
                <span class="avatar-profile"><!--  -->
                <?php echo get_avatar($post->post_author); ?>
                </span>
            </li>
            <li class="info-profile">
                <a href="<?php echo get_author_posts_url( $post->post_author ); ?>">
                    <span class="name-profile"><?php the_author_meta( 'display_name', $post->post_author ); ?></span>
                </a>
                <span class="position-profile" title="<?php echo $current->et_professional_title;?>" ><?php echo $current->et_professional_title;?></span>
            </li>
            <li class="link-profile">
                <a href="<?php echo $current->permalink; ?>" class="btn btn-view-profile" title="<?php _e('View Profile', ET_DOMAIN);?>">
                    <span><?php _e('View Profile', ET_DOMAIN);?></span>
                </a>
            </li>
        </ul>
        <ul class="bottom-profile">
            <li class="wrapper-achivement">
            	<ul>
                    <li>
                        <div class="rate-it" data-score="<?php echo $current->rating_score ; ?>"></div>
                    </li>
                   <!-- <li><span><?php //echo $current->hourly_rate_price; ?> </span></li>
                    <li><span><?php //echo $current->experience ?></span></li> -->
                </ul>
            </li>
            <li class="list-skill-profile-2">
                <ul>
                <?php echo $current->skill_list; ?>
                </ul>
            </li>
        </ul>
    </div>
</div>
