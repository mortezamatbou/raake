<?php $main_model = get_instance_main_model(); ?>

<div id="wrapper" class="container col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-10 col-sm-push-1 col-xs-12 col-xs-push-0">
    <div id="main" class="row">       

        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <aside class="col-xs-12 text-center right-sidebar" >
                <?php get_sidebar(); ?>
            </aside>
        </div>

        <?php $article = get_instance_article(); ?>

        <div id="articles" class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
            <h1 style="margin-top: 0px; padding: 5px 15px;border-radius: 2px; border: 1px solid rgba(0,0,0, .2); background-color: rgba(0,0,0, .02); font-size: 30px">آموزش برنامه نویسی و طراحی وب</h1>

            <div class="clearfix"></div>

            <?php if ($article->have_article): ?>
                <?php while ($row = $article->next()): ?>
                    <article class="article-box col-xs-12">
                        <div class="col-xs-12" style="padding: 0px;">
                            <div class="col-lg-9 col-xs-6" style="padding: 0px;">
                                <a href="<?= $row->get_permalink() ?>">
                                    <h2><?= $row->title ?></h2>
                                </a>
                                <div class="article-precontent"><?= $row->description ?></div>
                                <div class="article-box-details">
                                    <?php $date = explode(' ', $row->date) ?>
                                    <span><i class="fa fa-eye"></i> &nbsp; <?= $row->view ?></span>
                                    <span><i class="fa fa-calendar"></i> &nbsp; <?= $date[0] ?></span>
                                    <span><i class = "fa fa-tag"></i> &nbsp; <?= $row->category ?></span>
                                    <span><i class = "fa fa-comment-o"></i> &nbsp; <?= $row->comment_count ?></span>
                                    <span><i class = "fa fa-pencil"></i> &nbsp; <?= $row->author ?></span>
                                </div>
                                <div class="clearfix"></div>
                                <a class="btn btn-default article-more" href="<?= $row->get_permalink() ?>">ادامه</a>
                            </div>
                            <div class="col-lg-3 col-xs-6" style="padding: 0px;">
                                <img class="img-responsive" alt="<?= $row->title ?>" src="/upload/blog/image/<?= $row->thumbnail ?>" />
                            </div>
                        </div>
                    </article>
                    <div class="clearfix"></div>
                    <br>
                <?php endwhile; ?>

                <?php
                $count = $article->fetch_articles_count();
                if ($count) {
                    ?>
                    <div class="col-xs-12 text-center page-selector"><br/>
                        <p class="alert alert-info">مجموع صفحات : <b><?= $count ?></b></p>
                        <nav>
                            <ol class="pagination pagination-sm">

                                <?php if ($article->pagination_current != 1) : ?>
                                    <li><a href="/p/<?= $article->pagination_current - 1 ?>" aria-label="Previous">&raquo;</a></li>
                                <?php endif; ?>
                                <?php
                                if (($article->pagination_current - 4) < 0) {
                                    $i = 0;
                                } else {
                                    $i = ($article->pagination_current - 4);
                                }
                                if (($article->pagination_current + 3) > $count) {
                                    $limit = $count;
                                } else {
                                    $limit = ($article->pagination_current + 3);
                                }

                                for ($i; $i < $limit; $i = $i + 1) {
                                    if (($i + 1) == $article->pagination_current) {
                                        echo '<li class="active"><a href="/p/' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
                                    } else {
                                        echo '<li><a href="/p/' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
                                    }
                                }
                                if ($article->pagination_current != $count) {
                                    echo '<li><a href="/p/' . ($article->pagination_current + 1) . '" aria-label="Next">&laquo;</a></li>';
                                }
                                ?>
                            <?php } ?>
                        </ol>
                    </nav><br/>
                </div>
            <?php else: ?>
                    <article class="article-box col-xs-12">
                        <div class="col-xs-12" style="padding: 0px;">
                            <h3 class="text-center" style="padding: 0px; margin: 0px; padding: 10px 0px; color: #ac2925;">مقاله ای وجود ندارد</h3>
                        </div>
                    </article>
            <?php endif; ?>

            <div class="clearfix"></div>

        </div>
    </div>
</div>