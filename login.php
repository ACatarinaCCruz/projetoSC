<?php
$dsn = "mysql:host=localhost;dbname=serviceCenter";
$user = "root";
$passwd = "";
$pdo = new PDO($dsn, $user, $passwd);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <body>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div id="first">
                        <div class="">
                            <div class="logo mb-3">
                                <div class="col-md-12 text-center">
                                    <h1>Service Center</h1>
                                </div>
                            </div>
                            <br>
                            <form action="serviceCenter.php" method="post" name="login">
                                <div class="form-group">
                                    <label>Email</label>
                                    <br>
                                    <input type="text" name="email" class="form-control" id="email" required placeholder="Insira o seu email">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Password</label>
                                    <br>
                                    <input type="password" name="password" id="password" class="form-control" required placeholder="Insira a sua password">
                                </div>
                                <br>
                                <div class="col-md-12 text-center">
                                    <button type="submit" name="login" class="btn btn-block mybtn btn-secondary tx-tfm">Login</button>
                                </div>
                                <br>
                                <div class="form-group">
                                    <p class="text-center"> Ainda não tem conta? <a href="registar.php" id="registo">Registe-se</a></p>
                                </div>
                            </form>
                            <?php
                            try {
                                if (isset($_POST['login'])) {
                                    $email = $_POST['email'];
                                    $pass = $_POST['pass'];
                                    $stm = $pdo->query("SELECT * FROM utilizadores WHERE email = '$email' AND pass = '$pass'");
                                    $row = $stm->fetch(PDO::FETCH_ASSOC);
                                    if (is_array($row)) {
                                        $_SESSION["username"] = $row['username'];
                                        $_SESSION["password"] = $row['pass'];
                                    }
                                }
                                if (isset($_SESSION["username"])) {
                                    session_start();
                                    header("Location:serviceCenter.php");
                                }
                            } catch (Exception $e) {
                                echo 'Login incorreto!';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</body>
</html>