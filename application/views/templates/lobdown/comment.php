<?php
$comments = $article->comments();

if ($comments) :

    foreach ($comments as $row) :
        ?>
        <div class="comment-item col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-10 col-sm-push-1 col-xs-10 col-xs-push-1">
            <div class="comment-item-details">
                <i class="fa fa-calendar-minus-o"></i>
                <?= $row->comment_date ?> &nbsp; <a target="_blank" href="<?= $row->comment_url ?>"> <i class="fa fa-link"></i></a>
            </div>
            <div class="comment-item-title"><i style="color: rgba(150,0,0, .7)" class="fa fa-user fa-3x"></i> <?= $row->comment_name ?></div>
            <div class="comment-item-content">
                <?= $row->comment_content ?>
            </div>
            <?php $answer = get_instance()->db->query("SELECT *  FROM answer WHERE comment_id = '$row->comment_id' ORDER BY answer_date ASC"); ?>
            <?php if ($answer->num_rows() > 0) : ?>
                <?php foreach ($answer->result() as $a) : ?>
                    <?php $author_name = get_instance_main_model()->get_author($a->answer_author); ?>
                    <?php $answer_date = explode(' ', $a->answer_date); ?>
                    <div class="comment-item-response">
                        <div class="comment-item-response-details col-xs-12 col-xs-push-0">
                            <p><i class="fa fa-user-secret fa-3x" style="color: rgba(0,0,0, .7)"></i> جواب داده شده توسط <b><?= $author_name ?></b> در تاریخ <b><?= $answer_date[0] ?></b>
                        </div>
                        <?= $a->answer_content; ?>
                    </div>
                    <div class="clearfix"></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="alert alert-danger">دیدگاهی وجود ندارد</p>
<?php endif;
    