<?php
include "connexion.php";
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

//login user
if (isset($_POST['login'])) {

    $email = $_POST['user'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = $_POST['password'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE (email = ? OR username = ?) AND password = ?");
    $select_user->execute([$email, $email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_username'] = $row['username'];
        $_SESSION['user_email'] = $row['email'];
        header("Location: home");
        exit();
    } else {
        $warning_msg[] = 'incorrect user , email ou mot de passe';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - se connecter</title>
    <style>
        <?php
        include "style.css"
        ?>
    </style>
    <link rel="icon" href="imgs/ico.png" type="image/x-icon">
</head>

<body>
    <?php include "loading.php" ?>
    <div class="login">
        <div class="content">
            <div class="container">
                <a href="index.php" class="back_to_index"><ion-icon name="close"></ion-icon></a>
                <div class="title">
                    <p><span>NF</span> HAJJI SPORTS</p>
                    <h2>Bienvenue</h2>
                </div>
                <form action="" method="post">
                    <input type="text" placeholder="nom ou email ..." name="user" required maxlength="30">
                    <div class="psw">
                        <input type="password" placeholder="mot de passe ..." name="password" class="input-psw" required maxlength="20">
                        <span><ion-icon name="eye" class="show-psw"></ion-icon></span>
                    </div>
                    <button type="submit" name="login">se connecter</button>
                </form>
                <p>tu n'as pas de compte ? <a href="register">s'inscrire</a></p>
            </div>
        </div>
    </div>

    <script>
        let show_btn = document.querySelector(".show-psw");
        let input_btn = document.querySelector(".input-psw");
        show_btn.onclick = () => {
            if (input_btn.type === "text") {
                input_btn.type = "password";
                show_btn.name = "eye";
            } else {
                input_btn.type = "text";
                show_btn.name = "eye-off";
            }
        }
    </script>
    <style>
        .login {
            width: 100%;
            height: 100vh;
            background: url(imgs/login_bg.png)center/cover no-repeat;
            user-select: none;
        }

        .login .content {
            width: 100%;
            height: 100%;
            backdrop-filter: blur(3px);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login .content .container {
            background-color: var(--cyan);
            padding: 20px;
            border: 2px solid var(--white);
            border-radius: 15px;
            width: 40%;
        }

        .login .content .container .back_to_index {
            color: var(--white);
            font-size: 30px;
            position: absolute;
            cursor: pointer;
        }

        .login .content .container .title {
            text-align: center;
            margin-bottom: 15px;
        }

        .login .content .container .title p {
            color: var(--white);
            font-size: 18px;
            font-family: var(--light);
        }

        .login .content .container .title p span {
            color: #020c11;
            font-size: 20px;
            font-family: var(--regular);
        }

        .login .content .container .title h2 {
            color: var(--white);
            font-size: 27px;
            font-family: var(--bold);
        }

        .login .content .container form {
            width: 100%;
        }

        .login .content .container form .grp {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .login .content .container form .grp input {
            width: 49%;
        }

        .login .content .container form input {
            width: 100%;
            border: none;
            outline: none;
            padding: 8px 15px;
            border-radius: 10px;
            font-size: 16px;
            font-family: var(--regular);
            color: var(--black);
        }

        .login .content .container form .conditions input {
            width: auto;
            margin: 0;
            padding: 0;
            margin-right: 10px;
        }

        .login .content .container form button {
            padding: 5px 20px;
            font-size: 17px;
            font-family: var(--regular);
            color: var(--white);
            background-color: #031d2a;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all ease .3s;
        }

        .login .content .container form button:hover {
            background-color: #213c49;
        }

        .login .content .container .conditions {
            display: flex;
            align-items: first baseline;
            margin-bottom: 10px;
        }

        .login .content .container .conditions input {
            margin-right: 10px;
        }

        .login .content .container .conditions label {
            font-size: 15px;
            font-family: var(--light);
            color: var(--white);
        }

        .login .content .container .conditions label span {
            font-size: 17px;
        }

        .login .content .container .conditions label a {
            font-size: 16px;
            text-decoration: none;
            font-family: var(--bold);
            color: var(--white);
            cursor: pointer;
        }

        .login .content .container p {
            color: var(--white);
            font-size: 16px;
            font-family: var(--light);
        }

        .login .content .container p a {
            color: var(--white);
            font-size: 18px;
            font-family: var(--bold);
            text-decoration: none;
        }

        .psw {
            background-color: var(--white);
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            margin: 14px 0;
            padding-right: 15px;
            border-radius: 10px;
        }

        .psw input {
            width: 85%;
        }

        .psw span {
            display: flex;
            align-items: center;
            color: var(--dark1);
            font-size: 25px;
            cursor: pointer;
        }

        @media screen and (max-width:799px) {
            .login .content .container {
                width: 100%;
            }

            .login .content {
                padding: 20px;
            }
        }

        @media screen and (min-width:800px) and (max-width:1100px) {
            .login .content .container {
                width: 80%;
            }

            .login .content {
                padding: 20px;
            }
        }
    </style>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <?php include "alert.php" ?>

</body>

</html>