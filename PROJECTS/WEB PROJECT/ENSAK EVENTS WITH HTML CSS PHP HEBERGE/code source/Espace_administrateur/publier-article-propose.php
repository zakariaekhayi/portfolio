<?php
    session_start();
    include("connexion.php");
    $id=$_GET['id'];
    $sql="select *from article_proposé where id=$id";
    $res=mysqli_query($link,$sql);
    $ref=mysqli_fetch_assoc($res);
    $tit=$ref['titre'];
    $descr=$ref['description'];

    $date=$ref['date'];
    $type=$ref['type_event'];
    $photo=$ref['photo'];
    $email=$ref['organisateur'];
    $sql2="insert into article(titre,type_event,description,photo,date) value('$tit','$type','$descr','$photo','$date')";
    $res2=mysqli_query($link,$sql2);
    if($res){
        $message="Bonjour votre proposition est accepte:$tit";
        $header ="From: 5254mohamed@gmail.com";
        $subject="Authentification";
        mail($email,$subject,$message,$header);
        $sql3="update article_proposé set etat='accepté' where id=$id";
        $res=mysqli_query($link,$sql3);
        header("Location: contenu_proposer.php");


    }
    else
        echo 'il ya un probleme';

    ?>