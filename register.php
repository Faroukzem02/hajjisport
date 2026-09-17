<?php
include "connexion.php";
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST["register"])) {

    $id = uniq_id();

    $fullname = $_POST['fullname'];
    $fullname = filter_var($fullname, FILTER_SANITIZE_STRING);

    $username = $fullname . $id;

    $phone = $_POST['phone'];
    $phone = filter_var($phone, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $password = $_POST['password'];
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $cpassword = $_POST['c_password'];
    $cpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);

    $adresse = $_POST['adresse'];
    $adresse = filter_var($adresse, FILTER_SANITIZE_STRING);

    $city = $_POST['city'];
    $city = filter_var($city, FILTER_SANITIZE_STRING);

    $country = $_POST['country'];
    $country = filter_var($country, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT *  FROM `users` Where email = ?");
    $select_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        $warning_msg[] = "email déja existe";
    } else {
        if (strlen($password) < 8 || strlen($password) > 20 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[\W_]/', $password)) {
            $warning_msg[] = "mot de passe faut étre entre 8 et 20 , contient un lettre majuscule au moin des chiffes et des symboles";
        } else {
            if ($password != $cpassword) {
                $warning_msg[] = 'confirmer votre mot de passe';
            } else {
                $insert_user = $conn->prepare("INSERT INTO `users` (id,username,fullname,tel,email,password,adress,ville,pays) VALUES (?,?,?,?,?,?,?,?,?)");
                $insert_user->execute([$id, $username, $fullname, $phone, $email, $password, $adresse, $city, $country]);

                $select_user = $conn->prepare("SELECT * FROM `users` WHERE email=? AND password=?");
                $select_user->execute([$email, $password]);
                $row = $select_user->fetch(PDO::FETCH_ASSOC);

                if ($select_user->rowCount() > 0) {
                    session_start();
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_username'] = $row['username'];
                    $_SESSION['user_email'] = $row['email'];

                    header("Location: home");
                    exit();
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - s'inscrire</title>
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
                    <input type="text" placeholder="Nom et prenom ..." name="fullname" required>
                    <input type="text" placeholder="Tel ..." name="phone" required>
                    <input type="text" placeholder="email ..." name="email" required>
                    <div class="grp">
                        <div class="psw">
                            <input type="password" placeholder="Mot de passe ..." name="password" required class="input-psw">
                            <span><ion-icon name="eye" class="show-psw"></ion-icon></span>
                        </div>
                        <div class="psw">
                            <input type="password" placeholder="Confirmer mot de passe ..." name="c_password" required class="input-cpsw">
                            <span><ion-icon name="eye" class="show-cpsw"></ion-icon></span>
                        </div>
                    </div>
                    <p style="color:rgb(190,0,0) ; font-family:var(--light);font-size:14px;margin-bottom:10px">* mot de passe faut étre entre 8 et 20 , contient un lettre majuscule au moin des chiffes et des symboles</p>
                    <input type="text" placeholder="adresse ..." name="adresse" required>
                    <div class="grp">
                        <input type="text" placeholder="Ville ..." name="city" required>
                        <input type="text" placeholder="Pays ..." name="country" required>
                    </div>
                    <div class="conditions">
                        <input type="checkbox" name="conditions" id="" required>
                        <label>En cliquant sur <span>S'inscrire</span>, je confirme avoir lu et accepté les <a href="">Conditions générales</a> ainsi que les <a href="">Informations sur la protection des données</a> liées à la participation à HAJJI SPORTS EXPERIENCE.</label>


                    </div>
                    <button type="submit" name="register">S'inscrire</button>
                </form>
                <p>Avez-vous déja un compte ? <a href="login">Se connecter</a></p>
            </div>
        </div>
    </div>

    <script>
        let show_btn = document.querySelector(".show-psw");
        let input_btn = document.querySelector(".input-psw");
        let show_cbtn = document.querySelector(".show-cpsw");
        let input_cbtn = document.querySelector(".input-cpsw");
        show_btn.onclick = () => {
            if (input_btn.type === "text") {
                input_btn.type = "password";
                show_btn.name = "eye";
            } else {
                input_btn.type = "text";
                show_btn.name = "eye-off";
            }
        }
        show_cbtn.onclick = () => {
            if (input_cbtn.type === "text") {
                input_cbtn.type = "password";
                show_cbtn.name = "eye";
            } else {
                input_cbtn.type = "text";
                show_cbtn.name = "eye-off";
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <style>
        .psw {
            background-color: var(--white);
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 49%;
            margin-bottom: 14px;
            padding-right: 15px;
            border-radius: 10px;
        }

        .login .content .container form .grp .psw input {
            width: 90%;
            margin: 0;
        }

        .psw span {
            display: flex;
            align-items: center;
            color: var(--dark1);
            font-size: 25px;
            cursor: pointer;
        }

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
            font-size: 32px;
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

        .login .content .container form input {
            width: 100%;
            border: none;
            outline: none;
            padding: 8px 15px;
            border-radius: 10px;
            font-size: 16px;
            font-family: var(--regular);
            color: var(--black);
            margin-bottom: 14px;
        }

        
        .login .content .container form .grp input {
            width: 49%;
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
            font-size: 17px;
            font-family: var(--bold);
            text-decoration: none;
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


    <?php include "alert.php" ?>

</body>

</html>