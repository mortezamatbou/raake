<?php $main_model = get_instance_main_model(); ?>

<div id="wrapper" class="container col-lg-10 col-lg-push-1 col-md-12 col-md-push-0 col-sm-10 col-sm-push-1 col-xs-12 col-xs-push-0">
    <div id="main" class="row">


        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <?php get_sidebar() ?>
        </div>

        <?php $article = get_instance_article(); ?>

        <div id="articles" class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <h1 style="margin-top: 0px; padding: 5px 15px;border-radius: 2px; border: 1px solid rgba(0,0,0, .2); background-color: rgba(0,0,0, .02); font-size: 25px">
                <?= $title ?>
            </h1>

            <div class="clearfix"></div>

            <?php if ($article->have_article): ?>
            <?php $i = 1; ?>
                <?php while ($row = $article->next()): ?>
                    <article class="article-box col-xs-12">
                        <div class="col-xs-12" style="padding: 0px;">
                            <div class="col-lg-9 col-xs-6" style="padding: 0px;">
                                <a href="<?= $row->get_permalink() ?>">
                                    <h2><?= $row->title ?> <span style="font-size: 12px; color: blue;">قسمت <?= $i++ ?></span> </h2>
                                </a>
                                <div class="article-precontent"><?= $row->description ?></div>
                                
                                <a class="btn btn-info btn-xs article-more" href="<?= $row->get_permalink() ?>">ادامه</a>
                            </div>
                            <div class="col-lg-3 col-xs-6" style="padding: 0px;">
                                <img class="img-responsive" alt="<?= $row->title ?>" src="/upload/blog/image/<?= $row->thumbnail ?>" />
                            </div>
                        </div>
                    </article>
                    <div class="clearfix"></div>
                    <br>
                <?php endwhile; ?>

            <?php else: ?>
                <article class="article-box col-xs-12">
                    <div class="col-xs-12" style="padding: 0px;">
                        <p>آموزشی وجود ندارد</p>
                    </div>
                </article>
            <?php endif; ?>

            <div class="clearfix"></div>

        </div>
    </div>
</div>