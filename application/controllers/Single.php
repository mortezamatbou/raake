<?php

if (!defined('BASEPATH')) {
    exit('exit from this controller');
}

class Single extends CI_Controller {

    public $main_model;
    public $article;

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model(BLOG_MODELS_DIR . 'MainModel');
        $this->load->library(BLOG_LIBRARIES_DIR . 'Article');
        $this->main_model = new MainModel();
        $this->article = new Article();
    }

    function index() {
        if ($this->uri->segment(1)) {

            $id = strip_tags($this->uri->segment(1));
            $is_article = $this->main_model->is_article($id);

            if (!$is_article) {
                show_404();
            }
            $this->article->init($is_article, FALSE); // false -> single article


            $this->main_model->article_inc($this->article->id);

            $info = array(
                'id' => $this->article->id,
                'title' => $this->article->title,
                'description' => $this->article->description,
                'keywords' => $this->article->keywords,
                'thumbnail' => base_url() . 'blog/image/' . $this->article->thumbnail,
                'url' => $this->article->get_permalink(TRUE) // if param TRUE return article id by id -> http://domain.com/23
                // leave blank param for url in id and title -> http://domain.com/112/whats-php
            );
            $header['info'] = $info;
            $this->load->view(BLOG_TEMPLATE_DIR . 'header', $header);
            $this->load->view(BLOG_TEMPLATE_DIR . 'single');
            $this->load->view(BLOG_TEMPLATE_DIR . 'footer');
        } else {
            show_404();
        }
    }

    function name() {
        if ($this->uri->segment(1) && $this->uri->segment(2)) {
            $id = strip_tags($this->uri->segment(1));
            $title = strip_tags($this->uri->segment(2));

            $i = urldecode($id);
            $t = urldecode($title);
            $tt = str_replace('-', ' ', $t);
            $is_article = $this->main_model->is_article($i, $tt);

            if (!$is_article) {
                show_404();
            }
            $this->article->init($is_article, FALSE); // false -> single article


            $this->main_model->article_inc($this->article->id);

            $info = array(
                'id' => $this->article->id,
                'title' => $this->article->title,
                'description' => $this->article->description,
                'keywords' => $this->article->keywords,
                'thumbnail' => base_url() . 'blog/image/' . $this->article->thumbnail,
                'url' => $this->article->get_permalink() // if param TRUE return article id by id -> http://domain.com/23
                // leave blank param for url in id and title -> http://domain.com/112/whats-php
            );
            $header['info'] = $info;
            $this->load->view(BLOG_TEMPLATE_DIR . 'header', $header);
            $this->load->view(BLOG_TEMPLATE_DIR . 'single');
            $this->load->view(BLOG_TEMPLATE_DIR . 'footer');
        } else {
            show_404();
        }
    }

}
