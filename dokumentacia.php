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
    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
            overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
            font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg .tg-baqh{text-align:center;vertical-align:top}
        .tg .tg-0lax{text-align:center;vertical-align:top}
    </style>
    <title>Finálne zadanie</title>
</head>
<body>

<header>
    <div id="langHeader">
        <a href="dokumentacia.php?lang=en"><?php echo $lang['lang_en'] ?></a>
        <a href="dokumentacia.php?lang=sk"><?php echo $lang['lang_sk'] ?></a>
    </div>
    <h1><?php echo $lang['nav_docs'] ?></h1>
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

<table class="tg">
    <thead>
    <tr>
        <th class="tg-baqh"><?php echo $lang['doc_state'] ?></th>
        <th class="tg-baqh"><?php echo $lang['doc_task'] ?></th>
        <th class="tg-0lax"><?php echo $lang['doc_student'] ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="tg-baqh"><?php echo $lang['doc_done'] ?></td>
        <td class="tg-baqh"><?php echo $lang['doc_task1'] ?></td>
        <td class="tg-0lax">Matej Bredik</td>
    </tr>
    <tr>
        <td class="tg-baqh"><?php echo $lang['doc_progress'] ?></td>
        <td class="tg-baqh"><?php echo $lang['doc_task2'] ?></td>
        <td class="tg-0lax">Tomáš Minárik</td>
    </tr>
    <tr>
        <td class="tg-baqh"><?php echo $lang['doc_done'] ?></td>
        <td class="tg-baqh"><?php echo $lang['doc_task3'] ?></td>
        <td class="tg-0lax">Tomáš Minárik</td>
    </tr>
    <tr>
        <td class="tg-baqh"><?php echo $lang['doc_done'] ?></td>
        <td class="tg-baqh"><?php echo $lang['doc_task4'] ?></td>
        <td class="tg-0lax">Tomáš Minárik</td>
    </tr>
    <tr>
        <td class="tg-baqh"><?php echo $lang['doc_progress'] ?></td>
        <td class="tg-baqh"><?php echo $lang['doc_task5'] ?></td>
        <td class="tg-0lax"></td>
    </tr>
    <tr>
        <td class="tg-baqh"><?php echo $lang['doc_progress'] ?></td>
        <td class="tg-baqh"><?php echo $lang['doc_task6'] ?></td>
        <td class="tg-0lax">Matej Bredik, Matúš Kuflík, Filip Kolenčík</td>
    </tr>
    <tr>
        <td class="tg-baqh"></td>
        <td class="tg-baqh"><?php echo $lang['doc_task7'] ?></td>
        <td class="tg-0lax"></td>
    </tr>
    <tr>
        <td class="tg-baqh"><?php echo $lang['doc_done'] ?></td>
        <td class="tg-baqh"><?php echo $lang['doc_task8'] ?></td>
        <td class="tg-0lax">Tomáš Minárik</td>
    </tr>
    <tr>
        <td class="tg-baqh"></td>
        <td class="tg-baqh"><?php echo $lang['doc_task9'] ?></td>
        <td class="tg-0lax"></td>
    </tr>
    <tr>
        <td class="tg-baqh"><?php echo $lang['doc_accomplished'] ?></td>
        <td class="tg-baqh"><?php echo $lang['doc_task10'] ?></td>
        <td class="tg-0lax">Matej Bredik, Matúš Kuflík, Filip Kolenčík, Tomáš Minárik</td>
    </tr>
    <tr>
        <td class="tg-baqh"><?php echo $lang['doc_progress'] ?></td>
        <td class="tg-baqh"><?php echo $lang['doc_task11'] ?></td>
        <td class="tg-0lax">Filip Kolenčík, Matej Bredik</td>
    </tr>
    </tbody>
</table>
</body>
</html>
