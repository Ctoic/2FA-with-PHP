<?php
//session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php';
require_once '../services/AuthService.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/TodoController.php';
require_once '../models/TodoModel.php';
require_once '../models/AuthModel.php';
require_once '../models/User.php';


$authService = new AuthService($pdo);
$todomodel = new TodoModel($pdo);
$authController = new AuthController($authService);
$todoController = new TodoController($todomodel);


$action = $_GET['action'] ?? 'login';
    
switch ($action) {
    case 'signup':
        $authController->signup();
        break;
    case 'login':
       
        $authController->login();
        break;
    case 'twofactor':
        $authController->twoFactor();
        break;
    case 'dashboard':
        $todoController->dashboard();

        break;
    case 'home':
        // Implement home page
        echo 'Welcome to the home page!';
        break;
        
    default:
        $authController->login();
        break;
}
?>
