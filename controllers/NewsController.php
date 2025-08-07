<?php
namespace controllers;
use models\Comment;
use models\Post;
use models\User;
use vendor\frame\Controller;

class NewsController extends Controller
{
    public function list(){
        $post = new Post();
        $result = $post->getListNews();
        $pagecount = $post->getCountPage();


        $this->render('news/list', ['posts'=>$result,
            'pagecount'=>$pagecount

        ]);

    }

    public function view( $id){
        $posts = new Post();
        $result = $posts->getByIdNews($id);




        $this->render('news/view', ['models' => $result], 'News view page');
    }

    public function add(){
       if(isset($_POST['submit'])){
           $user = new User();
           $users = $user->getList();
           $comment = new Comment();
           $data = [
               'user_id' => $_POST['user_id'],
               'message' => $_POST['message']
           ];


           $comment->saveCommentNews($data);

           header('location: /news/view/'.$_POST['id']);


       }
        $this->render('news/add', ['comments' => $comment, 'users'=>$users], 'Add news page');
    }

    public function comment($post_id){
        $post = new Post();
        $comment = new Comment();
        $postnews = $post->getById($post_id);
        $commentnews = $comment->getCommentByIdPost($post_id);
        if(isset($_POST['submit'])){
            $data = [
                'post_id' => $_POST['post_id'],
                'user_id' => $_POST['user_id'],
                'message' => $_POST['message']
            ];

        if($comment->addComment($data)){
            header('location: /news/view/'.$_POST['post_id']);
            exit();
        }
        }
        $this->render('news/comment', ['comments' => $commentnews, 'postnews' => $postnews, 'post_id' => $post_id]);
    }


}