<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 01/02/2019
 * Time: 21:48
 */

namespace App\Model;


namespace App\Controllers\Admin;

use \Core\View;
use \App\Models\Blog;
use \App\Flash;

class Article extends \Core\Controller {
    protected function before() {
        $this->requireLogin();
    }

    public function newAction() {
        View::renderTemplate('Admin/newArticle.html');
    }

    public function indexAction() {
        $blog = Blog::getAllArticlesAdmin();
        View::renderTemplate('Admin/article.html', [
            'blog' => $blog
        ]);
    }

    public function showAction() {
        View::renderTemplate('Article/show.html', [
            'blog' => Blog::findByArticleTitle($this->route_params['title'])
        ]);
    }

    public function editAction() {
        View::renderTemplate('Admin/editArticle.html', [
            'blog' => Blog::findByArticleTitle($this->route_params['title'])
        ]);
    }

    public function updateAction() {
        $blog = Blog::findByArticleTitle($this->route_params['title']);
        if($blog->updateArticle($_POST)) {
            Flash::addMessage('Article Successfully Updated');
            $this->redirect('/admin/article/index');
        } else {
            View::renderTemplate('Admin/editArticle.html', [
                'blog' => $blog
            ]);
        }
    }

    public function createAction() {
        $blog = new Blog($_POST);

        if ($blog->save()) {
            $this->redirect('/admin/success');
        } else {
            View::renderTemplate('Admin/newArticle.html', [
                'blog' => $blog
            ]);
        }
    }

    public function successAction() {
        View::renderTemplate('Admin/successArticle.html');
    }

    public function validateTitleAction() {
        $is_valid = ! Blog::articleExists($_GET['article_title'], $_GET['ignore_id'] ?? null);

        header('Content-Type: application/json');
        echo json_encode($is_valid);
    }
}