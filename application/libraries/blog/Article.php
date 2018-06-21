<?php

class Article {

    private static $instance = NULL;

    /**     * ********************************** */
    public $id;
    public $title;
    public $body;
    public $description;
	public $keywords;
    public $date;
    public $view;
    public $thumbnail;
    public $status;
    public $last_modified;
    public $comment_count;

    /**     * ********************************** */
    public $category_id;
    public $category;
    public $author_id;
    public $author;
    public $tags;
    
    public $tutorial_id;
    public $tutorial_title;

    /**     * ********************************** */
    public $current = 0;
    public $multi = FALSE;
    public $article = array();
    public $currrent_article = NULL;
    public $count = 0;
    public $is_tutorial = FALSE;
    public $have_article = FALSE;
    
    public $category_count = 0;
    public $index_count = 0;
    public $tag_count = 0;
    
    public $pagination_page = 0;
    public $pagination_current = 0;
    

    /**     * ********************************** */
    function __construct() {
        self::$instance =& $this;
    }

    function get_author_id() {
        return $this->author_id;
    }

    function get_author() {
        return $this->author;
    }

    function get_category_id() {
        return $this->category_id;
    }

    function get_category() {
        return $this->category;
    }

    function get_tags() {
        return $this->tags;
    }

    /**     * ********************************* *********************************** */
    function init($article, $multi = FALSE) {
        if (!empty($article)) {
            $this->multi = $multi;
            if ($multi) {
                $this->multi_init($article);
            } else {
                $this->single_init($article);
            }
        }
    }
    
    public function fetch_articles_count() {
        return get_instance_main_model()->get_articles_count();
    }

    private function single_init($article) {
        $this->id = $article->article_id;
        $this->title = $article->article_title;
        $this->body = $article->article_content;
        $this->description = $article->article_precontent;
        $this->keywords = $article->article_keywords;
        $this->date = $article->article_date;
        $this->category_id = $article->article_category;
        $this->view = $article->article_view;
        $this->thumbnail = $article->article_thumbnail;
        $this->status = $article->article_status;
        $this->modified = $article->article_last_modified;
        $this->author_id = $article->article_author;
        
        $this->category_id = $article->article_category;
        $this->category    = $this->fetch_article_category($article->article_category);
        $this->comment_count = $this->fetch_comment_count($article->article_id);
        
        $this->author = $this->fetch_article_author($article->article_author);
        
        $this->tags = $this->fetch_article_tags($article->article_id);
        $this->is_tutorial = $this->is_tutorial($this->id);
        $this->have_article = TRUE;
    }

    private function multi_init($article) {
        $this->count = count($article);
        foreach ($article as $an) {
            $obj = (object) array(
                'article_id'                 => $an->article_id,
                'article_title'              => $an->article_title,
                'article_content'            => $an->article_content,
                'article_precontent'         => $an->article_precontent,
                'article_date'               => $an->article_date,
                'article_category'           => $an->article_category,
                'article_view'               => $an->article_view,
                'article_thumbnail'          => $an->article_thumbnail,
                'article_status'             => $an->article_status,
                'article_last_modified'      => $an->article_last_modified,
                'article_author'             => $an->article_author,
                'category'                   => $an->article_category,
                'article_keywords'           => $an->article_keywords,
            );
            $is = $this->is_tutorial($an->article_id);
            if ($is) {
                $obj->is_tutorial = TRUE;
                $obj->tutorial_id = $is;
            } else {
                $obj->is_tutorial = FALSE;
                $obj->tutorial_id = NULL;
            }
            array_push($this->article, $obj);
        }
        
        $this->have_article = TRUE;
    }

    public function fetch_article_author($article_author) {
        return get_instance_main_model()->get_author($article_author);
    }

    public function fetch_comment_count($article_id) {
        return get_instance_main_model()->get_comment_count($article_id);
    }

    public function fetch_article_category($article_category) {
        return get_instance_main_model()->get_category($article_category);
    }

    public function fetch_article_tags($article_id) {
        return get_instance_main_model()->get_tags($article_id);
    }

    private function is_tutorial($article_id) {
        return get_instance_main_model()->is_tutorial($article_id);
    }

    function get_related($full = TRUE) {
        $related = get_instance_main_model()->get_related_article($this->id);
        if ($related) {
            $related_article = array();
            foreach ($related as $row) {
                $rel = (object) array();
                $rel->title = $row->article_title;
                $url = $row->article_id . '/' . str_replace(' ', '-', $row->article_title);
                $rel->url = $full ? base_url() . $url : $url;
                array_push($related_article, $rel);
            }
            return $related_article;
        }
        return FALSE;
    }
    
    function comments() {
        $comments = get_instance_main_model()->get_comments($this->id);
        return $comments;
    }
    
    function echo_tags() {
        if (is_array($this->tags)) {
            $tag = '';
            foreach ($this->tags as $tag_id => $tag_title) {
                $tag_url = str_replace(' ', '-', $tag_title);
                $tag .= "<a href='/tag/$tag_url'>$tag_title</a> | ";
            }
            return $tag;
        } else {
            return '<p>تگی برای این مطلب وجود ندارد</p>';
        }
    }

    function next() {
        if ($this->multi && $this->current < $this->count) {
            $this->single_init($this->article[$this->current]);
            $this->current++;
            return $this;
        }
        return NULL;
    }

    function get_tag_link() {
        $tag_arr = explode(',', $this->tags);
        $count = count($tag_arr);
        $i = 1;
        foreach ($tag_arr as $t) {
            $t = trim($t);
            $turl = str_replace(' ', '-', $t);
            if ($i < $count) {
                $i = $i + 1;
                $tag = "<a href='/tag/" . $turl . "/'>$t</a> |  ";
            } else {
                $tag = "<a href='/tag/" . $turl . "/'>$t</a>";
            }
            echo $tag;
        }
    }
    
    function get_category_page_count() {
        if ($this->category_count) {
            return ceil($this->category_count/PER_PAGE_CATEGORY);
        }
        return 0;
    }
    function get_article_page_count() {
        if ($this->count) {
            return $this->count;
        }
        return 0;
    }
    function get_tag_page_count() {
        if ($this->tag_count) {
            return ceil($this->tag_count/PER_PAGE_TAG);
        }
        return 0;
    }

    function get_permalink($id = FALSE) {
        if ($id) {
            return base_url() . $this->id;
        }
        return base_url() . $this->id . '/' . str_replace(' ', '-', $this->title);
    }
    
    public static function &get_instance() {
        return self::$instance;
    }

}
