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
          <h1>Servers</h1>

<!-- INSERT NEW SERVER -->
</br></br>
<button class="btn btn-default" data-toggle="modal" data-target="#newServer">New Server</button>
<button class="btn btn-default" id="btnReload">Reload Table</button>
<div class="modal fade" id="newServer" tabindex="-1" role="dialog" aria-labelledby="newServerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <span class="pficon pficon-close"></span>
        </button>
        <h4 class="modal-title" id="newServerLabel">Insert a new server</h4>
      </div>     
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="alert alert-info" id="serverInfo">
                <span class="pficon pficon-info"></span>
                <div id="serverInfoText">&nbsp;</div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtName">Name</label>
            <div class="col-sm-9">
              <input type="text" id="txtName" class="form-control"></div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtIP">IP</label>
            <div class="col-sm-9">
              <input type="text" id="txtIP" class="form-control"></div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="txtDescription">Comments</label>
            <div class="col-sm-9">
              <input type="text" id="txtDescription" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnSaveServer">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- END INSERT NEW SERVER -->

<!-- DELETE SERVER -->
<div class="modal fade" id="deleteServer" tabindex="-1" role="dialog" aria-labelledby="deleteServerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <span class="pficon pficon-close"></span>
        </button>
        <h4 class="modal-title" id="deleteServerLabel">Confirm exclusion?</h4>
      </div>
      <div class="modal-body">         
          
          <div class="alert alert-info" id="serverInfoDelete">
                <span class="pficon pficon-info"></span>
                <div id="serverInfoTextDelete">&nbsp;</div>
          </div>
          If you delete this server, all works (jobs) and backup files, will be too. Are you right about of this?
          <input id="ServerID" type="hidden" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary bt" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger bt" id="btnDeleteServer">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- END DELETE SERVER -->

<!-- DATATABLES LIST-->
      <table class="datatable table table-striped table-bordered" id="serverDatatable">
        <thead>
          <tr>
            <th>Server</th>
            <th>IP</th>
            <th>Description</th>
            <th>Total Work</th>
            <th>Options</th>
          </tr>
        </thead>
        
        <tbody>
        <?php serverDatatable(); ?>       
        </tbody>
        
      </table>
        </div><!-- /col -->
      </div><!-- /row -->
    </div><!-- /container -->
     <?php require 'footer.php'; ?>
  </body>
</html>