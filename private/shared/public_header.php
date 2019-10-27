<!DOCTYPE html>
<html lang="utf-8">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>البنك الدولي - <?php echo isset($page_title) ? h($page_title) : 'الصفحة الرئيسية'; ?> </title>
    <link rel="stylesheet" media="all" href="<?= url_for('lib/bootstrap/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" media="all" href="<?= url_for('/lib/bootstrap/css/bootstrap_rtl.css') ?>" />
    <link rel="stylesheet" media="all" href="<?= url_for("/stylesheets/public.css") ?>">
    <link rel="icon" href="<?= url_for('/images/bank-icon.png') ?>">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm bg-primary navbar-dark fixed">
            <div class="container">
                <h1 class='navbar-brand'>
                    <a href="<?= url_for('/index.php') ?>">
                        <img src="<?= url_for('/images/bank-icon.png') ?>" alt="البنك الدولي">
                    </a>
                   <span> البنك الدولي </span>
                </h1>
            </div>
        </nav>

    </header>