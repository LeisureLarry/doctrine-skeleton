<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Doctrine-Skeleton</title>
    <link type="text/css" rel="stylesheet" href="css/stylesheet.css" />
</head>

<body>
    <header>
        <h1>Doctrine-Skeleton</h1>
    </header>

    <?php require_once 'navi.tpl.php'; ?>
    <?php require_once 'flash_message.tpl.php'; ?>
    <?php require_once 'errors.tpl.php'; ?>

    <section>
        <?php require_once $template; ?>
    </section>
</body>
</html>