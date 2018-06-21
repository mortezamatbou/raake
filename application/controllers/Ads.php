<?php

if (!defined('BASEPATH')) {
    exit('exit from this controller');
}

class Ads extends CI_Controller {

    public $main_model;

    function __construct() {
        parent::__construct();
        $this->load->model(BLOG_MODELS_DIR . 'MainModel');
        $this->main_model = new MainModel();
    }

    function index() {
        $info = array(
            'title' => 'تبلیغات در سایت',
            'description' => 'تبلیغات در وبلاگ. راهکار های افزایش بازدید سایت در تبلیغات',
            'keywords' => 'تبلیغ در سایت برنامه نویسی,برنامه نویسی,تبلیغ بنری در وبلاگ فناوری',
            'thumbnail' => base_url() . 'site/image/logo.jpg',
            'url' => base_url() . 'ads'
        );
        $header['info'] = $info;
        $this->load->view(BLOG_TEMPLATE_DIR . 'header', $header);
        $this->load->view(BLOG_TEMPLATE_DIR . 'ads');
        $this->load->view(BLOG_TEMPLATE_DIR . 'footer');
    }

}
