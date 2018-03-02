

  <div class="box-body">

    <?php require('snippets/alerts.php'); ?>

    <div class="form-group">
      <label class="col-sm-2 control-label">Client</label>

      <div class="col-sm-10">
        <select class="form-control clientselect" name="Form[client]" required="required" autofocus="autofocus">
          <option selected="selected" value="" disabled="disabled">Select client</option>
          <?php echo $clientSelect['select']; ?>
        </select>
      </div>
    </div>

    <?php if (hasPermission($admin,array(214))): ?>
      <div class="form-group">
        <label class="col-sm-2 control-label">Agreement</label>

        <div class="col-sm-10">
          <select class="form-control agreement-select" name="Form[agreement]" required="required" autofocus="autofocus">
            <option selected="selected" value="" disabled="disabled">Select agreement</option>
            <option selected="selected" value="0">-- No agreement --</option>
            <? if ($model): ?>
              <? echo $agreement['view']; ?>
            <? endif ?>
          </select>
        </div>
      </div>
    <?php endif ?>

    <?php if ($_GET['v'] == 'create'): ?>
      <div class="form-group">
        <label class="col-sm-2 control-label">Assign to</label>

        <div class="col-sm-10">
          <select class="form-control select2 assignto-select" name="Form[assigned_to][]" multiple="multiple" data-placeholder="Select a user">
            <? echo $users['view']; ?>
          </select>
          <!-- <p class="c-lightgrey mt-xs"><em>The list will be populated with users able to participate in that client's tasks. Or assign to yourself if you want to use this to record your tasks.</em></p> -->
        </div>
      </div>
    <?php endif ?>

    <div class="form-group">
      <label class="col-sm-2 control-label">Subject</label>
      <div class="col-sm-10">
        <textarea
          class="form-control task-subject"
          placeholder="<?php echo ucwords($page['model']); ?> subject"
          name="Form[subject]"
          required="required"
          
          rows="5"
        ><?php echo $model['subject']; ?></textarea>
        <p class="c-lightgrey mt-xs"><em>Clear and concise task description help your contributors communicate effectively!</em></p>
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-2 control-label">Start on</label>
      <div class="col-sm-10">
        <input type="text" name="Form[start_date]" value="<?php echo ($model ? $model['start_date'] : ''); ?>" class="form-control pull-right" id="datepicker2">
        <br>
        <br>
        <p class="c-lightgrey mt-xs"><em>Leave blank if there is no start date.</em></p>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Due on</label>
      <div class="col-sm-10">
        <input type="text" name="Form[due_date]" value="<?php echo ($model ? $model['due_date'] : ''); ?>" class="form-control pull-right" id="datepicker2">
        <br>
        <br>
        <p class="c-lightgrey mt-xs"><em>Leave blank if there is no due date.</em></p>
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

    <div class="form-group">
      <label class="col-sm-2 control-label">Task description</label>

      <div class="col-sm-10">
        <textarea id="ticket_create" name="Form[issue]" class="textarea" placeholder="Task description"
        style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $model['issue']; ?></textarea>
      </div>
    </div>

    
  </div>
  <!-- /.box-body -->
  <div class="box-footer mt-sm">
    <a href="javascript:history.back()" class="pull-left btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-info pull-right">Save</button>
  </div>
  <!-- /.box-footer -->
