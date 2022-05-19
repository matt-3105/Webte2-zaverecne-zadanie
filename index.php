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
    <link rel="stylesheet" href="style.css">
    <title>Finálne zadanie</title>
</head>
<body>
<div id="langHeader">
    <a href="index.php?lang=en"><?php echo $lang['lang_en'] ?></a>
    <a href="index.php?lang=sk"><?php echo $lang['lang_sk'] ?></a>
</div>
<h1><?php echo $lang['greeting'] ?></h1>
<form action="index.php">
    <label for="name"><?php echo $lang['name'] ?>
        <input type="text" name="name" id="name">
    </label>
    <label for="txtArea"><?php echo $lang['code'] ?>
        <textarea name="txtArea" id="txtArea" cols="30" rows="10" placeholder="<?php echo $lang['placeholder'] ?>"></textarea>
    </label>
    <input type="submit" name="submit" id="submit" value="<?php echo $lang['button'] ?>">
</form>
</body>
</html>
