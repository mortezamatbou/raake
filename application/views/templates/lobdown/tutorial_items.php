<p style="padding: 5px;background-color: rgba(0,200,0, .8); color: white; margin: 0px;">این مقاله جز یک گروه آموزشی می باشد. لیست آموزش ها در زیر هستند</p>

<?php
$i = 0;
$ti = 1;
foreach ($query as $row) {
    if ($i == 0) {
        ?>
        <h4 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="padding-bottom: 10px;">آموزش <?= get_instance_article()->category ?></h4>
        <div class="clearfix"></div>
        <?php $i = $i + 1; ?>
    <?php } ?>

    <div style="" class="tutorial-item col-lg-12 col-md-12 col-sm-3 col-xs-4">
        <div class="clearfix"></div>
        <?php
        $tutorial_name = $row->article_id;
        $tutorial_title = $row->article_title;
        $thumbnail = $row->article_id;
        ?>
        <h5><?= $tutorial_title ?> <span style="color: red; font-size: 10px">قسمت   <?= $ti ?></span></h5>
        <img alt="<?= $tutorial_title ?>" src="/upload/blog/image/<?= $row->article_thumbnail ?>" class="img-responsive" />
        <div class="clearfix"></div>
        <a class="tutorial-link" href="/<?= $row->article_id . '/' . str_replace(' ', '-', $tutorial_title) ?>" title="<?= $tutorial_title ?>"></a>
    </div>
    <?php $ti++; ?>
<?php } ?>