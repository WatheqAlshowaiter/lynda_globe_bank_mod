<!doctype html>

<html lang="utf-8">

<head>
  <title>البنك الدولي - <?php echo isset($page_title) ? h($page_title) : 'منطقة الموظفين'; ?> </title>
  <meta charset="utf-8"> <!-- ?= is shortcut for echo. php 7 -->
  <link rel="stylesheet" media="all" href="<?= url_for('lib/bootstrap/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" media="all" href="<?= url_for('/lib/bootstrap/css/bootstrap_rtl.css') ?>" />
  <link rel="stylesheet" media="all" href="<?= url_for('/stylesheets/staff.css') ?>" />
  <link rel="icon" href="<?= url_for('/images/bank-icon.png')?>">


</head>

<body>
  <header>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark fixed">
      <div class="container">
        <h1 class='navbar-brand'> البنك الدولي - خاص بالموظفين </h1>

      </div>
    </nav>

  </header>

  <div class="text-center py-4" id="staff_menu">
    <a href="<?= url_for('staff/index.php'); ?>">القائمة الرئيسية</a> | <!-- ?= is shortcut for echo. php 7 -->
    <span>المستخدم: <?= $_SESSION["username"]??"";?></span> |
    <a href="<?= url_for('staff/logout.php'); ?>">تسجيل الخروج</a>
    
  </div>

  <?= display_session_msg(); ?>