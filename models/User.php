<?php

class User {
    public $id;
    public $username;
    public $password;
    public $secret;

    public function __construct($id = null, $username = null, $password = null, $secret = null) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->secret = $secret;
    }
}
?>
