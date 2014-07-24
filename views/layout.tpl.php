<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>Doctrine-Skeleton</title>
    <link type="text/css" rel="stylesheet" href="css/stylesheet.css"/>
</head>

<body>
    <header>
        <h1>Doctrine-Skeleton</h1>
    </header>

    <?php require_once '_navi.tpl.php'; ?>
    <?php require_once '_flash_message.tpl.php'; ?>
    <?php require_once '_errors.tpl.php'; ?>

    <section>
        <?php require_once $view . '.tpl.php'; ?>
    </section>
</body>
</html>