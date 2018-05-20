<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use App\ChatRooms;
use Auth;

use Session;

use App\User;
use App\Types;
use App\Message;
use DateTime;

class WebSocketController extends Controller implements MessageComponentInterface{
    protected $clients;
    private $subscriptions;
    private $users;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->subscriptions = [];
        $this->users = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $this->users[$conn->resourceId] = $conn;
    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {
        $data = json_decode($msg);


        switch ($data->command) {
            case "subscribe":
                $this->subscriptions[$conn->resourceId] = $data->channel;
                break;
            case "message":

            //save message in db
            //print_r($data);
            $message = Message::create([
                'text' => $data->message,
                'type_id' =>1,
                'user_id' =>$data->user_id
            ]);

            $message->chatrooms()->attach([$data->chatroom_id]);
            if (isset($this->subscriptions[$conn->resourceId])) {
                    $target = $this->subscriptions[$conn->resourceId];
                    foreach ($this->subscriptions as $id=>$channel) {
                        if ($channel == $target && $id != $conn->resourceId) {
                            $data->message=json_encode($data);
                            $this->users[$id]->send($data->message);
                        }
                    }
                }
                break;
                case "messageFromForm":
                         $data->message=json_encode($data);
                //print_r($data);
                //print_r($this->subscriptions);
                        foreach ($this->subscriptions as $id=>$channel) {
                            if ($channel == $data->channel) {
                                $this->users[$id]->send($data->message);
                            }
                        }
                break;                

        }

    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        unset($this->users[$conn->resourceId]);
        unset($this->subscriptions[$conn->resourceId]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}