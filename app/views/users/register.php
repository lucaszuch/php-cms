<?php require APP_ROOT . '/views/inc/header.php'; ?>
<div class="row">
  <h1>REGISTER</h1>
</div>
<div class="row">
  <div class="col-md-6 mx-auto">
    <form action="<?= APP_ROOT ?>/users/register" method="POST">
      <div class="form-group mt-3">
        <label for="name">Name: <sup>*</sup></label>
        <input type="text" name="name" class="form-control" />
      </div>
      <div class="form-group mt-3">
        <label for="email">Email: <sup>*</sup></label>
        <input type="email" name="email" class="form-control" />
      </div>
      <div class="form-group mt-3">
        <label for="email">Password: <sup>*</sup></label>
        <input type="password" name="Password" class="form-control" />
      </div>
      <div class="form-group mt-3">
        <label for="email">Confirm password: <sup>*</sup></label>
        <input type="password" name="Confirm password" class="form-control" />
      </div>
      <div class="row">
        <div class="col-md-4 mx-auto">
          <button type="submit" class="btn btn-success mt-3">SUBMIT</button>
        </div>
        <div class="col-md-8 mx-auto d-flex align-items-center">
          <a href="<?= URL_LINK ?>/users/login">
            Already have an account?
          </a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>