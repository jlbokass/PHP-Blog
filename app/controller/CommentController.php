<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 01/02/2019
 * Time: 06:37
 */

namespace App\Controller;

use App\Manager\CommentManager;
use Core\View;

/**
 * Class CommentController
 * @package App\Controller
 */
class CommentController extends AuthenticatedController
{
    /**
     *
     */
    public function createAction()
    {
        $comments = new CommentManager($_POST);

        if ($comments->save()) {
            $this->redirect('/comment/comment-request');
        } else {
            View::renderTemplate('/Post/single.html;twig', [
                'comment' => $comments
            ]);
        }
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function commentRequestAction()
    {
        View::renderTemplate('/Posts/comment_request.html.twig');
    }
}
