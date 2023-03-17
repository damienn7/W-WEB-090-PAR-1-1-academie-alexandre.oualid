<?php
namespace App\Controller;

use App\model\MessageModel;

class MessageController{
    public function createMessage($id_user,$id_receiver,$mp){
        $tweetMessage = new MessageModel();
        $tweetMessage->sendMessage($id_user,$id_receiver,$mp);
    }
}