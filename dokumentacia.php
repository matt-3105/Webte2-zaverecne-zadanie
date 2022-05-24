<?php
require_once "config.php";
?>

<!doctype html>
<html lang="sk">
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
<section>
    <div id="csv-wrapper">
        <h3><?php echo $lang['getlogs'] ?></h3>
        <div id="csv-wrapper-inside">
            <div><img src="csvfilelogo.png" alt="image of csv file"></div>
            <a href="export.php"><i class="dwn"></i>export</a>
            <a href="mail.php"><i class="dwn"></i>mail</a>
        </div>
    </div>
</section>
<section>
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
            <td class="tg-baqh"><?php echo $lang['doc_done'] ?></td>
            <td class="tg-baqh"><?php echo $lang['doc_task2'] ?></td>
            <td class="tg-0lax">Tomáš Minárik, Matúš Kuflík, Filip Kolenčík, Matej Bredik</td>
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
            <td class="tg-baqh"><?php echo $lang['doc_done'] ?></td>
            <td class="tg-baqh"><?php echo $lang['doc_task5'] ?></td>
            <td class="tg-0lax">Matej Bredik, Matúš Kuflík, Filip Kolenčík, Tomáš Minárik</td>
        </tr>
        <tr>
            <td class="tg-baqh"><?php echo $lang['doc_done'] ?></td>
            <td class="tg-baqh"><?php echo $lang['doc_task6'] ?></td>
            <td class="tg-0lax">Matej Bredik, Matúš Kuflík, Filip Kolenčík</td>
        </tr>
        <tr>
            <td class="tg-baqh"><?php echo $lang['doc_done'] ?></td>
            <td class="tg-baqh"><?php echo $lang['doc_task7'] ?></td>
            <td class="tg-0lax">Matej Bredik, Matúš Kuflík</td>
        </tr>
        <tr>
            <td class="tg-baqh"><?php echo $lang['doc_done'] ?></td>
            <td class="tg-baqh"><?php echo $lang['doc_task8'] ?></td>
            <td class="tg-0lax">Tomáš Minárik</td>
        </tr>
        <tr>
            <td class="tg-baqh"><?php echo $lang['doc_unfinished'] ?></td>
            <td class="tg-baqh"><?php echo $lang['doc_task9'] ?></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-baqh"><?php echo $lang['doc_accomplished'] ?></td>
            <td class="tg-baqh"><?php echo $lang['doc_task10'] ?></td>
            <td class="tg-0lax">Matej Bredik, Matúš Kuflík, Filip Kolenčík, Tomáš Minárik</td>
        </tr>
        <tr>
            <td class="tg-baqh"><?php echo $lang['doc_done'] ?></td>
            <td class="tg-baqh"><?php echo $lang['doc_task11'] ?></td>
            <td class="tg-0lax">Filip Kolenčík, Matej Bredik</td>
        </tr>
        </tbody>
    </table>
</section>

<section>
    <div id="target">
        <div class="descard">
            <h2><?php echo $lang['webfun'] ?></h2>
            <p><?php echo $lang['mpfun'] ?></p>
            <p><?php echo $lang['octfun'] ?></p>
            <p><?php echo $lang['docfun'] ?></p>

        </div>
        <h2 class="centerh2"><?php echo $lang['apidesc'] ?></h2>

        <div class="apicard">
            <h3 class="apireq">&nbsp;&nbsp;&nbsp;&nbsp;GET https://site109.webte.fei.stuba.sk/Webte2-zaverecne-zadanie/api/suspension</h3>
            <h4 class="apireq"><?php echo $lang['apiexample'] ?> https://site109.webte.fei.stuba.sk/Webte2-zaverecne-zadanie/api/suspension?key=abcd&r=0&start=0.1000068,4e-7,0.0000068,0.0000083,-0.0004246,5</h4>
            <div class="apicontent">
                <div class="apiparams">
                    <p><b><?php echo $lang['apiparams'] ?></b></p>
                    <p>key - <?php echo $lang['apikey'] ?></p>
                    <p>r - <?php echo $lang['apir'] ?></p>
                    <p>start - <?php echo $lang['apistart'] ?></p>
                </div>
                <div class="apiresult">
                    <p><b><?php echo $lang['apiresult'] ?></b></p>
                    <p>t - <?php echo $lang['apit'] ?></p>
                    <p>x - <?php echo $lang['apians'] ?></p>
                    <p>r - <?php echo $lang['apirback'] ?></p>
                </div>
            </div>
        </div>

        <div class="apicard">
            <h3 class="apireq">&nbsp;&nbsp;&nbsp;&nbsp;GET https://site109.webte.fei.stuba.sk/Webte2-zaverecne-zadanie/api</h3>
            <h4 class="apireq"><?php echo $lang['apiexample'] ?> https://site109.webte.fei.stuba.sk/Webte2-zaverecne-zadanie/api?key=abcd&command=1%2B1</h4>
            <div class="apicontent">
                <div class="apiparams">
                    <p><b><?php echo $lang['apiparams'] ?></b></p>
                    <p>key - <?php echo $lang['apikey'] ?></p>
                    <p>command - <?php echo $lang['apicommand'] ?></p>
                </div>
                <div class="apiresult">
                    <p><b><?php echo $lang['apiresult'] ?></b></p>
                    <p>ans - <?php echo $lang['apians'] ?></p>
                </div>
            </div>
        </div>

    </div>
</section>
<section>
    <button id="uploadtopdf" class="btn"><?php echo $lang['apibutton'] ?></button>
</section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
        integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--    <script type="text/javascript" src="pdfUpload.js"></script>-->
    <script>
        $(document).ready(function() {
            var specialElementHandlers = {
                "#editor": function (element, rendrer) {
                    return true;
                }
            };
        $('#uploadtopdf').click(function () {
            var myDocument = new jsPDF();
            myDocument.fromHTML($("#target").html(), 15, 15, {
                "width": 170,
                "elementHandlers": specialElementHandlers
            });
            myDocument.save("PopisAPI.pdf");
        });
        })
    </script>
</body>
</html>
