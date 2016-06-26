<div id="remind-content" class="sidebar-content" @if(Session::has('showRemind')) style="display:block" @endif>
    <fieldset  class="sidebar-top-content">
        <legend>Recuperar contraseña</legend>
        <br>
        @if ( ! Session::has('status')) 
            <p>
                Lorem ipsum dolor sit amet, nec no tota minimum, debet labore oporteat pri id. 
                Vis ad altera aperiam, eam omnium eleifend ex.
            </p>
            <br>
            <form action="{{ route('app.reminder.sent') }}" method="post">
                
                <div class="form-group @if($errors->has('email')) has-error @endif">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                        <input type="email" name="email" class="form-control" placeholder="Ingresar correo" />
                    </div>
                </div>                   
                @if (Session::has('error'))                     
                    <div class="alert alert-danger message-reminder" role="alert">{{ Session::get('error'); }}</div>
                @endif
                <button type="submit"  class="btn btn-danger btn-lg btn-block">Recuperar</button>
            </form>
        @else
            <div class="alert alert-info  message-reminder" role="alert">{{ Session::get('status'); }}</div>
        @endif
    </fieldset>
</div>