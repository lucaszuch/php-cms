<?php require APP_ROOT . '/views/inc/header.php'; ?>
<div class="row">
  <?php flash_message('invalid_title'); ?>
  <?php flash_message('invalid_content'); ?>
  <h1>NEW POST</h1>
</div>
<div class="row">
  <div class="col-12 mx-auto">
    <form action="<?= URL_LINK ?>/posts/add" method="POST">
      <div class="form-group mt-3">
        <label for="email">Title: <sup>*</sup></label>
        <input type="title" name="title" class="form-control" />
      </div>
      <div class="form-group mt-3">
        <label for="email">Content: <sup>*</sup></label>
        <textarea type="content" name="content" rows="10" class="form-control"></textarea>
      </div>
      <div class="row">
        <div class="col-4 mt-3">
          <button type="submit" class="btn btn-success">SUBMIT</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>