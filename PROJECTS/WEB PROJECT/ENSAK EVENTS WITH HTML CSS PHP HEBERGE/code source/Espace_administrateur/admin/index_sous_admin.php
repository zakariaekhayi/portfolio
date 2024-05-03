<?php
    session_start();
    include("connexion.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $log = $_POST['Login'];
        $mdp = $_POST['MDP'];
        $sql = "SELECT * FROM sous_admin WHERE LOGIN='$log'";
        $res = mysqli_query($link, $sql);

        if (mysqli_num_rows($res) > 0) {
            $ref = mysqli_fetch_assoc($res);

            if ($ref['MDP'] == $mdp) {
                $_SESSION['login'] = $log;
                $_SESSION['mdp'] = $mdp;
                header("Location: panneaux_controle_sous.php");
                exit;
            } else {
                $error_message = 'Le Mot de passe est incorrect.';
            }
        } else {
            $error_message = 'Login incorrect.';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Sous-admin</title>
    <style>
        body {
            background-color: #0e0c20;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(
                #1845ad,
                #23a2f6
            );
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(
                to right,
                #ff512f,
                #f09819
            );
            right: -30px;
            bottom: -80px;
        }

        form {
            height: 400px;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .social {
            margin-top: 30px;
            display: flex;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255, 255, 255, 0.27);
            color: #eaf0fb;
            text-align: center;
        }

        .social div:hover {
            background-color: rgba(255, 255, 255, 0.47);
        }

        .social .fb {
            margin-left: 25px;
        }

        .social i {
            margin-right: 4px;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h3>Connexion Sous-admin</h3>
        <label for="Login">Login</label>
        <input type="text" id="Login" name="Login" required="required">
        <label for="MDP">Mot de passe</label>
        <input type="password" id="MDP" name="MDP" required="required">
        <button type="submit" name="Envoyer">Se connecter</button>
    </form>
</body>
</html>
