<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MVC - PHP</title>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css">
        <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?>
    </head>
    <body>
        <header>
            <div id="user"><em><?= $_SESSION['userlastname']." ".$_SESSION['userfirstname']." ".$_SESSION['(']." ".$_SESSION['nickname']." ".$_SESSION[')'] ?></em></div>
            <h1 class="header">Hulladékszállító Nonprofit Kft </h1>
        </header>
        <nav>
            <?php echo Menu::getMenu($viewData['selectedItems']); ?>
        </nav>
		<img src=".\images\01.jpg" alt="Hulladek" align=left>
        <section>
            <?php if($viewData['render']) include($viewData['render']); ?>
        </section>
        <footer>&copy; Web Programozás II Jónás Mihály, Szélig Zsolt <?= date("Y") ?></footer>
    </body>
</html>
