<?php
require_once '../services/AuthService.php';

class AuthController {
    private $authService;

    public function __construct($authService) {
        $this->authService = $authService;
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new AuthModel($_POST['username'], $_POST['password'], $_POST['confirmPassword']);

            if ($model->password === $model->confirmPassword) {
                $result = $this->authService->registerUser($model);
                if ($result) {
                    header('Location: ../views/auth/twofactor.html');
                } else {
                    echo "Registration failed.";
                }
            } else {
                echo "Passwords do not match.";
            }
        } else {
            include '../views/auth/signup.html';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new AuthModel($_POST['username'], $_POST['password']);

            $user = $this->authService->authenticateUser($model);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: /myapp/views/dashborad.html');
            } else {
                echo "Login failed.";
                
            }
        } else {
            include '../views/auth/login.html';
        }
    }

    public function twoFactor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['code'];
            $user = $_SESSION['user'];
            $secret = $user->secret;

            if ($this->authService->verifyTwoFactorCode($secret, $code)) {
                header('Location: ./public/index.php?action=home');
            } else {
                echo "Invalid code.";
            }
        } else {
            $user = $_SESSION['user'];
            $qrCodeUrl = $this->authService->generateQrCode('MyApp', 'john_doe', '1234567890ABCDEF');
            include '../views/auth/twofactor.html';
        }
    }
}
?>
