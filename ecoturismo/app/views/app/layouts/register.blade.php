<div id="register-content" class="sidebar-content" @if(Session::has('showRegister')) style="display:block" @endif>
    <fieldset  class="sidebar-top-content">
        <legend>Registración</legend>
        <br>
        <p>
            Lorem ipsum dolor sit amet, nec no tota minimum, debet labore oporteat pri id. 
            Vis ad altera aperiam, eam omnium eleifend ex.
        </p>
        <br>

        <form action="{{ route('app.register') }}" method="post">
            <div class="form-group @if($errors->has('first_name')) has-error @endif">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input type="text" name="first_name" class="form-control" placeholder="Ingrese nombre" value="{{{ Input::old('first_name') }}}" />
                </div>
                {{ $errors->first('first_name', '<label class="control-label" for="first_name"><i class="fa fa-times-circle-o"></i> :message </label>') }}  
            </div>  

            <div class="form-group @if($errors->has('last_name')) has-error @endif">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input type="text" name="last_name" class="form-control" placeholder="Ingrese apellido" value="{{{ Input::old('last_name') }}}"/>
                </div>
                {{ $errors->first('last_name', '<label class="control-label" for="last_name"><i class="fa fa-times-circle-o"></i> :message </label>') }}  
            </div>     

            <div class="form-group @if($errors->has('email')) has-error @endif">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                    <input type="email" name="email" class="form-control" placeholder="Ingresar correo"  value="{{{ Input::old('email') }}}"/>
                </div>
                {{ $errors->first('email', '<label class="control-label" for="email"><i class="fa fa-times-circle-o"></i> :message </label>') }}  
            </div>     

            <div class="form-group @if($errors->has('password')) has-error @endif">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                    <input type="password" name="password" class="form-control" placeholder="Ingresar contraseña" />
                </div>
                {{ $errors->first('password', '<label class="control-label" for="name"><i class="fa fa-times-circle-o"></i> :message </label>') }} 
            </div> 

            <div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repetir contraseña" />
                </div>
                {{ $errors->first('password_confirmation', '<label class="control-label" for="name"><i class="fa fa-times-circle-o"></i> :message </label>') }} 
            </div>                
            <button type="submit" class="btn btn-primary btn-lg btn-block">Registrarme</button>
        </form>
    </fieldset>
    <hr>
    Regresar al <strong><a href="#" id="btn-show-login">Login</a></strong>
</div>