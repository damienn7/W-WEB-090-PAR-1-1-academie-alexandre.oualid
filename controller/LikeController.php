<?php
namespace App\Controller;

use App\model\LikeModel;

class LikeController
{


    public function getCountOfLikes($id_tweet)
    {
        $count = new LikeModel();
        $count = $count->getLikeCount($id_tweet);

        return $count;
    }


    public function getLikeByIdTweetAndIdUser($id_tweet,$id_user){
        $count = new LikeModel();
        $count = $count->getLikeByIdTweetAndIdUser($id_tweet,$id_user);

        return $count;
    }

    public function setLike($id_tweet,$id_user){
        $count = new LikeModel();
        $count->setLike($id_tweet,$id_user);
    }

    public function deleteLike($id_tweet,$id_user){
        $count = new LikeModel();
        $count->deleteLike($id_tweet,$id_user);
    }



}