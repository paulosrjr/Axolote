<?php
/*function CheckLoggedMenu(){ if(isset($_SESSION['usernameHA']) && isset($_SESSION['passwordHE']) && $_SESSION['magicalnumber']===666){ }
else{ header("location: index.php"); }}
CheckLoggedMenu();*/
?>
<?php require_once 'lib/libUserValidation.php'; ?>
    <?php
//$pageName=basename(__FILE__);
$pageName=basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-default navbar-pf" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
          SBE Backup - Simplistic Backup Environment
        </a>
      </div>
      <div class="collapse navbar-collapse navbar-collapse-1">
        <ul class="nav navbar-nav navbar-utility">
          <!--<li>
            <a href="#">Status</a>
          </li>-->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="pficon pficon-user"></span>
              <?php echo $_SESSION['usernameHA']; ?><b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <!--<li>
                <a href="#">Alterar Senha</a>
              </li>-->
              <li>
                <a href="<?php echo "https://".$_SERVER['SERVER_NAME']."/access.php?logoff=yes"; ?>">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-primary">
          <li <?php if($pageName=="main.php") echo "class=\"active\""; ?>>
              <a href="main.php" id="main" <?php if($pageName=="main.php") echo "class=\"active\""; ?>>Dashboard</a>
          </li>
          <li <?php if($pageName=="server.php") echo "class=\"active\""; ?>>
              <a href="server.php" id="server" <?php if($pageName=="server.php") echo "class=\"active\""; ?>>Servers</a>
          </li>
          <li <?php if($pageName=="work.php") echo "class=\"active\""; ?>>
              <a href="work.php" id="work" <?php if($pageName=="work.php") echo "class=\"active\""; ?>>Works</a>
          </li>
          <li <?php if($pageName=="backup.php") echo "class=\"active\""; ?>>
              <a href="backup.php" id="backup" <?php if($pageName=="backup.php") echo "class=\"active\""; ?>>Backups</a>
          </li>
          <li <?php if($pageName=="log.php") echo "class=\"active\""; ?>>
              <a href="log.php" id="log" <?php if($pageName=="log.php") echo "class=\"active\""; ?>>Logs</a>
          </li>
        </ul>          
      </div>
    </nav>