 <?php
   include('Login/session.php');
?> 
<style>
  /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
	  background-color: #333333;
      margin-bottom: 0;
      border-radius: 0;
    }
	#topp {
		margin-left: 10px;
	}
</style>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
     
	  <a class="navbar-brand" id="topp" href="tabellhtml.php"><span class="glyphicon glyphicon-folder-open">  Tabell</span></a>
	  <a class="navbar-brand" id="topp" href="skjemahtml.php"><span class="glyphicon glyphicon-plus"> Ny deponering</span></a>
    </div>
  <!-- <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="" ></span></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
      </ul>-->
      <ul class="nav navbar-nav navbar-right">
	  <li> <a class="navbar-brand" id="topp" ><span class="glyphicon glyphicon-user"><?php echo " " . $bruker . " ";  ?></span></a></li>
        <li><a href="Login/logout.php"><span class="glyphicon glyphicon-log-out"> LoggUt</span> </a></li>
      </ul>
    </div>
</nav>

