<!DOCTYPE html>
<html lang="rus">
<head>
        <script type="text/javascript">
            if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "jquery.watch.js", "jquery.musemenu.js", "style.css"], "outOfDate":[]};
         </script>
         
         <script type="text/javascript">
            document.documentElement.className += ' js';
         </script>



           <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
           <meta name="generator" content="2015.0.2.310"/>
           <link rel="shortcut icon" href="/favicon.ico">
           <title>Отследить посылку | Ваш курьер</title>
           <meta name="description" content="Курьерская служба «ВАШ КУРЬЕР» оказывает весь спектр услуг. Служба экспресс-доставки писем по выгодным ценам. Личный кабинет. Звоните +7 (495) 646-12-58.">
           <meta name="keywords" content="курьерская служба, курьерская доставка, служба экспресс-доставки писем, Москва">


<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/tracking.css">

</head>
<body>
    
<header class="header">
    <div class="container">
        <div class="header__inner">
        <div class="logo">
            <a href="#">
                <img src="images/delivery-truck2.png" alt="" width="200px">
            </a>
        </div>
        <div class="head__contacts">
            <div class="phone">  <img class="" src="images/telephone.png" alt="" width="22" height="22"/> +7 (495) 646-12-58</div>
            <div class="mail"><img class="imgMail" src="images/mail.png" alt="" width="22" />yc@y-courier.ru</div>
        </div>
        </div>
    </div>

</header>

<section class="top fon text-center">
    <div class="container contain">
            <h2 class="fon-heading">Курьерская доставка</h2>
            
            <div class="contain">   <a href="http://lk.y-courier.ru/user/login"><p><span  class="lk-block"><img id="u110_img" src="images/key.png" alt="" width="13" height="13"> &nbsp; Личный кабинет</span></p></a></div>
            
            
            <div class="fon-subheading">по Москве, по России, по Миру</div></div> <div class="fon-lead contain">
            Гарантия лучшей цены и сроков
        </div>

    </div>

</section>
<nav class="menu ">
<ul class="menu__list container">
    <li class="green"><a href="index.html">Главная</a></li>
    <li class="grey"><a href="https://lk.y-courier.ru/user/login">Личный кабинет</a></li>
    <li class="grey"><a href="kalkulaytor.html">Калькулятор</a></li>
    <li class="grey"><a href="svayz.html">Обратная связь</a></li>
    <li class="grey"><a href="#">Отследить груз</a></li>
    <li class="grey"><a href="vakansii.html">Вакансии</a></li>
    <li class="grey"><a href="dogovor.html">Заключить договор</a></li>
    <li class="green"><a href="kontacts.html">Контакты</a></li>

</ul>

</nav>

<section class="container"> 
    <div class="tracking">
        <?php

$login = "ФРЕГАТ 99";
$password = "parshkova";

        $track = isset($_POST['trackNumber']) ? $_POST['trackNumber'] : false;

        $error = false;

        if ($track) {
            $client = new SoapClient("http://web.cse.ru/cse82_reg/ws/web1c.1cws?wsdl",  array(
                    'trace' => true,
                    'soap_version' => SOAP_1_2,
                    'login' => 'web',
                    'password'=> 'web',
                )
            );

            $trackResult = $client->Tracking(
                array(
                    'login' => $login,
                    'password' => $password,
                    'documents' => array(
                        'Key' => 'Documents',
                        'Properties' => array(
                            'Key'  => 'DocumentType',
                            'Value' => 'Order',
                            'ValueType' => 'string'
                        ),
                        'List' => array(
                            'Key' => $track
                        )
                    )
                )
            );

            if (isset($trackResult->return->List->List))  {
                if (!is_array($trackResult->return->List->List))
                    $trackResult->return->List->List = array($trackResult->return->List->List);

                // Результат
                ?>

                <table>
                    <thead>
                    <tr>
                        <td>Дата</td>
                        <td>Информация</td>
                        <td>Операция</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($trackResult->return->List->List as $list){
                        $date = new DateTime($list->Properties[4]->Value);
                        $datetime = $date->format('d-m-y, H:i');
                        ?>
                        <tr>
                            <td><?php echo $datetime; ?></td>
                            <td><?php echo $list->Value; ?></td>
                            <td><?php echo $list->Key; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>

                <?php

            } else
                $error = true;

        }

        if (!$track || $error) {
            //форма
            ?>

            <form method="post">
                <label for="track">Номер заказа:</label>
                <input type="text" name="trackNumber" value="<?php echo $track; ?>">
                <?php if ($error) { ?>
                    <p>Введите валидный номер заказа.</p>
                <?php } ?>
                <button type="submit">Проверить</button>
            </form>

            <?php
        }
        ?>
        </div>
    </section>
    <footer class=" footer">
        <div class="container footer__inner">
         <ul class=" footer-nav">
            <li><a href="#">Главная</a></li>
            <li><a href="#">Личный кабинет</a></li>
            <li><a href="#">Калькулятор</a></li>
            <li><a href="#">Обратная связь</a></li>
            <li><a href="#">Отследить груз</a></li>
            <li><a href="#">Вакансии</a></li>
            <li><a href="#">Заключить договор</a></li>
            <li><a href="#">Контакты</a></li>
         </ul>
        <div class="footer__phone">
                <img class="phone__footer" src="images/telephone.png" alt="" width="22" height="22"/> +7 (495) 646-12-58
        </div>
        </div>
    </footer>


 <!-- JS includes -->
 <script type="text/javascript">
    if (document.location.protocol != 'https:') document.write('\x3Cscript src="http://musecdn.businesscatalyst.com/scripts/4.0/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
 </script>
   <script type="text/javascript">
    window.jQuery || document.write('\x3Cscript src="scripts/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
 </script>
   <script src="scripts/museutils.js?275725342" type="text/javascript"></script>
   <script src="scripts/jquery.watch.js?3999102769" type="text/javascript"></script>
   <script src="scripts/jquery.musemenu.js?4042164668" type="text/javascript"></script>
   <!-- Other scripts -->
   <script type="text/javascript">
    $(document).ready(function() { try {
 (function(){var a={},b=function(a){if(a.match(/^rgb/))return a=a.replace(/\s+/g,"").match(/([\d\,]+)/gi)[0].split(","),(parseInt(a[0])<<16)+(parseInt(a[1])<<8)+parseInt(a[2]);if(a.match(/^\#/))return parseInt(a.substr(1),16);return 0};(function(){$('link[type="text/css"]').each(function(){var b=($(this).attr("href")||"").match(/\/?css\/([\w\-]+\.css)\?(\d+)/);b&&b[1]&&b[2]&&(a[b[1]]=b[2])})})();(function(){$("body").append('<div class="version" style="display:none; width:1px; height:1px;"></div>');
 for(var c=$(".version"),d=0;d<Muse.assets.required.length;){var f=Muse.assets.required[d],g=f.match(/([\w\-\.]+)\.(\w+)$/),k=g&&g[1]?g[1]:null,g=g&&g[2]?g[2]:null;switch(g.toLowerCase()){case "css":k=k.replace(/\W/gi,"_").replace(/^([^a-z])/gi,"_$1");c.addClass(k);var g=b(c.css("color")),h=b(c.css("background-color"));g!=0||h!=0?(Muse.assets.required.splice(d,1),"undefined"!=typeof a[f]&&(g!=a[f]>>>24||h!=(a[f]&16777215))&&Muse.assets.outOfDate.push(f)):d++;c.removeClass(k);break;case "js":k.match(/^jquery-[\d\.]+/gi)&&
 typeof $!="undefined"?Muse.assets.required.splice(d,1):d++;break;default:throw Error("Unsupported file type: "+g);}}c.remove();if(Muse.assets.outOfDate.length||Muse.assets.required.length)c="Некоторые файлы на сервере могут отсутствовать или быть некорректными. Очистите кэш-память браузера и повторите попытку. Если проблему не удается устранить, свяжитесь с разработчиками сайта.",(d=location&&location.search&&location.search.match&&location.search.match(/muse_debug/gi))&&Muse.assets.outOfDate.length&&(c+="\nOut of date: "+Muse.assets.outOfDate.join(",")),d&&Muse.assets.required.length&&(c+="\nMissing: "+Muse.assets.required.join(",")),alert(c)})()})();
 /* body */
 Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
 Muse.Utils.prepHyperlinks(true);/* body */
 Muse.Utils.resizeHeight()/* resize height */
 Muse.Utils.initWidget('.MenuBar', function(elem) { return $(elem).museMenu(); });/* unifiedNavBar */
 Muse.Utils.fullPage('#page');/* 100% height page */
 Muse.Utils.showWidgetsWhenReady();/* body */
 Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
 } catch(e) { if (e && 'function' == typeof e.notify) e.notify(); else Muse.Assert.fail('Error calling selector function:' + e); }});
 </script>
</body>
</html>