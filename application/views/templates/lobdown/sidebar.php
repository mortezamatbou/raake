

<aside class="col-xs-12 text-center right-sidebar" >


    <div class="right-sidebar-item">
        <?php $lists = get_instance_main_model()->get_tutorial_list(1); ?>
        <div class="right-sidebar-title">آموزش ها</div>
        <div class="clearfix"></div>
        <?php if ($lists): ?>
            <?php foreach ($lists as $row): ?>

                <div style="border-top: 1px solid rgba(0,0,0, .2);">
                    <a class="category" href="/tutorials/<?= $row->tutorials_name ?>">
                        <?= $row->tutorials_title ?>
                    </a>
                </div>


            <?php endforeach; ?>
        <?php else: ?>
            <div style="border-top: 1px solid rgba(0,0,0, .2);">
                <a class="category" href="#">
                    آموزشی وجود ندارد
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="clearfix"></div><br>

    <div class="right-sidebar-item">
        <div class="right-sidebar-title">دسته بندی ها</div>
        <div class="clearfix"></div>
        <?php $categorys = get_instance_main_model()->get_categorys(); ?>

        <?php if ($categorys): ?>
            <?php foreach ($categorys as $row): ?>
                <div style="border-top: 1px solid rgba(0,0,0, .2);">
                    <a class="category" title="<?= $row->description ?>" href="/<?= $row->url ?>">
                        <?= $row->title ?> &nbsp;&nbsp;<span class="count-of-category"><?= $row->count ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="border-top: 1px solid rgba(0,0,0, .2);">
                <a class="category" href="#">
                    <span>دسته بندی وجود ندارد</span>
                </a>
            </div>
        <?php endif; ?>


    </div>

    <div class="clearfix"></div><br>

    <div class="noti-sidebar">
        <div class="noti-sidebar-title">آخرین ارسالی ها</div>
        <div class="clearfix"></div>
        <?php $last_article = get_instance_main_model()->get_last_article(10); ?>
        <?php if ($last_article): ?>
            <?php foreach ($last_article as $row) { ?>
                <div style="padding: 0px; margin: 0px;text-align: right; border-top: 1px solid rgba(0,0,0, .2);">
                    <a class="noti-last-article" title="<?= $row->article_title ?>" href="/<?= $row->article_id . '/' . str_replace(' ', '-', $row->article_title) ?>">
                        <?= $row->article_title ?>
                    </a>
                </div>
            <?php } ?>
        <?php else: ?>
            <div style="padding: 0px; margin: 0px;text-align: right; border-top: 1px solid rgba(0,0,0, .2);">
                <a class="noti-last-article text-center" href="#">
                    مقاله ای وجود ندارد
                </a>
            </div>
        <?php endif; ?>
    </div>
    <br>
    <div class="noti-sidebar">
        <div class="noti-sidebar-title green">پربازدید ترین ها</div>
        <div class="clearfix"></div>
        <?php $popular_articles = get_instance_main_model()->get_popular_article(10); ?>

        <?php if ($popular_articles): ?>
            <?php foreach ($popular_articles as $row) : ?>
                <div style="padding: 0px; margin: 0px;text-align: right; border-top: 1px solid rgba(0,0,0, .2);">
                    <a class="noti-popular-article" title="<?= $row->article_title ?>" href="/<?= $row->article_id ?>/<?= str_replace(' ', '-', $row->article_title) ?>">
                        <?= $row->article_title ?><i class="fa fa-eye"></i> <?= $row->article_view ?>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="padding: 0px; margin: 0px;text-align: right; border-top: 1px solid rgba(0,0,0, .2);">
                <a class="noti-popular-article text-center" href="#">
                    مقاله ای وجود ندارد
                </a>
            </div>
        <?php endif; ?>
    </div>

</aside>