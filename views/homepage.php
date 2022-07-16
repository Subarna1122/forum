<h1>Hello! </h1><h3>Welcome <?php echo $name; ?></h3>
<form action ="" method="post">
  <div class="form-group">
   <h2> <label >username</label></h2><br>
    <input type="text" name="username" >
  </div>
  <div class="form-group">
    <h2><label>Question</label></h3>
    <textarea name="question" rows=5 cols=255></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>