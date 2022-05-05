<?php require APP_ROOT . '/views/inc/header.php'; ?>
<div class="row">
  <?php flash_message('register_ok'); ?>
  <h1>LOGIN</h1>
</div>
<div class="row">
  <div class="col-md-6 mx-auto">
    <form action="<?= URL_LINK ?>/users/login" method="POST">
      <div class="form-group mt-3">
        <label for="email">Email: <sup>*</sup></label>
        <input type="email" name="email" class="form-control" />
      </div>
      <div class="form-group mt-3">
        <label for="email">Password: <sup>*</sup></label>
        <input type="password" name="password" class="form-control" />
      </div>
      <div class="row">
        <div class="col-md-4 mx-auto mt-3">
          <button type="submit" class="btn btn-success">SUBMIT</button>
        </div>
        <div class="col-md-8 mx-auto d-flex align-items-center">
          <a href="<?= URL_LINK ?>/users/register">
            Not registered?
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>