<div class="box-body">

  <?php require('snippets/alerts.php'); ?>

  <div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input
        type="text"
        class="form-control"
        placeholder="CRM contact name"
        name="Form[name]"

        value="<?php echo $model['name']; ?>"
        autofocus="autofocus"
      >
      <!-- <p class="c-lightgrey mt-xs"><em>Naming rule: Department - Category</em></p> -->
    </div>
    
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Notes</label>
    <div class="col-sm-10">
      <textarea
        type="text"
        class="form-control"
        placeholder="Notes"
        name="Form[notes]"
      ><?php echo $model['notes']; ?></textarea>
      <p class="c-lightgrey mt-xs"><em>additional notes ie. when/where/how do you meet this person? </em></p>
    </div>
  </div>

</div>
<!-- /.box-body -->
<div class="box-footer mt-sm">
  <a href="?o=<?php echo $page['model']; ?>&v=admin" class="btn btn-default">Cancel</a>
  <button type="submit" class="btn btn-info pull-right">Save</button>
</div>
<!-- /.box-footer -->