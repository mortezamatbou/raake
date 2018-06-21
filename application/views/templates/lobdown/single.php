<?php $article = get_instance_article(); ?>

<div id="wrapper" class="container col-lg-12 col-lg-push-0 col-md-12 col-md-push-0 col-sm-10 col-sm-push-1 col-xs-12 col-xs-push-0">
    <div id="main" class="row">
        <div class="col-lg-2 col-lg-push-0 col-md-2 col-md-push-0 col-sm-3 col-sm-push-0 col-xs-10 col-xs-push-1 text-center right-sidebar" >
            <?php get_sidebar() ?>
        </div>
        <div id="tutorial-list" class="col-lg-2 col-lg-push-0 col-md-2 col-md-push-0 col-sm-10 col-sm-push-1 col-xs-12 col-xs-push-0">
            <?php get_tutorial_list(); ?>
        </div>

        <div id="articles-single" class="col-lg-8 col-md-8 col-sm-9 col-xs-12">

            <article>
                <div class="article-title">
                    <a href="/<?= $article->id . '/' . str_replace(' ', '-', $article->title) . ''; ?>"><?= $article->title; ?></a>
                </div>
                <p class="article-details">
                    <span><i class="fa fa-pencil"></i> <?= $article->author; ?></span> &nbsp <br>
                    <span><i class="fa fa-calendar"></i> <span class="persian-num"><?= $article->date; ?></span></span> &nbsp <br>
                    <span><i class="fa fa-eye"></i> <span class="persian-num"><?= $article->view + 1; ?></span></span> &nbsp <br>
                    <span><i class="fa fa-bolt"></i> <?= $article->category; ?></span> &nbsp <br> <br>
                </p>
                <div class="article-content">

                    <div style="text-align: center; margin-bottom: 10px;">
                        <img id="article-thumbnail" class="img img-responsive" src="/upload/blog/image/<?= $article->thumbnail ?>" alt="<?= $article->title; ?>" title="<?= $article->title; ?>" />
                    </div>

                    <?= $article->body; ?>

                    <div class="clearfix"></div>

                </div>
                <hr>
                <div class="article-tags"><i class="fa fa-tags"></i> تگ ها: <?= $article->echo_tags() ?></div>
                <hr>
                <div class="col-lg-12 col-lg-push-0">
                    <i class="fa fa-share-alt"></i> به اشتراک بگذارید
                </div>
                <br>
                <div class="article-share">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url() . '/' . $article->id ?>"><img style="width: 100%" src="/upload/site/image/social/facebook.png" alt="فیس نما" title="اشتراک مطلب در شبکه اجتماعی فیسبوک" ></a> &nbsp;
                    <a target="_blank" href="https://digg.com/submit?url=<?= base_url() . '/' . $article->id; ?>"><img style="width: 100%" src="/upload/site/image/social/digg.png" alt="فیس نما" title="اشتراک مطلب در شبکه اجتماعی دیگ" ></a> &nbsp;

                    <a target="_blank" href="https://twitter.com/intent/tweet?text=<?= $article->title ?>&url=<?= base_url() . '/' . $article->id; ?>"><img style="width: 100%" src="/upload/site/image/social/twitter.png" alt="فیس نما" title="اشتراک مطلب در شبکه اجتماعی توئیتر" ></a> &nbsp;
                    <a target="_blank" href="https://plus.google.com/share?url=<?= base_url() . '/' . $article->id ?>"><img style="width: 100%" src="/upload/site/image/social/googleplus.png" alt="فیس نما" title="اشتراک مطلب در شبکه اجتماعی گوگل پلاس" ></a> &nbsp;
                    <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= base_url() . '/' . $article->id ?>"><img style="width: 100%" src="/upload/site/image/social/linkedin.png" alt="فیس نما" title="اشتراک مطلب در شبکه اجتماعی لینکدین" ></a> &nbsp;
                    <a target="_blank" href="https://telegram.me/share/url?url=<?= base_url() . '/' . $article->id ?>"><img style="width: 100%" src="/upload/site/image/social/telegram.png" alt="فیس نما" title="اشتراک مطلب در شبکه اجتماعی تلگرام" ></a> &nbsp;
                    <a target="_blank" href="whatsapp://send?text=<?= $article->title ?> - <?= base_url() . '/' . $article->id ?>"><img style="width: 100%" src="/upload/site/image/social/whatsapp.png" alt="فیس نما" title="اشتراک مطلب در شبکه اجتماعی واتس اپ" ></a> &nbsp;

                    <a target="_blank" href="http://www.cloob.com/share/link/add?url=<?= base_url() . '/' . $article->id ?>&title=<?= $article->title . ''; ?>"><img style="width: 100%" src="/upload/site/image/social/cloob.png" alt="کلوب" title="اشتراک مطلب در شبکه اجتماعی کلوب" ></a> &nbsp;
                    <a target="_blank" href="http://www.facenama.com/links/?url=<?= base_url() . '/' . $article->id ?>&title=<?= $article->title ?>"><img style="width: 100%" src="/upload/site/image/social/facenama.png" alt="فیس نما" title="اشتراک مطلب در شبکه اجتماعی فیس نما" ></a> &nbsp;

                </div>
                <hr>
                <div class="related-post">

                    <div class="col-xs-12">
                        <h4><i class="fa fa-recycle"></i> مطالب مرتبط</h4>
                    </div>
                    <div class="clearfix"></div>
                    <?php $related = $article->get_related(); ?>

                    <div class="col-xs-12">
                        <?php if ($related): ?>
                            <?php foreach ($related as $row) : ?>
                                <p><i class="fa fa-check"></i> &nbsp; <a href="/<?= $row->url ?>"><?= $row->title ?></a></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p><i class="fa fa-lock"></i> مقاله مشابهی وجود ندارد</p>
                        <?php endif; ?>
                    </div>

                    <div class="clearfix"></div>
                    <br>
                </div>

            </article>
            <div class="clearfix"></div>
            <div class="comment-box col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="comment-box-title"><i class="fa fa-comments-o fa-2x"></i> دیدگاه کاربران</div>
                <hr>
                <div class="comment-items col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <?php get_comments($article); ?>

                </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="comment-release col-xs-12">
                <div class="comment-release-title"><i class="fa fa-commenting fa-2x"></i> دیدگاهی ارسال کنید</div>
                <div class="clearfix"></div>
                <hr>

                <div class="comment-release-content">
                    <p><i class="fa fa-hand-o-up"></i>&nbsp; نظر شما پس از <b>تایید نویسند</b>ه نمایش داده می شود</p>
                    <p><i class="fa fa-hand-o-up"></i>&nbsp; نظرات به صورت <b>فینگلیش</b> تایید و جواب داده نمی شوند</p>
                    <p><i class="fa fa-hand-o-up"></i>&nbsp; برای وارد کردن <b>کد برنامه نویسی</b> متن بالای تکست باکس را مطالعه فرمایید</p>
                    <p><i class="fa fa-hand-o-up"></i>&nbsp; گزینه <b>captcha</b> برای تشخیص انسان از ربات را حتما <b>قبل از ارسال</b> انتخاب کنید</p>
                    <p><i class="fa fa-hand-o-up"></i>&nbsp; <b>ایمیل</b> شما در سایت <b>منتشر نمی شود</b></p>
                    <p><i class="fa fa-hand-o-up"></i>&nbsp; پر کردن فیلد های <b>ستاره دار الزامی</b> می باشد</p>

                    <table style="width: 100%;  text-align: center;" >
                        <input type="hidden" id="articlec" name="articlec" value="<?= $article->id ?>">
                        <tr>

                            <td class="first-col">نام *</td>
                            <td><input class="form-control" type="text" id="authorc" maxlength="50" /></td>
                        </tr>
                        <tr>
                            <td class="first-col">ایمیل *</td>
                            <td><input style="direction: ltr;" class="form-control" type="text" id="emailc" maxlength="150" placeholder="example : info@it3du.ir" /></td>
                        </tr>
                        <tr>
                            <td class="first-col">وب سایت</td>
                            <td><input style="direction: ltr;" class="form-control" type="text" id="sitec" maxlength="100" placeholder="example : http://www.it3du.ir" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: right; color: red;"><br>
                                <p>استفاده از کد HTML مجاز <b>نمی باشد</b></p>
                                <p>متن های انتخاب شده را می توانید با دکمه p به پاراگراف تبدیل کنید</p>
                                <p>برای وارد کردن کد برنامه نویسی ابتدا متن مورد نظرتان را انتخاب کنید و سپس زبان مورد نظر خودتان را از طریق دکمه ها انتخاب کنید</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="first-col">محتوای دیدگاه *</td>
                            <td>
                                <div id="comment-text-box">
                                    <div id="comment-text-bar">
                                        <select>
                                            <option onclick="setTags('<b>', '</b>')">bold</option>
                                            <option onclick="setTags('<i>', '</i>')">italic</option>
                                            <option onclick="setTags('<u>', '</u>')">underline</option>
                                            <option onclick="setTags('<p>', '</p>')">p</option>
                                            <option onclick="setTags('<pre $j><code>', '</code></pre>')">java</option>
                                            <option onclick="setTags('<pre $css><code>', '</code></pre>')">css</option>
                                            <option onclick="setTags('<pre $c><code>', '</code></pre>')">c</option>
                                            <option onclick="setTags('<pre $p><code>', '</code></pre>')">php</option>
                                            <option onclick="setTags('<pre $h><code>', '</code></pre>')">hypertext</option>
                                            <option onclick="setTags('<pre $r><code>', '</code></pre>')">ruby</option>
                                            <option onclick="setTags('<pre $py><code>', '</code></pre>')">python</option>
                                            <option onclick="setTags('<pre $cs><code>', '</code></pre>')">c#</option>
                                            <option onclick="setTags('<pre $cp><code>', '</code></pre>')">c++</option>
                                            <option onclick="setTags('<pre $js><code>', '</code></pre>')">javascript</option>
                                        </select>
                                        <button style="margin: 5px;" class="btn btn-danger btn-xs" onclick="set()">نمایش خروجی</button>
                                        <div class="clearfix"></div><br>
                                    </div>
                                    <textarea id="comment-text" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="first-col">خروجی کامنت</td>
                            <td><div style="width: 98%; margin: 5px;background-color: rgba(0,0,0, .02);padding: 5px; border: 1px solid rgba(0,0,0, .1); text-align: right;" id="result-comment">&nbsp;</div></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div id="g-recaptcha-response" class="g-recaptcha" data-sitekey="<?php echo GSITE_KEY; ?>"></div></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;"><button id="submit-comment" class="btn btn-success">ارسال<i style="display: none;" id="comment-loading" class='fa fa-spin fa-spinner'></i></button></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="clearfix"></div>
            <br/>
        </div>
        <script type="text/javascript">
            content = document.getElementById('comment-text');
            function getSelectionStart() {
                return content.selectionStart;
            }
            function getSelectionEnd() {
                return content.selectionEnd;
            }
            function getResult() {
                alert(document.getElementById('result').innerHTML);
            }
            function set() {
                var mainContent = document.getElementById('comment-text').value;
                mainContent = mainContent.replace(/\$j/gi, 'style="direction: ltr;" class="language-java"');
                mainContent = mainContent.replace(/\$css/gi, 'style="direction: ltr;" class="language-css"');
                mainContent = mainContent.replace(/\$p/gi, 'style="direction: ltr;" class="language-php"');
                mainContent = mainContent.replace(/\$c/gi, 'style="direction: ltr;" class="language-c"');
                mainContent = mainContent.replace(/\$h/gi, 'style="direction: ltr;" class="language-markup"');
                mainContent = mainContent.replace(/\$js/gi, 'style="direction: ltr;" class="language-javascript"');
                mainContent = mainContent.replace(/\$cs/gi, 'style="direction: ltr;" class="language-csharp"');
                mainContent = mainContent.replace(/\$c/gi, 'style="direction: ltr;" class="language-c"');
                mainContent = mainContent.replace(/\$cp/gi, 'style="direction: ltr;" class="language-cpp"');
                mainContent = mainContent.replace(/\$py/gi, 'style="direction: ltr;" class="language-python"');
                document.getElementById('result-comment').innerHTML = mainContent;
                document.getElementById('comment-text').innerHTML = mainContent;
            }

            function setTags(stag, etag) {
                var contentv = document.getElementById('comment-text');
                s = getSelectionStart();
                e = getSelectionEnd();
                start = contentv.value.substr(0, getSelectionStart());
                selection = contentv.value.substr(getSelectionStart(), getSelectionEnd() - getSelectionStart());
                after = contentv.value.substr(getSelectionEnd());
                contentv.value = start + stag + selection + etag + after;
                set();
                document.getElementById('content').focus();
                content.selectionEnd = e + 7;
            }
            function getc() {
                alert(document.getElementById('result-comment').innerHTML);
            }
            function getOffset() {
                alert('selection start : ' + content.selectionStart + ' ||| selection end : ' + content.selectionEnd);
            }

            function clearForm() {
                content.value = '';
            }
            function fillForm() {
                content.value = 'این اولین تجربه برنامه نویسی جاوا اسکریپت من برای نوشتن یک <b>ادیتور</b> ساده است.';
            }

            $(document).ready(function () {
                $("#submit-comment").on('click', function () {

                    
                        if ($("#authorc").val() !== "" && $("#emailc").val() !== "" && $("#comment-text").val() !== "") {
                            $("#comment-loading").show();
                            set();
                            c = $("#result-comment").html();
                            a = $("#authorc").val();
                            s = $("#sitec").val();
                            e = $("#emailc").val();
                            rc = $("#g-recaptcha-response").val();
                            p = $("#articlec").val();
                            $.ajax({
                                url: "/comment/add/to/article",
                                type: "POST",
                                data: {
                                    author: a,
                                    comment: c,
                                    site: s,
                                    email: e,
                                    recaptcha: rc,
                                    article: p
                                },
                                success: function (result) {
                                    $("#comment-loading").hide();
                                    data = JSON.parse(result);
                                    if (data.status == 200) {
                                        $("#g-recaptcha-response").fadeOut(500);
                                        $("#submit-comment").fadeOut(50);
                                    }
                                    alert(data.message);
                                }
                            });
                        } else {
                            alert("فیلد های الزامی را پر کنید.");
                        }
                    
                    $("#comment-loading").hide();
                });
            });</script>




    </div>
</div>
<div class="clearfix"></div>
<br/>