<?php

namespace App\controller;

use App\model\TweetModel;
class TweetController
{

    private $data = [];

    public function isAjax(){
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest";
    }

    public function redirectToRoute($location = "homeView")
    {
        header('Location: http://localhost:8080/view/' . $location . '.php');
    }

    public function createTweet($id,$tweet){
        $tweetMessage = new TweetModel();
        $tweetMessage->setTweet($id,$tweet);
        
    }

    public function getReply($id){
        $tweets = new TweetModel();
        $tweets = $tweets->getReply($id);
        return $tweets;
    }

    public function createRetweet($id,$retweet,$id_retweet){
        $tweetMessage = new TweetModel();
        $tweetMessage->setRetweet($id,$retweet,$id_retweet);
    }

    public function createReply($id,$reply,$id_reply){
        $replyMessage = new TweetModel();
        $replyMessage->setReply($id,$reply,$id_reply);
    }

    public function tweetLink($msgTweet){
        $linkTweet = preg_replace('/#(\w+)/', '<a href="https://twitter.com/hashtag/$1">#$1</a>', $msgTweet);
        $linkTweet = preg_replace('/@(\w+)/', '<a href="https://twitter.com/arobase/$1">@$1</a>', $linkTweet);
        return $linkTweet;
    }

    public function searchByHashtag($hashtag)
    {
        $tweet=new TweetModel();
        $tweets=$tweet->searchByHashtag(htmlspecialchars($hashtag));
    
        return $tweets;
    }

    public function getTweetsByUserId($id){
        $tweets=new TweetModel();
        $response=$tweets->searchByUserId($id);
        return $response;
    }

}