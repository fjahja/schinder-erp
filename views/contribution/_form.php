  <div class="box-body">

    <?php require('snippets/alerts.php'); ?>

    <input type="hidden" class="start-timestamp" value="">
    <input type="hidden" class="end-timestamp" value="">

    <? if (hasPermission($admin,array(219)) && $_GET['v'] == 'request_backtrack'): ?>
      
      <div class="form-group">
        <label class="col-sm-2 control-label">Task</label>
        <div class="col-sm-10">
          <select
            class="form-control"
            required="required"
            name="Form[ticket]"
          >
            <option value="" disabled="disabled" selected="selected">-- Select tasks --</option>
            <? echo $tasks['view']; ?>
          </select>
        </div>
      </div>

    <? else: ?>

      <div class="form-group">
        <label class="col-sm-2 control-label">Task</label>
        <div class="col-sm-10">
          <input
            type="text"
            class="form-control"
            value="#<?php echo $ticket['id']; ?> - <?php echo $ticket['subject']; ?>"
            disabled="disabled"
          >
        </div>
      </div>

    <? endif; ?>

    

    <?php if ($_GET['v'] == 'update'): ?>
      <div class="form-group">
        <label class="col-sm-2 control-label">Contribution ID</label>
        <div class="col-sm-10">
          <input
            type="text"
            class="form-control"
            value="C<?php echo $model['id']; ?>"
            disabled="disabled"
          >
        </div>
      </div>
    <?php endif ?>

    <?php if ( hasPermission($admin,array(45,219)) && ($_GET['v'] == 'create_backtrack' OR $_GET['v'] == 'request_backtrack') ): ?>

      <?php if (hasPermission($admin,array(45)) && $_GET['v'] == 'create_backtrack'): ?>
        <div class="form-group">
          <label class="col-sm-2 control-label">User</label>

          <div class="col-sm-10">
            <select class="form-control clientselect" name="Form[user]" required="required">
              <option selected="selected" value="" disabled="disabled">Select user</option>
              <?php echo $userSelect['view']; ?>
            </select>
          </div>
        </div>
      <?php endif ?>

      <div class="form-group">
        <label class="col-sm-2 control-label">Start</label>
        <div class="col-sm-2">
          <div class="bootstrap-timepicker">
           <input type="text" class="form-control timepicker backtrack-start-time" name="Form[start_time]"
            <?php if (!$model): ?>
              value="<?php echo substr(date('H:i'),0,-2) . 00; ?>"
            <?php else: ?>
              value="<?php echo $model['start_time']; ?>"
            <?php endif; ?>
           >
          </div>
        </div>
        <div class="col-sm-8">
          <input type="text" name="Form[start_date]" class="form-control pull-right backtrack-start-date" id="datepicker"
          <?php if (!$model): ?>
            value="<?php echo date('Y-m-d'); ?>"
          <?php else: ?>
            value="<?php echo $model['start_date']; ?>"
          <?php endif; ?>
          >
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">End</label>
        <div class="col-sm-2">
          <div class="bootstrap-timepicker">
           <input type="text" class="form-control timepicker backtrack-end-time" name="Form[end_time]"
            <?php if (!$model): ?>
              value="<?php echo substr(date('H:i'),0,-2) . 00; ?>"
            <?php else: ?>
              value="<?php echo $model['end_time']; ?>"
            <?php endif; ?>
           >
          </div>
        </div>
        <div class="col-sm-8">
          <input type="text" name="Form[end_date]" class="form-control pull-right backtrack-end-date" id="datepicker"
          <?php if (!$model): ?>
            value="<?php echo date('Y-m-d'); ?>"
          <?php else: ?>
            value="<?php echo $model['end_date']; ?>"
          <?php endif; ?>
          >
        </div>
      </div>

    <?php endif ?>

    <div class="form-group">
      <label class="col-sm-2 control-label">Subject</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control"
          placeholder="<?php echo ucwords($page['model']); ?> subject"
          name="Form[subject]"
          value="<?php echo $model['subject']; ?>"
          required="required"
          autofocus="autofocus"
        >
        <p class="c-lightgrey mt-xs"><em>Which part of the task are you contributing?</em></p>
      </div>
    </div>

    <?php if ( hasPermission($admin,array(45,219)) && ($_GET['v'] == 'create_backtrack' OR $_GET['v'] == 'request_backtrack') ): ?>
      <hr>

      <div class="form-group">
        <label class="col-sm-2 control-label">Calculated Duration</label>
        <div class="col-sm-10 calc-duration">
          <p class="c-lightgrey mt-xs"><em>0 minutes</em></p>
        </div>
      </div>

    <?php endif ?>


    
  </div>
  <!-- /.box-body -->
  <div class="box-footer mt-sm">
    <a href="javascript:history.back()" class="pull-left btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-info pull-right">Save</button>
  </div>
  <!-- /.box-footer -->
