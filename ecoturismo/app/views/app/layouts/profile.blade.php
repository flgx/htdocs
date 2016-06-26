<div id="profile-content" class="sidebar-content" @if(Session::has('showProfile')) style="display:block" @endif>
    <fieldset  class="sidebar-top-content">
        <legend>Hola <strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong>!</legend>
        <br>
        <div class="row">


            <div class="col-md-3 image-viewer">
                <?php $image = isset($location['image']) ? $location['image'] : NULL ?>

                <img id="image-viewer-thumbnail" class="img-thumbnail"
                     src="{{{ showAvatarImage(Auth::user()->image, 'app.image.avatar-path-web') }}}">
            </div>
            <div class="col-md-9">
                <p>
                    @if(Auth::user()->about_me)
                        {{ Auth::user()->about_me }}
                    @else
                        <div class="alert alert-warning" role="alert">
                            <p>Aún no has ingresado una descripción sobre vos (<strong><a href="#" data-toggle="modal" data-target="#modal-edit-profile">Editar</a>)</strong></p>
                        </div>
                    @endif
                </p>
            </div>
        </div>
        <br>
        <a href="#" class="btn btn-info btn-lg btn-block"  data-toggle="modal" data-target="#modal-edit-profile"><i class="fa fa-pencil" id="show-edit-profile"></i>&nbsp;Editar perfil</a>
        <a href="{{ route('app.logout') }}" class="btn btn-danger btn-lg btn-block"><i class="fa fa-power-off"></i>&nbsp;Salir</a>
    </fieldset>
    <br>
    @if($myRankings)
        <fieldset>
            <legend>Mis votaciones</legend>
            <br>
            <div id="user-ranking">
                <table style="width:100%" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                          <th>Nombre</th>
                          <th style="width:120px">Puntuación</th>
                        </tr>
                    </thead>
                @foreach($myRankings as $index => $points)
                    <tr>
                        <td>
                            {{ $points['name'] }}
                        </td>
                        <td>
                            <div class="ranking" data-ranking="{{ $points['ranking'] }}"></div>
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
        </fieldset>
    @endif
</div>