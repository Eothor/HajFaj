<?php

global $wp_query, $ae_post_factory, $post, $user_ID;
$post_object    = $ae_post_factory->get(PROJECT);

$project            = $post_object->current_post;

$number_bids    = (int)get_number_bids( get_the_ID() );
//$sum            = (float) get_total_cost_bids( get_the_ID() );
add_filter('posts_orderby', 'fre_order_by_bid_status');
$q_bid      = new WP_Query( array(  'post_type' => BID,
                                    'post_parent' => get_the_ID(),
                                    'post_status' => array('publish','complete', 'accept')
                                )
                            );
remove_filter('posts_orderby', 'fre_order_by_bid_status');
$biddata    = array();
?>
<div class="col-md-8">

    <div class="row title-tab-project <?php if($q_bid->found_posts < 1 ) echo 'visibility-hidden' ?>">
        <div class="col-md-4 col-xs-4">
            <span><?php printf(__('FREELANCER BIDDING (%s)',ET_DOMAIN), $number_bids);?></span>
        </div>
        <div class="col-md-4 col-xs-4">
            <span><?php _e('REPUTATION',ET_DOMAIN);?></span>
        </div>
        <div class="col-md-4 col-xs-4 block-bid-header" >
            <span><?php _e('BID',ET_DOMAIN);?></span>
        </div>
    </div>
    <div class="info-bidding-wrapper project-<?php echo $project->post_status; ?>">
        <?php

        if( $q_bid->have_posts() ):

            global $wp_query, $ae_post_factory, $post;
            $post_object = $ae_post_factory->get(BID);

            while( $q_bid ->have_posts() ) :$q_bid->the_post();
                $convert    = $post_object->convert($post);
                $biddata[]  = $convert;
                get_template_part('template/bid','item');
            endwhile;
            echo '<div class="row list-bidding-js">
            </div> ';
            echo '<div class="paginations-wrapper">';
                $q_bid->query = array_merge(  $q_bid->query ,array('is_single' => 1 ) ) ;
                ae_pagination($q_bid, get_query_var('paged'), 'load');
            echo '</div>';

        else :
            get_template_part('template/bid','not-item');
        endif;
        ?>

    </div>
</div>
<input type="hidden" id="project_id" name="<?php echo $project->ID;?>" value="<?php echo $project->ID;?>" />
<div class="col-md-4">
    <div class="row title-tab-project">
        <div class="col-md-12">
            <span><?php _e('ABOUT EMPLOYER',ET_DOMAIN);?></span>
        </div>
    </div>
    <div class="info-company-wrapper">
        <div class="row">
            <div class="col-md-12">
                <?php fre_display_user_info( $project->post_author ); ?>
            </div>
        </div>
    </div>
</div>

<?php
if(!empty($biddata)) {
    echo '<script type="data/json" class="biddata" >'.json_encode($biddata). '</script>';
}
