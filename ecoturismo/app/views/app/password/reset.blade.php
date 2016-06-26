<div id="reset-content" class="sidebar-content" @if(Session::has('showReset')) style="display:block" @endif>
    <h2 class="sidebar-top-content">Recuperar contraseña</h2>       

    <form action="{{ route('app.reminder.reset') }}" method="post">
        <input type="hidden" name="token" value="{{ Session::get('token') }}">

        <div class="form-group @if($errors->has('email')) has-error @endif">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                <input type="email" name="email" class="form-control" placeholder="Ingresar correo" />
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
        @if (Session::has('error'))                     
            <div class="alert alert-danger" role="alert" style="margin-left:0">{{ Session::get('error'); }}</div>
        @endif
        <button type="submit" class="btn btn-danger btn-block btn-lg">Cambiar contraseña</button>
    </form>
</div>