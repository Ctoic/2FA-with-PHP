<?php
require_once '../services/AuthService.php';
require_once '../models/AuthModel.php';
require_once '../models/User.php';


class AuthController {
    private $authService;

    public function __construct($authService) {
        $this->authService = $authService;
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
    
            $model = new AuthModel($username, $password, $confirmPassword);
    
            if ($model->password === $model->confirmPassword) {
                // Handle profile image upload
                if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                    $imageTmpPath = $_FILES['profile_image']['tmp_name'];
                    $imageName = $_FILES['profile_image']['name'];
                    $imageSize = $_FILES['profile_image']['size'];
                    $imageType = $_FILES['profile_image']['type'];
    
                    // Validate and move the uploaded file
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (in_array($imageType, $allowedTypes)) {
                        $uploadDir = '/var/www/html/myapp/public/Images/';
                        if (!file_exists($uploadDir)) {
                            mkdir($uploadDir, 0777, true);
                        }
                        $profileImage = $uploadDir . basename($imageName);
                        move_uploaded_file($imageTmpPath, $profileImage);
    
                        // Store the profile image path in the model
                        $model->profile_image = $profileImage;
                    } else {
                        echo "Invalid image type.";
                        return;
                    }
                }
    
                // Register the user
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
                session_start();
                $_SESSION['username'] = $user;
                header('Location: /myapp/views/dashborad.html');
            } else {
            }
        } else {
            include '../views/auth/login.html';
        }
    }

    public function twoFactor() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['code'];
            if (isset($_SESSION['username'])) {
                $user = $_SESSION['username'];
                $secret = $user->secret;

                if ($this->authService->verifyTwoFactorCode($secret, $code)) {
                    header('Location: ./public/index.php?action=home');
                } else {
                    echo "Invalid code.";
                }
            } else {
                echo "User session not found.";
            }
        } else {
            if (isset($_SESSION['username'])) {
                $user = $_SESSION['username'];
                $qrCodeUrl = $this->authService->generateQrCode('MyApp', $user->username, $user->secret);
                include '../views/auth/twofactor.html';
            } else {
                echo "User session not found.";
            }
        }
    }
}
?>
