<h1>Create an account</h1>
<?php $form = \app\core\form\Form::begin("", "post")?>
      <?php echo $form->field($model, 'firstname') ;?>
      <?php echo $form->field($model, 'lastname') ;?>
      <?php echo $form->field($model, 'email') ;?>
      <?php echo $form->field($model, 'password') ;?>
      <?php echo $form->field($model, 'rpassword') ;?>
    <button type="submit" class="btn btn-primary">Register</button>
<?php \app\core\form\Form::end();?>
<!-- <form action ="" method="post">
  <div class="form-group">
   <label >Firstname</label><br>
    <input type="text" name="firstname" <?php echo $model->firstname;?>  <?php echo $model->hasError('firstname') ? ' is-invalid ' : "";?>class="form-control">
  </div>
  <div class="form-group">
   <label >Lastname</label><br>
    <input type="text" name="lastname" class="form-control">
  </div>
  <div class="form-group">
   <label >Email address</label><br>
    <input type="email" name="email" class="form-control">
  </div>
  <div class="form-group">
   <label >Password</label><br>
    <input type="password" name="password" class="form-control">
  </div>
  <div class="form-group">
   <label >Re-enter password</label><br>
    <input type="password" name="rpassword" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
</form> -->