<?php

if (!defined('BASEPATH')) {
    exit('exit from this controller');
}

class Tutorials extends CI_Controller {

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
            $t = urldecode(strip_tags(trim($this->uri->segment(2))));
            $name = str_replace('-', ' ', $t);
            $tutorial = $this->main_model->get_tutorial_id_by_name($name);
            if ($tutorial) {
                $data['name'] = $tutorial->tutorials_name;
                $data['title'] = $tutorial->tutorials_title;

                $info = array(
                    'title' => $tutorial->tutorials_title,
                    'description' => $tutorial->tutorials_description,
                    'keywords' => $tutorial->tutorials_keywords,
                    'thumbnail' => base_url() . 'upload/site/image/tutorials/' . $tutorial->tutorials_name . '.png',
                    'url' => base_url() . 'tutorials/' . $t
                );
                $header['info'] = $info;
                
                
                $article = $this->main_model->get_tutorial_item($tutorial->tutorials_id);
                $this->article->init($article, TRUE);

                $this->load->view( BLOG_TEMPLATE_DIR . 'header', $header);
                $this->load->view( BLOG_TEMPLATE_DIR . 'tutorial', $data);
                $this->load->view( BLOG_TEMPLATE_DIR . 'footer');
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

}
