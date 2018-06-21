<?php

if (!defined('BASEPATH')) {
    exit('exit from this controller');
}

class Tag extends CI_Controller {

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
            $t = strip_tags(urldecode(trim($this->uri->segment(2)))); // mohtavaye tag ba karakter -
            $name = str_replace('-', ' ', $t); // mohtavaye tag bedune karakter -
            if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
                $page = strip_tags($this->uri->segment(3));
            }

            $tag = $this->main_model->get_tag_id($name);
            if ($tag) {
                $info = array(
                    'title' => 'تگ ' . $name,
                    'description' => $tag->tags_description,
                    'keywords' => $tag->tags_keywords,
                    'thumbnail' => base_url() . 'upload/site/image/logo.jpg',
                    'url' => base_url() . 'tag/' . $t
                );
                $header['info'] = $info;
                $this->article->pagination_current = $page;
                $this->article->tag_count = $this->main_model->get_tag_articles_count($tag->tags_id);

                $tags = $this->main_model->get_tag_articles($tag->tags_id, $page);

                $this->article->init($tags, TRUE);

                $data['name'] = $name;
                $this->load->view(BLOG_TEMPLATE_DIR . 'header', $header);
                $this->load->view(BLOG_TEMPLATE_DIR . 'tag', $data);
                $this->load->view(BLOG_TEMPLATE_DIR . 'footer');
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

}
