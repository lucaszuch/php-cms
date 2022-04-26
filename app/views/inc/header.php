<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Stylesheets -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= URL_LINK ?>/assets/css/style.css">
  <!-- Scripts -->
  <script src="https://kit.fontawesome.com/4bec2e0f4c.js" crossorigin="anonymous"></script>
  <!-- Main Title -->
  <title><?= SITE_NAME ?></title>
</head>

<body>
  <header>
    <?php require APP_ROOT . '/views/inc/navbar.php'; ?>
  </header>
  <!-- The main container tag will be closed at the footer -->
  <div class="container">