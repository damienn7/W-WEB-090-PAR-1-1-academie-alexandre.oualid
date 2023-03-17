<?php
namespace App\Controller;

use App\model\MessageModel;

class MessageController{
    public function createMessage($id_user,$id_receiver,$mp){
        $message = new MessageModel();
        $message->sendMessage($id_user,$id_receiver,$mp);
    }
}