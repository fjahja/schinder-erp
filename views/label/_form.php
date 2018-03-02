<div class="box-body">

  <?php require('snippets/alerts.php'); ?>

  <div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input
        type="text"
        class="form-control"
        placeholder="Label name"
        name="Form[tag]"
        autofocus="autofocus"
        value="<?php echo $model['tag']; ?>"
      >
      <p class="c-lightgrey mt-xs"><em>Maximum char: 25</em></p>
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

  <div class="form-group">
    <label class="col-sm-2 control-label">Explanation</label>
    <div class="col-sm-10">
      <input
        type="text"
        class="form-control"
        placeholder="Label explanation"
        name="Form[explanation]"
        value="<?php echo $model['explanation']; ?>"
      >
    </div>
  </div>

</div>
<!-- /.box-body -->
<div class="box-footer mt-sm">
  <a href="?o=<?php echo $page['model']; ?>&v=admin" class="btn btn-default">Cancel</a>
  <button type="submit" class="btn btn-info pull-right">Save</button>
</div>
<!-- /.box-footer -->