<div id="contact-content" class="sidebar-content" @if(Session::has('showContact')) style="display:block" @endif>
	<fieldset  class="sidebar-top-content">
        <legend><i class="fa fa-road"></i> &nbsp;CONTACTO</legend>
        <br>

        <p>
            Lorem ipsum dolor sit amet, nec no tota minimum, debet labore oporteat pri id. 
            Vis ad altera aperiam, eam omnium eleifend ex. An eos quot nihil intellegam, fugit 
            omittam quaestio ei vim. Deleniti senserit adipiscing vim in, exerci libris democritum cu duo. Meis 
            illum graece ad cum.
        </p>

        <br>
        {{ Form:: open(array('action' => 'ContactController@getContactUsForm')) }} 

        <ul class="errors">
        @foreach($errors->all('<li>:mensaje</li>') as $mensaje)
        {{ $message }}
        @endforeach
        </ul>

        <div class="form-grousp">
        {{ Form::text('nombre','',array('placeholder' => 'Ingresa tu nombre', 'class' => 'form-control')) }}
        </div>
        <br>
        <div class="form-group">
        {{ Form::email('email','',array('placeholder' => 'Ingresa tu email', 'class' => 'form-control')) }}
        </div>
        <div class="form-group">
        {{ Form:: textarea ('mensaje', '', array('placeholder' => 'Dejanos tu mensaje', 'class' => 'form-control', 'id' => 'messages', 'rows' => '4' )) }}
        </div>
		{{ Form::submit('Enviar', array('class' => 'btn btn-primary')) }}
        {{ Form:: close() }}


       
        
 
    </fieldset>

</div>
