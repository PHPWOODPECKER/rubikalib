<?php

require_once("./autoload.php");
require_once('./rubika/rubika.php');

$auth = "";
$private_key = "";
$guidGrope = "";
$guidBot = "";

$bot = new Rubika($auth, $private_key);

$api = new option();
$trunOrOffBot = true;
 // echo json_encode($bot->getChatsUpdates(), true);
 
  $List = $bot->getChatsUpdates();
      $filters = new filter($List["chats"]);
    if($filters === false){
      die();
    }
      
        $object_guid = $filters->objectGuid();
        $author_guid = $filters->autherGuid();
        $text = $filters->text();
        $message_id = $filters->messageId();
        $reply_message_id = $filters->replayMessageId();
        $chack = file_get_contents("./messageIds.txt");
        
     if ($filters->is_Group() && $author_guid !== $guidBot && $object_guid === $guidGrope) {
          $Gtext = $object_guid.":".$message_id;
          
//           if($filters->is_BadText()){
//             $bot->deleteMessage($object_guid, $message_id);
//           }

          if($filters->is_LinkText() && $filters->is_Admin($bot, $object_guid, $author_guid) === false){
            try{
            $bot->deleteMessage($object_guid, $message_id);
            $bot->banChatMember($object_guid, $author_guid);
            }catch(Execption $a){}
          }
            
        if($trunOrOffBot !== false && $chack !== $Gtext){
            if($text === "سلام"){
              $bot->sendTextMessage($object_guid, "سلام گل", $message_id);
            }
          if($bot->startsWith($text, "خوبی")){
            $bot->sendTextMessage($object_guid, "ممنون شما خوبی", $message_id);
          }
         }
      }
        

?>