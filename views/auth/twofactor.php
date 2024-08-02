<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Two-Factor Authentication</h1>
                    </div>
                    <div class="card-body text-center">
                        <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code" class="img-fluid mb-3">
                        <form action="/myapp/public/index.php?action=twofactor" method="post">
                            <div class="form-group">
                                <label for="code">Enter code from authenticator app:</label>
                                <input type="text" id="code" name="code" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Verify</button>
                        </form>
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
