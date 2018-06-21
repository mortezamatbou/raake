<?php

function &get_instance_article() {
    return Article::get_instance();
}

/**
 * return singleton object of MainModel class
 * @return object MainModel
 */
function &get_instance_main_model() {
    return MainModel::get_instance();
}

function get_sidebar() {
    get_instance()->load->view(BLOG_TEMPLATE_DIR . 'sidebar');
}

function get_tutorial_list() {
    $article = get_instance_article();
    if ($article->is_tutorial) {
        get_instance()->load->view(BLOG_TEMPLATE_DIR . 'tutorial_items', array('query' => get_instance_main_model()->get_tutorial_item($article->is_tutorial)));
    } else {
        get_instance()->load->view(BLOG_TEMPLATE_DIR . 'tutorial_lists', array('query' => get_instance_main_model()->get_tutorial_list()));
    }
}

function get_comments() {
    get_instance()->load->view(BLOG_TEMPLATE_DIR . 'comment', ['article' => get_instance_article()]);
}

