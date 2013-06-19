<?php
/**
 * Class Client
 */
class Client {

    public $listener;

    function __construct($clientName) {
        $this -> client = $clientName;
        var_dump($clientName . ' client created');
    }

    /**
     * Function client
     * @return {object} - return client object
     */
    public function client() {
        return $this -> client;
    }

    /**
     * Function addListener
     * @param {object} - listener object
     */
    public function addListener($listener) {
        $this -> listener = $listener;

    }

    /**
     * Function getListener
     * @return {object} - listener object
     */
    public function getListener() {
        return $this -> listener;
    }

}

/**
 * Class Listener
 */
class Listener {

    /**
     * Function receive
     * @param {object} $from - message sender
     * @param {object} $room - chat room
     * @param {string} $msg - text message
     */
    public function receive($from, $room, $msg) {
        var_dump($msg . ' Recieved');
    }

}

/**
 * CLass Room
 */
class Room {

    public $roomOccupants = array();
    public $recipients = array();

    function __construct($roomName) {
        $this -> room = $roomName;
        var_dump($roomName . ' room Created');

    }

    /**
     * Function addClient - add client to char room
     * @param {object} - client object
     */
    public function addClient($client) {
        $this -> roomOccupants[] = $client;
        var_dump($client, ' added to room - ', $this -> room);
    }

    /**
     * Function getOccupants - get occupants from chat room
     * @return {array} - occupants array
     */
    public function getOccupants() {
        return $this -> roomOccupants;
    }

    /**
     * Function getRecipients - get recipients of room
     * @param {object} - sender object
     * @return {mixed} - return recipients array or false
     */
    public function getRecipients($sender) {
        $occupants = $this -> getOccupants();
        foreach ($occupants as $occupant) {
            if ($occupant != $sender) {
                $this -> recipients[] = $occupant;
            }
        }

        return (empty($this -> recipients) === FALSE) ? $this -> recipients : FALSE;
    }

    /**
     * Function send - send text message to room recipients
     * @param {object} $from - sender object;
     * @param {string} $msg - text message
     */
    public function send($from, $msg) {
        $recepients = $this -> getRecipients($from);
        if ($recepients) {
            foreach ($recepients as $recipient) {
                $list = $recipient -> getListener();
                if ($list)
                    $list -> receive($from, $this, $msg);

            }
        }
    }

}

/**
 * Class Chat
 */
class Chat {

    /**
     *  Function createClient - create client
     *  @param {string} $clientName - chat client's name
     *  @return {mixed} return object if client is created or FALSE
     */
    public function createClient($clientName) {

        return (empty($clientName) === FALSE) ? $client = new Client($clientName) : FALSE;

    }

    /**
     * Function createChatroom - create a chat room
     * @param {string} $roomName - room's name
     *  @return {mixed} return object if room is created or FALSE
     */
    public function createChatroom($roomName) {
        return (empty($roomName) === FALSE) ? $room = new Room($roomName) : FALSE;

    }

}
?>