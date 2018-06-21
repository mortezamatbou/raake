<?php

if (!defined('BASEPATH')) {
    exit('exit from this controller ERR4452');
}

class Category extends CI_Controller {

    public $main_model;
    public $article;

    function __construct() {
        parent::__construct();
        $this->load->model(BLOG_MODELS_DIR . 'MainModel');
        $this->load->library(BLOG_LIBRARIES_DIR . 'Article');
        $this->main_model = new MainModel();
        $this->article = new Article();
    }

    function index() {
        if ($this->uri->segment(1) && $this->uri->segment(2)) {
            $page = 1;
            if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
                $page = strip_tags($this->uri->segment(3));
            }
            $cat_name = strip_tags(urldecode(trim($this->uri->segment(2))));
            $name = str_replace('-', ' ', $cat_name);

            // $check is database record
            $category = $this->main_model->get_cat($name);
            if (!$category) {
                show_404();
            }
            $this->article->category_count = $this->main_model->get_category_count($category->category_id);
            $info = array(
                'id' => '0',
                'title' => 'دسته بندی ' . $name,
                'description' => $category->category_description,
                'keywords' => $category->category_keywords,
                'thumbnail' => base_url() . 'site/image/logo.jpg',
                'url' => base_url() . 'tutorials/' . $name
            );
            $header['info'] = $info;
            $articles = $this->main_model->get_category_articles($category->category_id, $name, $page);
            $data = [
                'name' => $name
            ];
            $this->article->init($articles, TRUE);
            $this->load->view(BLOG_TEMPLATE_DIR . 'header', $header);
            $this->load->view(BLOG_TEMPLATE_DIR . 'category', $data);
            $this->load->view(BLOG_TEMPLATE_DIR . 'footer');
        } else {
            show_404();
        }
    }

}
