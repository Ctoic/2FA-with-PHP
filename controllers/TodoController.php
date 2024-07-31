<?php
require_once '../models/TodoModel.php';
require_once '../models/User.php'; // Ensure this line is present
require_once '../models/Todo.php';
class TodoController
{
    private $todoModel;

    public function __construct($todoModel)
    {
        $this->todoModel = $todoModel;
    }

    public function

    dashboard()
    {
        //  if (!isset($_SESSION['user']) || !($_SESSION['user'] instanceof User)) {
        //   header('Location: /myapp/public/index.php?action=2fa');
        //     exit();
        //  }

        $user_id = $_SESSION['user']->id;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      
            $description = $_POST['description'];
            $this->todoModel->addTodo($user_id, $description);
            if (isset($_POST['update'])) {
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
        echo '<pre>';
        print_r($todos);
        echo '</pre>';
        include '../views/dashboard.html';
    }
}
