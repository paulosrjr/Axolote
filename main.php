<?php require 'lib/libSys.php'; ?>
<?php require 'lib/libUserValidation.php'; ?>
<?php require_once 'lib/libConstant.php'; ?>
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
                    <h1>Dashboard</h1>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Resource Usage</h3>
                        </div>
                        <div class="panel-body center">
                            <div class="chart" data-percent="<?php echo dashGetLoad(); ?>">Load <?php echo dashGetLoad(); ?></div>
                            <div class="chart" data-percent="<?php echo dashGetCPU(); ?>">CPU <?php echo dashGetCPU(); ?>%</div>
                            <div class="chart" data-percent="<?php echo dashGetMemory(); ?>">Memory <?php echo dashGetMemory(); ?>%</div>
                            <div class="chart" data-percent="<?php echo dashCalculateFreePercent(PATH_LOCAL); ?>">Backup Disk <?php echo dashCalculateFreePercent("/backup/backups"); ?>%</div>
                            <div class="chart" data-percent="<?php echo dashCalculateFreePercent(PATH_STAGING); ?>">Staging Disk <?php echo dashCalculateFreePercent("/backup/staging"); ?>%</div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Messages - <?php echo dashGetTotalMessage(); ?> - 100%</h3>
                        </div>
                        <div class="panel-body">   

                            <b>Errors - <?php echo dashGetTotalErrors(); ?></b>
                            <div class="progress">    
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo dashGetTotalErrorsPercent(); ?>%;">
                                    <span><?php echo dashGetTotalErrorsPercent(); ?>%</span>
                                </div>
                            </div>
                            <b>Unknowns - <?php echo dashGetTotalUnknown(); ?></b>    
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo dashGetTotalUnknownPercent(); ?>%;">
                                    <span><?php echo dashGetTotalUnknownPercent(); ?>%</span>
                                </div>
                            </div>
                            <b>Warnings - <?php echo dashGetTotalWarning(); ?></b>    
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo dashGetTotalWarningPercent(); ?>%;">
                                    <span><?php echo dashGetTotalWarningPercent(); ?>%</span>
                                </div>
                            </div>    
                            <b>Success - <?php echo dashGetTotalSuccess(); ?></b>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo dashGetTotalSuccessPercent(); ?>%;">
                                    <span><?php echo dashGetTotalSuccessPercent(); ?>%</span>
                                </div>
                            </div>

                            <b>Information - <?php echo dashGetTotalInfo(); ?></b>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo dashGetTotalInfoPercent(); ?>%;">
                                    <span><?php echo dashGetTotalInfoPercent(); ?>%</span>
                                </div>
                            </div>

                        </div> 
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Errors in servers - Total  <?php echo dashGetTotalErrors(); ?></h3>
                        </div>
                        <div class="panel-body center">


                                <?php dashServerErrorBar(); ?>

                            
                        </div>
                    </div>

                    <!--<div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Top 5 more longest backups</h3>
                        </div>
                        <div class="panel-body center">
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
                                    <span>6h BKP-FWL10-LOG</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                                    <span>30m WEB99-PAGES</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                    <span>5m WEB99-DB</span>
                                </div>
                            </div> 
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 18%;">
                                    <span>2m WEB99SCRIPTS</span>
                                </div>
                            </div> 
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
                                    <span>1m WEB99LOG</span>
                                </div>
                            </div>         
                        </div>
                    </div>-->

                </div><!-- /col -->        
            </div><!-- /row -->
        </div><!-- /container -->
        <script>
            // Initialize Datatables
            $(document).ready(function () {
                $('.datatable').dataTable();
            });
        </script>
        <?php require 'footer.php'; ?>
    </body>
</html>