<?php 
/** @var $model \app\model\RegisterModel;*/
?>
<h1>Login</h1>
<?php $form = \app\core\form\Form::begin("", "post")?>
      <?php echo $form->field($model, 'email') ;?>
      <?php echo $form->field($model, 'password')->passwordField() ;?>
    <button type="submit" class="btn btn-primary">Register</button>
<?php \app\core\form\Form::end();?>
