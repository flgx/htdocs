<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            
            <li class="active text-center">
                <a href="{{ route('dashboard'); }}">
                    <i class="fa fa-dashboard icon-size-3"></i> 
                    <br>
                    <span class="label-block">Dashboard</span>
                </a>
            </li>

            @if(BackofficeResource::can('roles', 'read'))
            <li class="text-center">
                <a href="{{ route('role'); }}">
                    <i class="fa fa-user icon-size-3"></i> 
                    <br>
                    <span>Roles</span>
                </a>
            </li>
            @endif

            @if(BackofficeResource::isRoot()) 
            <li class="text-center">
                <a href="{{ route('resource'); }}">
                    <i class="fa fa-cogs icon-size-3"></i> 
                    <br>
                    <span>Recursos</span>
                </a>
            </li>
            @endif

            @if(BackofficeResource::can('usuarios', 'read'))
            <li class="text-center">
                <a href="{{ route('user'); }}">
                    <i class="fa fa-users  icon-size-3"></i> 
                    <br><span>Usuarios</span>              
                </a>
            </li>
            @endif

            @if(BackofficeResource::can('tags', 'read'))
            <li class="text-center">
                <a href="{{ route('tag'); }}">
                    <i class="fa fa-tags  icon-size-3"></i> 
                    <br><span>Etiquetas</span>              
                </a>
            </li>
            @endif

            @if(BackofficeResource::can('locaciones', 'read'))
            <li class="text-center">
                <a href="{{ route('location'); }}">
                    <i class="fa fa-thumb-tack  icon-size-3"></i> 
                    <br><span>Puntos interactivos</span>              
                </a>
            </li>
            @endif

            @if(BackofficeResource::can('comentarios', 'read'))
            <li class="text-center">
                <a href="{{ route('comments.admin'); }}">
                    <i class="fa fa-comments-o icon-size-3"></i> 
                    <br><span>Moderador de comentarios</span>              
                </a>
            </li>
            @endif

            @if(BackofficeResource::can('reportes', 'read'))
            <li class="text-center">
                <a href="{{ route('report'); }}">
                    <i class="fa fa-check-square-o icon-size-3"></i> 
                    <br><span>Reportes</span>              
                </a>
            </li>
            @endif

          
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>