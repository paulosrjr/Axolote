<?php require_once 'lib/libUserValidation.php'; ?>
<script>
      // Initialize Datatables
      $(document).ready( function() {
        $('.datatable').dataTable();
        $('.selectpicker').selectpicker();
        $('.combobox').combobox();
        
        $('#serverInfo').hide();
        $('#serverInfoDelete').hide();
        $('#workInfo').hide();
        $('#workInfoDelete').hide();
        $('#workInfoUpdate').hide();
        
        $('#txtIP').mask('099.099.099.099');
        $("#btnReload").click(function(){ location.reload(true); });
        
        $(function() {
        $('.chart').easyPieChart({
          animate: 1000,
          size: 150
        });
        });
        
   
//SERVER        
        $("#btnSaveServer").click(function(){
            //alert("Value: " + $("#txtName").val());
            $.post("kernel.php",
                {
                    page: "server",
                    name: $("#txtName").val(),
                    ip: $("#txtIP").val(),
                    description: $("#txtDescription").val()
                },
            function(data){
                    //alert(data);
                    //$('#newServer').modal('hide');
                    $('#serverInfoText').html(data);
                    $('#serverInfo').show().delay(7000).hide(1000);
                    if(data.indexOf("Success") > -1) { location.reload(true); }
                });
        });
        
        $("#btnDeleteServer").click(function(){
            //alert("Value: " + $("#txtName").val());
            $.post("kernel.php",
                {
                    page: "del-server",
                    idserver: $("#ServerID").val()
                },
            function(data){
                    $('#serverInfoTextDelete').html(data);
                    $('#serverInfoDelete').show().delay(7000).hide(1000);
                    if(data.indexOf("Success") > -1) { location.reload(true); }
                });
        });

        $(".btnOptionsDeleteServer").click(function(){
            //alert("Value: " + $(this).val());
            var value = $(this).val();
            $('#ServerID').val(value);
        });
        
//WORK        
        $("#btnSaveWork").click(function(){
            //alert("Value: " + $("#txtName").val());
            $.post("kernel.php",
                {
                    page: "work",
                    identificator: $("#txtIdent").val(),
                    idserver: $("#cmbServer").val(),
                    idtype: $("#cmbType").val()
                },
            function(data){
                    $('#workInfoText').html(data);
                    $('#workInfo').show().delay(7000).hide(1000);
                    if(data.indexOf("Success") > -1) { location.reload(true); }
                });
        });

        $("#btnUpdateWork").click(function(){
            //alert("Value: " + $("#txtName").val());
            $.post("kernel.php",
                {
                    page: "upd-work",
                    username: $("#txtWorkUser").val(),
                    password: $("#txtWorkPassword").val(),
                    remotepath: $("#txtWorkRemotePath").val(),
                    parameters: $("#txtWorkParameters").val(),
                    idwork: $('#WorkID').val()
                },
            function(data){
                    $('#workInfoTextUpdate').html(data);
                    $('#workInfoUpdate').show().delay(7000).hide(1000);
                    if(data.indexOf("Success") > -1) { location.reload(true); }
                });
        });
        
        $("#btnDeleteWork").click(function(){
            //alert("Value: " + $("#txtName").val());
            $.post("kernel.php",
                {
                    page: "del-work",
                    idwork: $("#WorkID").val()
                },
            function(data){
                    $('#workInfoTextDelete').html(data);
                    $('#workInfoDelete').show().delay(7000).hide(1000);
                    if(data.indexOf("Success") > -1) { location.reload(true); }
                });
        });
        
        
        $(".btnOptionsDeleteWork").click(function(){
            //alert("Value: " + $(this).val());
            var value = $(this).val();
            $('#WorkID').val(value);
        });
        
        $(".btnOptionsUpdateWork").click(function(){
            
            var value = $(this).val();
            $('#WorkID').val(value);
            
            $.post("kernel.php",
                {
                    page: "upd-work-form",
                    idwork: $("#WorkID").val()
                },
            function(data){
                    $('#workEdit').html(data);
                });
        });
        
        //BACKUP
        $("#btnSearchBackupsByServer").click(function(){
            //alert("Value: " + $("#txtName").val());
            $.post("kernel.php",
                {
                    page: "backup-search",
                    idserver: $("#cmbBackupServer").val(),
                },
            function(data){
                    $('#backupDatatable').html(data);
                });
        });        
      });      
    </script>
<p class="center">PHPBackup v.1</p>