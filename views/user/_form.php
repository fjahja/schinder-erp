<div class="box-body">

  <?php require('snippets/alerts.php'); ?>

  <div class="form-group">
    <label class="col-sm-2 control-label">Display Name</label>
    <div class="col-sm-10">
      <input
        type="text"
        class="form-control"
        placeholder="User display name"
        name="Form[display_name]"

        value="<?php echo $model['display_name']; ?>"
        autofocus="autofocus"
      >
      <p class="c-lightgrey mt-xs"><em>User display name</em></p>
    </div>
    
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Login Username</label>
    <div class="col-sm-10">
      <input
        type="text"
        class="form-control"
        placeholder="Login Username"
        name="Form[username]"

        value="<?php echo $model['username']; ?>"
      >
    </div>
    
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input
        type="password"
        class="form-control"
        placeholder="Password"
        name="Form[password]"

        value="<?php echo $model['password']; ?>"
      >
    </div>
    
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Position</label>
    <div class="col-sm-10">
      <input
        type="text"
        class="form-control"
        placeholder="Position"
        name="Form[position]"

        value="<?php echo $model['position']; ?>"
      >
    </div>
    
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input
        type="email"
        class="form-control"
        placeholder="User email"
        name="Form[email]"

        value="<?php echo $model['email']; ?>"
      >
    </div>
    
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Color</label>
    <div class="col-sm-10">
      <input 
        type="text" 
        value="<?php echo $model['color']; ?>"
        name="Form[color]"
        class="form-control my-colorpicker1"
      >
    </div>
    
  </div>

</div>

<div class="box-footer mt-sm">
  <a href="?o=<?php echo $page['model']; ?>&v=admin" class="btn btn-default">Cancel</a>
  <button type="submit" class="btn btn-info pull-right">Update</button>
</div>