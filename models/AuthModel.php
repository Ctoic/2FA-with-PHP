<?php
class AuthModel {
    public $username;
    public $password;
    public $confirmPassword;

    public function __construct($username = '', $password = '', $confirmPassword = '') {
        $this->username = $username;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    


}
?>
