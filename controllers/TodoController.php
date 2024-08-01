<?php
require_once '../models/TodoModel.php';
require_once '../models/User.php';

class TodoController {
    private $todoModel;

    public function __construct($todoModel) {
        $this->todoModel = $todoModel;
    }

    public function dashboard() {
        session_start();

    //      if (!isset($_SESSION['user']) || !($_SESSION['user'] instanceof User)) {
    //     header('Location: /myapp/public/index.php?action=login');
    //        exit();
    // }



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['add'])) {
                $description = $_POST['description'];
                $user_id = $_POST['user_id'];
                if (!empty($user_id) && !empty($description)) {
                    $this->todoModel->addTodo($user_id, $description);
                } else {
                    echo "User ID or description cannot be empty.";
                }
            } elseif (isset($_POST['update'])) {
                $id = $_POST['id'];
                $description = $_POST['description'];
                $completed = isset($_POST['completed']) ? 1 : 0;
                $this->todoModel->updateTodo($id, $description, $completed);
            } elseif (isset($_POST['delete'])) {
                $id = $_POST['id'];
                $this->todoModel->deleteTodo($id);
            }
        }

        $todos = $this->todoModel->getTodos($user_id);
        include '../views/dashborad.php';

    }
}
?>
