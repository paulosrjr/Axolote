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
      <script>
          $(document).ready(function(){
              $('th.sorting').click(function(){
                  console.log('entrou');
                  $('#btnSearchBackupsByServer').trigger('submit');
              });
          });
      </script>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h1>Backups</h1>
           
          </br></br>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="cmbServer">Choose a server to show backups</label>
            <div class="col-sm-4">
              <select class="combobox form-control" id="cmbBackupServer">
                <option value="" selected="selected">Select a Server</option>
                <?php cmbBackupServer(); ?>
              </select>
            </div>
            <button class="btn btn-default" id="btnSearchBackupsByServer">List</button>
          </div>
          </br></br>
          
      <table class="datatable table table-striped table-bordered">
        <thead>
          <tr>
            <th>Work</th>
            <th>Server</th>
            <th>Date and Time</th>
            <th>Backup Duration</th>
            <th>Backup File</th>
            <!-- <th>Delete</th> -->
          </tr>
        </thead>
        
         <tbody id="backupDatatable">          
            
         </tbody>
         
      </table>
        </div><!-- /col -->
      </div><!-- /row -->
    </div><!-- /container -->
     <?php require 'footer.php'; ?>
  </body>
</html>