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
                    <h1>Logs</h1>
                    <!--</br></br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="cmbServer">Choose a server to show log</label>
                        <div class="col-sm-4">
                            <select class="combobox form-control" id="cmbServer">
                                <option value="" selected="selected">Select a Server</option>
                                <option>Server 1</option>
                                <option>Server 2</option>
                                <option>Server 3</option>
                            </select>
                        </div>
                    </div>-->
                    </br></br>

                    <table class="datatable table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Work</th>
                                <th>Status</th>
                                <th>Date and Time</th>
                                <th>Log</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php logDatatable(); ?>
                        </tbody>
                    </table>
                </div><!-- /col -->
            </div><!-- /row -->
        </div><!-- /container -->
        <?php require 'footer.php'; ?>
    </body>
</html>