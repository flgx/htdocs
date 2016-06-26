<div id="user-content" class="sidebar-content" @if(Session::has('showLogin')) style="display:block;" @endif>
    <h2 class="sidebar-top-content">Bienvenido a <span>Ecoturismo Argentina</span>!</h2>
    <br>
    <p>
        Lorem ipsum dolor sit amet, nec no tota minimum, debet labore oporteat pri id. 
        Vis ad altera aperiam, eam omnium eleifend ex. An eos quot nihil intellegam, fugit 
        omittam quaestio ei vim. Deleniti senserit adipiscing vim in, exerci libris democritum cu duo. Meis 
        illum graece ad cum.
    </p>
    <br>
    <fieldset>
        <legend>Ingresar</legend>
        <form action="{{ route('app.login') }}" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                        <input type="email" name="email" class="form-control" id="InputEmailLogin" placeholder="Ingresar correo" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-key"></i></div>
                        <input type="password" name="password" class="form-control" id="InputPasswordLogin" placeholder="Ingresar contraseña" />
                    </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"/>
                        Recordarme
                    </label>
                    <a class="custom-link pull-right" href="#" id="btn-show-remind">Olvidé mi contraseña</a>

                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-unlock"></i>&nbsp;Ingresar</button>
                <a  href="{{route('app.login.facebook')}}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-facebook-square"></i>&nbsp;Ingresar con Facebook</a>

                 Es tu primera vez? <strong><a href="#" id="btn-show-register">Registrate</a></strong>
            </div>
        </form>
    </fieldset>
    
    <hr>
    <h3>Seguinos en nuestras redes sociales</h3>
        <ul class="social-networks">
            <li><a href="#"><img src="{{ asset('/app/img/Facebook.png')}}"></a></li>
            <li><a href="#"><img src="{{ asset('/app/img/Twitter.png')}}"></a></li>
            <li><a href="#"><img src="{{ asset('/app/img/instagram.png')}}"></a></li>
        </ul> 
</div>