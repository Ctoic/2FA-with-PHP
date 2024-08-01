<?php
require_once '../models/User.php';
require_once '../models/AuthModel.php';

class AuthService {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registerUser(AuthModel $model) {
    $secret = $this->generateSecret();
    $hashedPassword = $this->hashPassword($model->password);
    $stmt = $this->pdo->prepare("INSERT INTO users (username, passwordHash, secret, profile_image) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$model->username, $hashedPassword, $secret, $model->profile_image]);
    }
    public function authenticateUser(AuthModel $model) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$model->username]);
        $user = $stmt->fetchObject('User');

        return $user ? new User($user->id, $user->username, $user->password, $user->secret) : null;

        if ($user && password_verify($model->password, $user->passwordHash)) {
            return $user;
        }

        return null;
    }

    public function generateQrCode($appName, $appInfo, $secret) {
        $url = "https://www.authenticatorApi.com/pair.aspx?AppName={$appName}&AppInfo={$appInfo}&SecretCode={$secret}";
        return $url;
    }

    public function verifyTwoFactorCode($secret, $code) {
        $url = "https://www.authenticatorApi.com/validate.aspx?SecretCode={$secret}&Code={$code}";
        $response = file_get_contents($url);
        return $response === 'True';
    }

    private function generateSecret() {
        return bin2hex(random_bytes(10)); // 20 bytes = 160 bits
    }

    private function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
?>
