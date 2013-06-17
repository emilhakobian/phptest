<?php
/**
 *
 */
class Client {

    function __construct($clientName) {
        $this -> client = $clientName;
    }

    public function addListener() {

    }

}

/**
 *
 */
class Room {

    public $chatRooms = array();

    function __construct($roomName) {
        $this -> room = $roomName;

    }

    public function addClient($client) {
        $this -> $chatRooms[$this -> room][] = $client;

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