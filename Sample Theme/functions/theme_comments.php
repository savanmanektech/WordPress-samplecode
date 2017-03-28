<?php 
function themename_comment($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>

    <<?php echo $tag ?>
    <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?>
    id="comment-
    <?php comment_ID() ?>
    ">
        <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
            <?php endif; ?>
        <div class="comment-author vcard">
    <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, 40); ?>
        </div>
        <div class="commentList">
            <div class="authorName"> <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> </div>
                <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation">
                <?php _e('Your comment is awaiting moderation.') ?>
                </em> <br />
                <?php endif; ?>
            <div class="commentText">
                <?php comment_text(); ?>
            </div>
            <div class="reply"> <?php echo human_time_diff(get_comment_time('U'), current_time('timestamp')) . ' ago'; ?>
    <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
        </div>
        <div class="clear"></div>
    <?php if ('div' != $args['style']) : ?>
        </div>
    <?php
    endif;
}
?>