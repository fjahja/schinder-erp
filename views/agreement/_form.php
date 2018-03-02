  <div class="box-body">

    <?php require('snippets/alerts.php'); ?>

    <div class="form-group">
      <label class="col-sm-2 control-label">Agreement Number</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          placeholder="Agreement Number"
          name="Form[agreement_number]"
          required="required"
          autofocus="autofocus"
          value="<?php echo $model['agreement_number']; ?>"
        >
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Value (IDR)</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          placeholder="Value"
          name="Form[agreement_value]"
          required="required"
          value="<?php echo $model['agreement_value']; ?>"
          data-inputmask="'alias': 'ip'" 
          data-mask=""
        >
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-2 control-label">Agreement Date</label>
      <div class="col-sm-10">
        <input type="text" name="Form[agreement_date]" value="<?php echo ($model ? $model['agreement_date'] : date('Y-m-d')); ?>" class="form-control" id="datepicker2" required="required">
        <p class="c-lightgrey mt-xs"><em>Date written on the agreement. </em></p>
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-2 control-label">Signed Date</label>
      <div class="col-sm-10">
        <input type="text" name="Form[signed_date]" value="<?php echo ($model ? $model['signed_date'] : ''); ?>" class="form-control" id="datepicker2">
        <p class="c-lightgrey mt-xs"><em>Date when the agreement is signed. Leave blank if the agreement has not been signed.</em></p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Client</label>

      <div class="col-sm-10">
        <select class="form-control" name="Form[client]" required="required">
          <option selected="selected" value="" disabled="disabled">Select client</option>
          <?php echo $clientSelect['select']; ?>
        </select>
      </div>
    </div>
    

    <div class="form-group">
      <label class="col-sm-2 control-label">Category</label>

      <div class="col-sm-10">
        <select class="form-control" name="Form[category]" required="required">
          <?php echo $categorySelect['select']; ?>
        </select>
      </div>
    </div>

    
  </div>
  <!-- /.box-body -->
  <div class="box-footer mt-sm">
    <a href="javascript:history.back()" class="pull-left btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-info pull-right">Save</button>
  </div>
  <!-- /.box-footer -->
