<?php

class TodoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addTodo($user_id, $description) {
        if (!$user_id || !$description) {
            throw new InvalidArgumentException("Invalid user_id or description");
        }

        $stmt = $this->pdo->prepare("INSERT INTO todos (user_id, description) VALUES (?, ?)");
        $stmt->execute([$user_id, $description]);
    }

    public function updateTodo($id, $description, $completed) {
        $stmt = $this->pdo->prepare("UPDATE todos SET description = ?, completed = ? WHERE id = ?");
        $stmt->execute([$description, $completed, $id]);
    }

    public function deleteTodo($id) {
        $stmt = $this->pdo->prepare("DELETE FROM todos WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getTodos($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM todos WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
