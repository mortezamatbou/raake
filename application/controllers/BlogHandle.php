<?php

if (!defined('BASEPATH')) {
    exit('exit from this controller');
}

class BlogHandle extends CI_Controller {

    public $main_model;

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model(BLOG_MODELS_DIR . 'MainModel');
        $this->main_model = new MainModel();
    }

    function add_comment() {
        $comment = strip_tags($this->input->post('comment'));
        $author = strip_tags($this->input->post('author'));
        $site = strip_tags($this->input->post('site'));
        $article_id = strip_tags($this->input->post('article'));
        $email = strip_tags($this->input->post('email'));
        $captcha = strip_tags($this->input->post('recaptcha'));

        if (isset($captcha) && !empty($captcha)) {
            if (isset($article_id) && !empty($article_id) && isset($email) && !empty($email) && isset($comment) && !empty($comment) && isset($author) && !empty($author)) {
                $this->load->helper('it3duadmin/recaptchalib');
                $secret = GSECRET_KEY;
                $response = null;
                $reCaptcha = new ReCaptcha($secret);
                $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $captcha);
                if ($response != null && $response->success) {
                    $data = array(
                        'article_id' => $article_id,
                        'comment_name' => $author,
                        'comment_email' => $email,
                        'comment_content' => $comment,
                        'comment_url' => $site,
                    );
                    if ($this->main_model->insert_comment($data)) {
                        $this->send_data(200);
                    }
                    $this->send_data(400);
                }
                $this->send_data(503);
            }
            $this->send_data(400);
        }
        $this->send_data(503);
    }

    private function send_data($type, $exit = TRUE) {
        $response = array(
            'status' => 404,
            'message' => 'مشکلی در پردازش اطلاعات به وجود آمده است. لطفا بعد از بارگذاری مجدد صفحه دوباره امتحان کنید.',
        );
        switch ($type) {
            case 200:
                $response['status'] = 200;
                $response['message'] = 'پیام شما با موفقیت ارسال شد و پس از بررسی به آن پاسخ داده می شود.';
                break;
            case 503:
                $response['status'] = 503;
                $response['message'] = 'گزینه کپچا باید انتخاب شود. بعد از بررسی مجددا امتحان کنید.';
                break;
            case 400:
                $response['status'] = 400;
                $response['message'] = 'ورودی نا معتبر می باشد. لطفا مجددا امتحان فرمایید.';
                break;
        }
        echo json_encode($response);
        if ($exit) {
            exit;
        }
    }

}
