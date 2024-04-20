<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Resto - Login</title>
    <link rel="stylesheet" href="login-oage.css" />
</head>

<body>

<div class="heading">
    <h1><i> Admin </i></h1>
</div>
    <div class="login">
        <h1>Login</h1>
        <form method="post" action="login-script.php">
            <input type="text" name="username" placeholder="Username" required="required" />
            <input type="password" name="password" placeholder="Password" required="required" />
            <button type="submit" class="btn btn-primary btn-block btn-large">
                Let me in.
            </button>
        </form>
        <?php
          session_start();
          if(isset($_SESSION['error'])) {
          echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
          unset($_SESSION['error']);
        }
        ?>
    </div>
</body>

</html>