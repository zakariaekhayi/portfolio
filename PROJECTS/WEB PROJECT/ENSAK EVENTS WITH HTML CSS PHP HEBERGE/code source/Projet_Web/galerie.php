<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylegalerie.css" /> 
    <title>Document</title>
</head>
<body>

    
    <?php 
    include ("connexion.php");
    $requete = "SELECT * FROM article ORDER BY id DESC";
    $resultat=mysqli_query($link,$requete);
    $i=1;
    
    while($resultat_tableau=mysqli_fetch_assoc($resultat)){
      $photo=$resultat_tableau['photo'];
      ${"photo" . $i} = $resultat_tableau['photo'];//comme disant  $photo$i=$$resultat_tableau['photo'];  $i++; 
        $i++;//incrementer pour changer le nom de la variable
    
    
    
    }
    
    ?>
         


    <div class="card">
    <a href="reserver.php?photo=<?= $photo1 ?>">
        <img class="imageedit" src="./photo/<?=$photo1;?>" width="220px" />
      </a>
      <a href="reserver.php?photo=<?= $photo2 ?>">
        <img class="imageedit" src="./photo/<?=$photo2;?>" width="220px" />
      </a>
      <a href="reserver.php?photo=<?= $photo3 ?>">
        <img class="imageedit" src="./photo/<?=$photo3;?>" width="220px" />
      </a>
      <a href="reserver.php?photo=<?= $photo4 ?>">
        <img class="imageedit" src="./photo/<?=$photo4;?>" width="220px" />
      </a>
      <a href="reserver.php?photo=<?= $photo5 ?>">
        <img class="imageedit" src="./photo/<?=$photo5;?>" width="220px" />
      </a>
      <a href="reserver.php?photo=<?= $photo6 ?>">
        <img class="imageedit" src="./photo/<?=$photo6;?>" width="220px" />
      </a>
      <a href="reserver.php?photo=<?= $photo7 ?>">
        <img class="imageedit" src="./photo/<?=$photo7;?>" width="220px" />
      </a>
      <a href="reserver.php?photo=<?= $photo8 ?>">
        <img class="imageedit" src="./photo/<?=$photo8;?>" width="220px" />
      </a>
      <a href="reserver.php?photo=<?= $photo9 ?>">
        <img class="imageedit" src="./photo/<?=$photo9;?>" width="220px" />
      </a>
      <a href="reserver.php?photo=<?= $photo10 ?>">
        <img class="imageedit" src="./photo/<?=$photo10;?>" width="220px" />
      </a>
    </div>
</body>
</html>