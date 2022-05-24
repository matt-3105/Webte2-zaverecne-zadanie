<?php
require_once "config.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Finálne zadanie</title>
</head>
<body>

<header>
    <div id="langHeader">
        <a href="octave.php?lang=en"><?php echo $lang['lang_en'] ?></a>
        <a href="octave.php?lang=sk"><?php echo $lang['lang_sk'] ?></a>
    </div>
    <h1>Octave</h1>
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
    <div id="textarea-wrapper">
        <label for="prikaz"><?php echo $lang['prikaz'] ?></label>
        <textarea name="prikaz" id="prikaz"></textarea>
    </div>
    <button class="btn" name="submit" id="submit"><?php echo $lang['button'] ?></button>
</section>

<section>
    <h2><?php echo $lang['result']?></h2>
    <div id="response"></div>
</section>

<script src="octaveScript.js"></script>
</body>
</html>
