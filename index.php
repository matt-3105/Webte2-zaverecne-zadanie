<?php
include "config.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="style.css">
    <title>Finálne zadanie</title>
</head>
<body>

<header>
    <div id="langHeader">
        <a href="index.php?lang=en"><?php echo $lang['lang_en'] ?></a>
        <a href="index.php?lang=sk"><?php echo $lang['lang_sk'] ?></a>
    </div>
    <h1><?php echo $lang['greeting'] ?></h1>
</header>
<section>
    <div class="navbar">
        <ul>
            <li><a href="index.php"><?php echo $lang['nav_mp'] ?></a></li>
            <li><a href="octave.php">Octave</a></li>
            <li><a href="dokumentacia.php"><?php echo $lang['nav_docs'] ?></a></li>
        </ul>
    </div>
</section>

<section>
    <label for="name"><?php echo $lang['name'] ?>
        <input type="text" name="name" id="name">
    </label>
    <label for="input"><?php echo $lang['code'] ?>
        <input type="text" name="input" id="input" placeholder="<?php echo $lang['placeholder'] ?>">
    </label>
    <button name="submit" id="submit"><?php echo $lang['button'] ?></button>
    <button name="play" id="play"><?php echo $lang['play_button'] ?></button>
    <label for="graph"><?php echo $lang['graph']?>
        <input type="checkbox" id="graph">
    </label>
    <label for="graph"><?php echo $lang['animation']?>
        <input type="checkbox" id="animation">
    </label>


    <div id="my-chart-wrapper">
        <canvas id="my-chart"></canvas>
    </div>
    <canvas id="car" height="380" width="70"></canvas>
    <div id="users"></div>
</section>

<script src="script.js"></script>
</body>
</html>
