<?php
class AuthModel {
    public $username;
    public $password;
    public $confirmPassword;
    public $profile_image;
    


    public function __construct($username = '', $password = '', $confirmPassword = '' , $profile_image = null) {
        $this->username = $username;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->profile_image = $profile_image;
    }

    


}
?>
