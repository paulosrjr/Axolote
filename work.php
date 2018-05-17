<?php require 'lib/libSys.php'; ?>
<?php require 'lib/libUserValidation.php'; ?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8"><![endif]-->
<!--[if IE 9]><html class="ie9"><![endif]-->
<!--[if gt IE 9]><!-->
<html>
<!--<![endif]-->
  <?php require 'header.php'; ?>
  <body>     
  <?php require 'menu.php'; ?>     
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h1>Works</h1>

<!-- INSERT NEW WORK BUTTON-->
</br></br>
<button class="btn btn-default bt" data-toggle="modal" data-target="#newWork">New Work</button>
<button class="btn btn-default" id="btnReload">Reload Table</button>
<!-- END NEW WORK MODAL BUTTON-->

<!-- INSERT NEW WORK MODAL FORM-->
<div class="modal fade" id="newWork" tabindex="-1" role="dialog" aria-labelledby="newWorkLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <span class="pficon pficon-close"></span>
        </button>
        <h4 class="modal-title" id="newWorkLabel">Insert a new work</h4>
      </div>
      <div class="modal-body">
          <div class="alert alert-info" id="workInfo">
                <span class="pficon pficon-info"></span>
                <div id="workInfoText">&nbsp;</div>
          </div>
        <form class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtIdent">Identificator</label>
            <div class="col-sm-9">
              <input type="text" id="txtIdent" class="form-control"></div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="cmbServer">Server</label>
            <div class="col-sm-9">
                
              <select class="combobox form-control" id="cmbServer">
                <option value="" selected="selected">Select a Server</option>
                <?php cmbNewWorkServer(); ?>
              </select>
                
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="cmbType">Backup Type</label>
            <div class="col-sm-9">
              
               <select class="combobox form-control" id="cmbType">
                <option value="" selected="selected">Select a Type</option>
                <?php cmbNewWorkType(); ?>
              </select>
                
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnSaveWork">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- END NEW WORK MODAL FORM-->

<!-- UPDATE WORK MODAL FORM-->
<div class="modal fade" id="updateWork" tabindex="-1" role="dialog" aria-labelledby="updateWorkLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <span class="pficon pficon-close"></span>
        </button>
        <h4 class="modal-title" id="updateWorkLabel">Update Work Job</h4>
      </div>
      <div class="modal-body">         
       
          <div class="alert alert-info" id="workInfoUpdate">
                <span class="pficon pficon-info"></span>
                <div id="workInfoTextUpdate">&nbsp;</div>
          </div>
          
          <input id="WorkID" type="hidden" value="">
          <span id="workEdit"></span>        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnUpdateWork">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- END UPDATE WORK MODAL FORM-->

<!-- CONFIRM WORK EXCLUSION MODAL FORM-->
<div class="modal fade" id="deleteWork" tabindex="-1" role="dialog" aria-labelledby="deleteWorkLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <span class="pficon pficon-close"></span>
        </button>
        <h4 class="modal-title" id="deleteWorkLabel">Confirm exclusion?</h4>
      </div>
      <div class="modal-body">         
          
          <div class="alert alert-info" id="workInfoDelete">
                <span class="pficon pficon-info"></span>
                <div id="workInfoTextDelete">&nbsp;</div>
          </div>
          If you delete this work (job), all backup files will be too. Are you right about of this?
          <input id="WorkID" type="hidden" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary bt" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger bt" id="btnDeleteWork">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- END CONFIRM WORK EXCLUSION MODAL FORM-->

<!-- DATATABLES LIST-->          
      <table class="datatable table table-striped table-bordered">
        <thead>
          <tr>
            <th>Identificator</th>
            <th>Server</th>
            <th>User</th>
            <th>Type</th>
            <th>Options</th>
          </tr>
        </thead>
        
        <tbody>                
        <?php workDatatable(); ?>         
        </tbody>
        
      </table>
        </div><!-- /col -->
      </div><!-- /row -->
    </div><!-- /container -->
    <?php require 'footer.php'; ?>
  </body>
</html>