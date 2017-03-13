<div class="row">
    <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <div class="absolute-wrapper"> </div>
    <!-- Menu -->
    <div class="side-menu">
    
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">
            <!-- Hamburger -->
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand -->
            <div class="brand-name-wrapper">
                <a class="navbar-brand" href="#">
                    Vale a pena jogar
                    <i class="fa fa-cogs"></i>
                </a>
            </div>

            <!-- Search -->
            <!-- <a data-toggle="collapse" href="#search" class="btn btn-default" id="search-trigger">
                <span class="glyphicon glyphicon-search"></span>
            </a> -->

            <!-- Search body -->
            <!-- <div id="search" class="panel-collapse collapse">
                <div class="panel-body">
                    <form class="navbar-form" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default "><span class="glyphicon glyphicon-ok"></span></button>
                    </form>
                </div>
            </div> -->
        </div>

    </div>

    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">

            <li {{ Request::is('admin/jogos') ? 'class = active ' : null }}><a href="{{route('admin.jogos')}}"><span class="fa fa-gamepad"></span> Jogos</a></li>
            <li {{ Request::is('admin/desenvolvedores') ? 'class = active ' : null }}><a href="{{route('admin.desenvolvedores')}}"><span class="fa fa-code"></span> Desenvolvedores</a></li>
            <li {{ Request::is('admin/distribuidoras') ? 'class = active ' : null }}><a href="{{route('admin.distribuidoras')}}"><i class="fa fa-truck"></i> Distribuidoras</a></li>
            <li {{ Request::is('admin/categorias') ? 'class = active ' : null }}><a href="{{route('admin.categorias')}}"><span class="fa fa-tags"></span> Categorias</a></li>
            <li {{ Request::is('admin/usuarios') ? 'class = active ' : null }}><a href="{{route('admin.usuarios')}}"><span class="fa fa-users"></span> Usuarios</a></li>
            <li><a href="{{route('admin.logout')}}"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>

            <!-- Dropdown-->
         <!--    <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                    <span class="glyphicon glyphicon-user"></span> Sub Level <span class="caret"></span>
                </a>
 -->
                <!-- Dropdown level 1 -->
                <!-- <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li> -->

                            <!-- Dropdown level 2 -->
                           <!--  <li class="panel panel-default" id="dropdown">
                                <a data-toggle="collapse" href="#dropdown-lvl2">
                                    <span class="glyphicon glyphicon-off"></span> Sub Level <span class="caret"></span>
                                </a>
                                <div id="dropdown-lvl2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li><a href="#">Link</a></li>
                                            <li><a href="#">Link</a></li>
                                            <li><a href="#">Link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li> -->

            <!-- <li><a href="#"><span class="glyphicon glyphicon-signal"></span> Link</a></li> -->

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
        @yield('conteudo')
        </div>
    </div>
    
</div>