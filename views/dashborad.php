<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>My TODO List</h1>
                    </div>
                    <div class="card-body">
                        <!-- Display profile image -->
                        <?php if (!empty($_SESSION['username']->profile_image)): ?>
                            <div class="text-center mb-3">
                                <img src="<?php echo htmlspecialchars($_SESSION['username']->profile_image); ?>" alt="Profile Image" class="img-thumbnail" width="100">
                            </div>
                        <?php endif; ?>

                        <!-- Form to add new TODO -->
                        <form method="post" action="/myapp/public/index.php?action=dashboard" class="input-group mb-3">
                            <input type="text" name="description" placeholder="Add a new task" class="form-control" required>
                            <br>
                            <input placeholder="user_id" type="text" id="user_id" name="user_id"    >
                            <div class="input-group-append">
                            
                                <button type="submit" name="add" class="btn btn-primary">Add</button>
                            </div>
                        </form>

                        <!-- Display TODOs -->
                        <ul class="list-group">
                            <?php if (!empty($todos)): ?>
                                <?php foreach ($todos as $todo): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <form method="post" action="/myapp/public/index.php?action=dashboard" class="w-100 d-flex align-items-center">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($todo['id']); ?>">
                                            <input placeholder="checkbox" type="text" name="description" value="<?php echo htmlspecialchars($todo['description']); ?>" class="form-control mr-2">
                                            <div class="form-check form-check-inline">
                                                <input placeholder="checkbox" type= "checkbox" name="completed" class="form-check-input" <?php echo $todo['completed'] ? 'checked' : ''; ?>>
                                            </div>
                                            <button type="submit" name="update" class="btn btn-success btn-sm mr-2" action =/myapp/public/index.php?action=dashboard>Update</button>
                                            <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item">No tasks available</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
