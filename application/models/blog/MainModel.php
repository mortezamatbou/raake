<?php

class MainModel extends CI_Model {

    private static $instance = NULL;

    function __construct() {
        parent::__construct();
        self::$instance = & $this;
    }

    public static function &get_instance() {
        return self::$instance;
    }

    public function is_article($id, $title = '') {
        if ($id && $title) {
            $this->db->where("article_id = '$id' AND article_title = '$title' AND article_status = '1'");
        } else if ($id) {
            $this->db->where("article_id = '$id' AND article_status = '1'");
        } else {
            return FALSE;
        }
        $query = $this->db->get('articles');
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return FALSE;
    }

    public function is_tutorial($id) {
        $query = $this->db->where('article_id', $id)->get("tutorial_item");
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->tutorials_id;
        } else {
            return FALSE;
        }
    }

    public function get_tutorial_id_by_name($tutorials_name) {
        $query = $this->db->where('tutorials_name', $tutorials_name)->get('tutorials');
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return FALSE;
    }

    public function get_tutorial_list() {
        $sql = 'SELECT * FROM tutorials ' .
                'WHERE EXISTS (SELECT * FROM tutorial_item INNER JOIN articles ' .
                'ON tutorial_item.article_id = articles.article_id AND articles.article_status = "1")';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    public function get_tutorial_item($tutorials_id) {
        $sql = "SELECT * FROM articles as a WHERE " .
                "EXISTS(SELECT * FROM tutorial_item as i WHERE a.article_id = i.article_id AND i.tutorials_id = '$tutorials_id' AND a.article_status = '1')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    public function get_related_article($article_id) {
        $result = $this->get_tags_id($article_id);
        if (is_array($result)) {
            foreach ($result as $aid) {
                $query = $this->db->where("article_id = '$aid' AND article_status = '1'")->get('articles');
                if ($query->num_rows() > 0) {
                    return $query->result();
                }
            }
        }
        return FALSE;
    }

    private function get_tags_id($article_id) {
        $this->db->where('article_id', $article_id);
        $query = $this->db->get('tag');
        if ($query->num_rows()) {
            $result = NULL;
            foreach ($query->result() as $t) {
                $this->db->where("tags_id = '{$t->tags_id}' AND article_id != '{$article_id}'");
                $related_post = $this->db->get('tag');
                if ($related_post->num_rows() > 0) {
                    foreach ($related_post->result() as $id) {
                        $check = $this->id_check($id->article_id, $result);
                        if ($check == -1) {
                            $result[] = $id->article_id;
                        }
                    }
                }
            }
            return $result;
        }
        return FALSE;
    }

    public function article_inc($id) {
        $this->db->where("article_id = '$id' AND article_status = '1'");
        $query = $this->db->get('articles');
        if ($query->num_rows() > 0) {
            $result = $query->row();
            $view = intval($result->article_view);
            $new_view = $view + 1;
            $this->db->where('article_id', $id)->update('articles', array('article_view' => $new_view));
        }
    }

    function get_categorys() {
        $sql = 'SELECT * FROM category as c WHERE EXISTS ' .
                ' (SELECT * FROM articles as a WHERE a.article_category = c.category_id AND a.article_status = "1")';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $category = array();
            foreach ($query->result() as $row) {
                $obj = (object) array(
                            'url' => 'category/' . str_replace(' ', '-', $row->category_title),
                            'title' => $row->category_title,
                            'description' => $row->category_description,
                            'count' => $this->get_category_count($row->category_id)
                );
                array_push($category, $obj);
            }
            return $category;
        }
        return FALSE;
    }

    public function get_category_count($category_id) {
        $this->db->where("article_category = '$category_id' AND article_status = '1'");
        $query = $this->db->get('articles');
        return $query->num_rows();
    }

    public function get_last_article($count) {
        $this->db->where('article_status', '1');
        $this->db->order_by('article_date', 'DESC');
        $this->db->limit($count);
        $query = $this->db->get('articles');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    function get_popular_article($count = 10) {
        $this->db->where('article_status', '1');
        $this->db->order_by('article_view', 'DESC');
        $this->db->limit($count);
        $query = $this->db->get('articles');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    public function get_cat($category_title) {
        $this->db->where('category_title', $category_title);
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    public function get_articles_count() {
        $this->db->where('article_status', '1');
        $this->db->select('article_id');
        $this->db->from('articles');
        $count = $this->db->get();
        if ($count->num_rows() > 0) {
            return ceil($count->num_rows() / PER_PAGE);
        }
        return 0;
    }

    public function get_category_articles($id, $name, $page = 1) {
        $def_count = PER_PAGE_CATEGORY;
        $count = $this->db->query("SELECT COUNT(article_category) as ccount FROM articles WHERE article_category = '$id' AND article_status = '1'");
        $num_pages = ceil($count->row()->ccount / $def_count);


        if ($page == 1) {
            $sql = "SELECT * FROM articles WHERE article_category = '$id' AND article_status = '1' ORDER BY article_date DESC LIMIT 0, $def_count";
        } else {
            if ($page < 0) {
                $page = $page * -1;
            }
            $start = ($page - 1) * $def_count;
            $sql = "SELECT * FROM articles WHERE article_category = '$id' AND article_status = '1' ORDER BY article_date DESC LIMIT $start, $def_count";
        }
        get_instance_article()->pagination_page = $num_pages;
        get_instance_article()->pagination_current = $page;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    public function get_author($author_id) {
        $author = strip_tags($author_id);
        $this->db->where("author_id = '$author' AND author_status = '1'");
        $query = $this->db->get('author');
        if ($query->num_rows() > 0) {
            return $query->row()->author_fullname;
        }
        return 'مدیر';
    }

    private function get_content($id) {
        $this->db->where("article_id = '$id' AND article_status = '1'");
        $query = $this->db->get('articles');
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->article_content;
        }
    }

    public function get_article_index($page = 1) {
        $def_count = PER_PAGE;
        $count = $this->db->query('SELECT COUNT(article_id) as acount FROM articles WHERE article_status = "1"');
        $num_pages = ceil($count->row()->acount / $def_count);
        if ($page > $num_pages) {
            return FALSE;
        }
        if ($page == 1) {
            $sql = 'SELECT * FROM articles WHERE article_status = "1" ORDER BY article_date DESC LIMIT 0,' . $def_count;
        } else {
            if ($page < 0) {
                $page = $page * -1;
            }
            $start = ($page - 1) * $def_count;
            $sql = 'SELECT * FROM articles WHERE article_status = "1" ORDER BY article_date DESC LIMIT ' . $start . ',' . $def_count;
        }
        $query = $this->db->query($sql);


        if ($query->num_rows() > 0) {
            return array(
                'articles' => $query->result(),
                'count' => $count->row()->acount,
                'def_count' => $def_count,
                'page' => $page,
                'num_pages' => $num_pages
            );
        }
        return FALSE;
    }

    public function get_comment_count($id) {
        $this->db->where("article_id = '$id' AND comment_status = '1'")->select('article_id')->from('comment');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    public function get_category($category_id) {
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            return $query->row()->category_title;
        }
        return FALSE;
    }

    public function get_tags($t) {
        if (!empty($t)) {
            $this->db->where('article_id', $t);
            $query = $this->db->get('tag');
            if ($query->num_rows() > 0) {
                $tag = array();
                $i = 0;
                foreach ($query->result() as $result) {
                    $title = $this->get_tag_title($result->tags_id);
                    $tag[$result->tags_id] = $title;
                }
                return $tag;
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }

    public function get_tag_title($ti) {
        $this->db->where('tags_id', $ti);
        $query = $this->db->get('tags');
        if ($query->num_rows() > 0) {
            return $query->row()->tags_title;
        }
        return FALSE;
    }

    private function id_check($id, $result) {
        if (empty($result)) {
            return -1;
        }
        foreach ($result as $v) {
            if ($v == $id) {
                return 1;
            }
        }
        return -1;
    }

    function get_comments($article_id) {
        $this->db->where("article_id = '$article_id' AND comment_status = '1'");
        $this->db->order_by('comment_date', 'ASC');
        $query = $this->db->get('comment');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }
    
    public function get_tag_id($title) {
        $this->db->where('tags_title', $title);
        $query = $this->db->get('tags');
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }
    
    public function get_tag_articles($tags_id, $page = 1) {
        $def_count = PER_PAGE_TAG;
        $count = $this->db->where('tags_id', $tags_id)->get('tag')->num_rows();
        if ($count) {
            $num_pages = ceil($count / $def_count);
            if ($page > $num_pages || $page < 0) {
                show_404();
            }
            if ($page == 1) {
                $sql = "SELECT * FROM articles as a WHERE EXISTS(SELECT * FROM tag as t WHERE a.article_id = t.article_id AND t.tags_id = '$tags_id') LIMIT 0, $def_count";
            } else {
                $start = ($page - 1) * $def_count;
                $sql = "SELECT * FROM articles as a WHERE EXISTS(SELECT * FROM tag as t WHERE a.article_id = t.article_id AND t.tags_id = '$tags_id') LIMIT $start, $def_count";
            }
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
                return $query->result();
            }
            return FALSE;
        }

        return FALSE;
    }

    public function get_tag_articles_count($tags_id, $article_id = '') {
        if ($article_id) {
            return $this->db->where("tags_id = '$tags_id' AND article_id = '$article_id'")->get('tag')->num_rows();
        }
        return $this->db->where('tags_id', $tags_id)->get('tag')->num_rows();
    }

    
    function insert_comment($data) {
        date_default_timezone_set("Asia/Tehran");
        $ip = $this->input->ip_address();
        $date = date('Y:m:d H:i:s');
        $data['comment_ip'] = $ip;
        $data['comment_date'] = $date;
        $this->db->insert('comment', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_tag_link($tags) {
        $tag_arr = explode(',', $tags);
        $count = count($tag_arr);
        $i = 1;
        foreach ($tag_arr as $t) {
            $t = trim($t);
            $t = ltrim($t);
            $t = rtrim($t);
            $turl = str_replace(' ', '-', $t);
            if ($i < $count) {
                $i = $i + 1;
                $tag = "<a href='" . SITE_PATH_ESS . "/tag/" . $turl . "/'>$t</a> |  ";
            } else {
                $tag = "<a href='" . SITE_PATH_ESS . "/tag/" . $turl . "/'>$t</a>";
            }
            echo $tag;
        }
    }

}
