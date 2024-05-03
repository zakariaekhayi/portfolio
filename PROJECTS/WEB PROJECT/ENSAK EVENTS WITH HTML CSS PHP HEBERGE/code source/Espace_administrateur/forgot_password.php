<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <style>
        

*,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #0e0c20;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 360px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
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
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}

    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
        <form action="" method="post">
            <h3>Mot de passe oublié</h3>
            <label for="email">Entrer votre email</label>
            <input type="text" name="email" id="email" placeholder="Votre email">
            <button type="submit" name="envoyer">Envoyer</button>
        </form>
    </div>
</body>
</html>


<?php
    include("connexion.php");
    if(isset($_POST['envoyer']) ){
        $email=$_POST['email'];
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
           $sql2="select *from user where LOGIN='$email'";
           $req=mysqli_query($link,$sql2);
           if(mysqli_num_rows($req) > 0){
                $password=uniqid();
                $message="Bonjour votre password est: $password";
                $header ="From: 5254mohamed@gmail.com";
                $subject="Mot de passe";
                if(mail($email,$subject,$message,$header)){
                    $sql="UPDATE user SET PASSWORD='$password' where LOGIN='$email'";
                    $res=mysqli_query($link,$sql);
                    if($res){
                        header("Location: Login.php");
                    }
                    else
                        echo 'veuillez ressayer';
                }
                else
                    echo 'un probleme';
            }
            else
                echo 'veuillez verifier votre email';

        }
        else
            echo 'veuillez saisir un email valide';
        


    }
?>