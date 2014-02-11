    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
      
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="..\index.php">Meu site</a>
        </div>
        
        
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li> <!-- class="active" é pra tornar a aba selecionada.--> 
            <li><a href="#Contato">Contato</a></li>
            <li><a href="#Sobre">Sobre</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mais <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            	<li class="dropdown">
              		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Entrar <b class="caret"></b></a>
              		<ul class="dropdown-menu">
                		<li>              		
                		 <div class="container">    
                		   <?php include ROOT.'/public_html/loginForm.html' ?>
						 </div>						 
                		</li>
              		</ul>
            	</li>
            	<li><a href="registrar">Registrar</a></li>
          	</ul>          
        </div><!--/.navbar-collapse -->
      </div>
    </div>