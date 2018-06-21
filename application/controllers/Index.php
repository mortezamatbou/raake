<?php

if (!defined('BASEPATH')) {
    exit('exit from this controller');
}

class Index extends CI_Controller {

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
        if ($this->uri->segment(1) && $this->uri->segment(2) && is_numeric($this->uri->segment(2))) {
            $page = trim($this->uri->segment(2));
        } else {
            $page = 1;
        }

        $info = array (
            'description' => 'آموزش برنامه نویسی و طراحی وب, آموزش برنامه نویسی',
            'keywords' => 'آموزش برنامه نویسی,سورس کد برنامه نویسی,آموزش طراحی وب,اخبار فناوری اطلاعات',
            'title' => 'آموزش برنامه نویسی و طراحی وب',
            'thumbnail' => base_url() . 'upload/blog/image/logo.jpg',
            'url' => base_url()
        );
        
        $posts = $this->main_model->get_article_index($page);
        $this->article->init($posts['articles'], TRUE);
        
        $this->article->pagination_page = $page;
        $this->article->pagination_current = $page;
        
        $header['info'] = $info;
        
        $this->load->view(BLOG_TEMPLATE_DIR . 'header', $header);
        $this->load->view(BLOG_TEMPLATE_DIR . 'index');
        $this->load->view(BLOG_TEMPLATE_DIR . 'footer');
    }

}
