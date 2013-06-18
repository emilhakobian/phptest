<?php
/**
 *
 */
class Client {

    public $listener;

    function __construct($clientName) {
        $this -> client = $clientName;
        var_dump($clientName . ' client created');
    }

    public function client() {
        return $this -> client;
    }

    public function addListener($listener) {
        $this -> listener = $listener;

    }

    public function getListener() {
        return $this -> listener;
    }

}

/**
 *
 */
class Listener {

    public function receive($from, $room, $msg) {
        var_dump($msg . ' Recieved');
    }

}

/**
 *
 */
class Room {

    public $roomOcupants = array();
    public $recipients = array();

    function __construct($roomName) {
        $this -> room = $roomName;
        var_dump($roomName . ' room Created');

    }

    public function addClient($client) {
        $this -> roomOcupants[] = $client;
        var_dump($client,' added to room - ',$this->room);
    }

    public function getOccupants() {
        return $this -> roomOcupants;
    }

    public function getRecipients($sender) {
        $ocupants = $this -> getOccupants();
        foreach ($ocupants as $ocupant) {
            if ($ocupant != $sender) {
                $this -> recipients[] = $ocupant;
            }
        }

        return (empty($this -> recipients) === FALSE) ? $this -> recipients : FALSE;
    }

    public function send($from, $msg) {
        $recepients = $this -> getRecipients($from);
        if ($recepients) {
            foreach ($recepients as $recipient) {
                $list = $recipient -> getListener();
                if ($list) $list -> receive($from, $this, $msg);

            }
        }
    }

}

/**
 *
 */
class Chat {

    public function createClient($clientName) {

        return (empty($clientName) === FALSE) ? $client = new Client($clientName) : FALSE;

    }

    public function createChatroom($roomName) {
        return (empty($roomName) === FALSE) ? $room = new Room($roomName) : FALSE;

    }

}
?>