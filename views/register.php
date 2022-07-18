<?php 
/** @var $model \app\model\RegisterModel;*/
?>

<h1>Create an account</h1>
<?php $form = \app\core\form\Form::begin("", "post")?>
      <?php echo $form->field($model, 'firstname') ;?>
      <?php echo $form->field($model, 'lastname') ;?>
      <?php echo $form->field($model, 'email') ;?>
      <?php echo $form->field($model, 'password')->passwordField() ;?>
      <?php echo $form->field($model, 'rpassword')->passwordField() ;?>
    <button type="submit" class="btn btn-primary">Register</button>
<?php \app\core\form\Form::end();?>
