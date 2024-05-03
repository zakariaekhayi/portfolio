<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneaux de Contrôle</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            margin-top: 50px;
        }

        button {
            background-color: #e8491d;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #d3441a;
        }

        .button-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue dans le Panneau de Contrôle</h1>
        <div class="button-container">
            <a href="proposer.php">
                <button>Vos Propositions</button>
            </a>
            <a href="Vos_article.php">
                <button>Vos Articles</button>
            </a>
        </div>
    </div>
</body>
</html>
