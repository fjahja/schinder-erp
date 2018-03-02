<?php $model['id'] = (isset($model['id']) ? $model['id'] : NULL); ?>

<div id="ticketSearchById" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">

        <form action="index.php" method="get">
          <div class="input-group">

              <input type="hidden" name="o" value="ticket">
              <input type="hidden" name="v" value="admin">
              <input type="hidden" name="searchtype" value="byid">
              <input type="hidden" name="status" value="all">
              
              <input
                id="focusfirst"
                type="text"
                class="form-control"
                placeholder="Search task by #id" 
                name="search"

                required="required"
              >
              <span class="input-group-btn">
                <button class="btn btn-default" type="sumbit">Go!</button>
              </span>
            
            </div><!-- /input-group -->

          </form>
      </div>
    </div>
  </div>
</div>

<div id="ticketSearchBySubject" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">

        <form action="index.php" method="get">
          <div class="input-group">

              <input type="hidden" name="o" value="ticket">
              <input type="hidden" name="v" value="admin">
              <input type="hidden" name="searchtype" value="bysubject">
              <input type="hidden" name="status" value="all">
              
              <input
                id="focusfirst"
                type="text"
                class="form-control"
                placeholder="Search task by subject" 
                name="search"

                required="required"
              >
              <span class="input-group-btn">
                <button class="btn btn-default" type="sumbit">Go!</button>
              </span>
            
            </div>

          </form>
      </div>
    </div>
  </div>
</div>

<div id="crmctSearchByName" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">

        <form action="index.php" method="get">
          <div class="input-group">

              <input type="hidden" name="o" value="crm_contact">
              <input type="hidden" name="v" value="admin">
              <input type="hidden" name="searchtype" value="byname">
              <input type="hidden" name="status" value="all">
              
              <input
                id="focusfirst"
                type="text"
                class="form-control"
                placeholder="Search contact by name" 
                name="search"

                required="required"
              >
              <span class="input-group-btn">
                <button class="btn btn-default" type="sumbit">Go!</button>
              </span>
            
            </div>

          </form>
      </div>
    </div>
  </div>
</div>

<div id="crmaccSearchByName" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">

        <form action="index.php" method="get">
          <div class="input-group">

              <input type="hidden" name="o" value="crm_company">
              <input type="hidden" name="v" value="admin">
              <input type="hidden" name="searchtype" value="byname">
              <input type="hidden" name="status" value="all">
              
              <input
                id="focusfirst"
                type="text"
                class="form-control"
                placeholder="Search companies by name" 
                name="search"

                required="required"
              >
              <span class="input-group-btn">
                <button class="btn btn-default" type="sumbit">Go!</button>
              </span>
            
            </div>

          </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="ticketDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm delete</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this record?</p>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

        <form action="crud/ticket.php?v=delete" method="post" class="inline">

          <input type="hidden" name="Form[id]" value="<?php echo $model['id']; ?>">
          <input type="hidden" name="Form[return]" value="index.php?o=ticket&v=admin&alert=deleted">

          <button type="submit" class="btn btn-primary">Confirm</button>

        </form>
        
      </div>
    </div>
  </div>
</div>
