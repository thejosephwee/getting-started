<?php

namespace App;
use Illuminate\Session\Store;

class Post
{
    public function getPosts(store $session)
    {
        if(!$session->has('posts')){
            $this->createDummyData($session);
        }
        return $session->get('posts');
    }

    public function getPost(store $session, $id)
    {
        if(!$session->has('posts')){
            $this->createDummyData($session);
        }
        return $session->get('posts')[$id];
    }

    public function addPost(store $session,$title,$content)
    {
        if(!$session->has('posts')){
            $this->createDummyData($session);
        }
        $posts = $session->get('posts');
        array_push($posts,['title'=>$title,'content'=>$content]);
        $session->put('posts',$posts);
    }

    public function editPost(store $session,$id,$title,$content)
    {
        $posts = $session->get('posts');
        $posts[$id] = ['title' => $title, 'content' => $content];
        $session->put('posts', $posts);
    }

    private function createDummyData(store $session){
        $posts = [
            [
                'title' => 'Learning Laravel',
                'content' => 'This blog post will get you right on track with Laravel!'
            ],
            [
                'title' => 'Something else',
                'content' => 'Some other content'
            ]
        ];
        $session->put('posts',$posts);
    }
}