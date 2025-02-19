<?php

$author_id = get_query_var('author');
if(is_page_template('page-profile.php')) {
    global $user_ID;
    $author_id = $user_ID;
}

global $wp_query, $ae_post_factory, $post;

// $post_object = $ae_post_factory->get( BID );
// if(ae_user_role($author_id) == FREELANCER) {
    $post_object = $ae_post_factory->get(BID);
// }else {
//     $post_object = $ae_post_factory->get(PROJECT);
// }

$current     = $post_object->current_post;

if(!$current || !isset( $current->project_title )){
    return;
}

?>

<li class="bid-item">
    <div class="name-history">
        <a href="<?php echo get_author_posts_url( $current->post_author ); ?>">
            <span class="avatar-bid-item"><?php echo $current->project_author_avatar;?></span>
        </a>
        <div class="content-bid-item-history">
            <?php if($current->project_status == 'complete'){ ?>
                <h5><a href = "<?php echo $current->project_link; ?>"><?php echo $current->project_title; ?></a>
                    <div class="rate-it" data-score="<?php echo $current->rating_score; ?>"></div>
                </h5>
                <?php if(isset($current->project_comment)){ ?>
                <span class="comment-author-history">
                    <?php echo $current->project_comment; ?>
                </span>
                <?php } else { ?>
                <span class="stt-in-process"><?php _e('Job is closed', ET_DOMAIN);?></span>
                <?php } ?>
            <?php } else if($current->project_status == 'close'){ ?>
                <h5>
                    <a href = "<?php echo $current->project_link; ?>"><?php echo $current->project_title; ?></a>
                </h5>
                <span class="stt-in-process"><?php _e('Job in process', ET_DOMAIN);?></span>
            <?php } else { ?>
                <h5>
                    <a href = "<?php echo $current->project_link; ?>"><?php echo $current->project_title; ?></a>
                </h5>
                <span class="stt-in-process"><?php _e('Job is closed', ET_DOMAIN);?></span>
            <?php } ?>
        </div>
    </div>
    <ul class="info-history">
        <li><?php echo $current->project_post_date; ?></li>
        <li>
            <?php _e("Bid Budget", ET_DOMAIN); ?> : <span class="number-price-project-info"><?php echo $current->bid_budget_text; ?> </span>
        </li>
        <!-- <li><?php _e('Earned :', ET_DOMAIN) ;  echo $current->et_budget; ?></li> -->
    </ul>
    <div class="clearfix"></div>
</li>
