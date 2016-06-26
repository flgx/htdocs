<div class="modal fade" id="modal-edit-profile" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {{ Form::open(['route' => 'edit-profile', 'id'=> 'form-editprofile', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form', 'files'=>true]) }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edición de perfil</h4>
            </div>
            <div class="modal-body" style="min-height: 200px;">
                <div class="row">
                    <?php $image = isset($location['image']) ? $location['image'] : NULL ?>
                    <div class="col-md-4 image-viewer">
                        <img id="image-viewer-thumbnail" class="img-thumbnail"
                             src="{{{ showAvatarImage(Auth::user()->image, 'app.image.avatar-path-web') }}}">
                        <br>
                    </div>
                    <div class="col-md-8">
                        <div class="alert alert-warning" role="alert">
                            <p>Seleccione una imágen que no supere los {{ Config::get('app.image.max-size')}}KB</p>

                            <p>Tamaño recomendado: 150px X 120px o proporcional</p>
                        </div>
                        <div class="fileUpload btn btn-success">
                            <span>Seleccionar imagen</span>
                            <input id="uploadBtn" type="file" class="upload" name="image"/>
                        </div>
                        <div><span id="img-text"></span></div>
                        {{ $errors->first('image', '<label class="control-label has-error" for="image" style="color:#a94442 !important;"><i class="fa fa-times-circle-o"></i> :message </label>') }}
                    </div>

                    <div class="col-md-12 @if($errors->has('about_me')) has-error @endif">
                        <br>
                        <label>Sobre mí</label>

                        <div>
                            <textarea id="about_me" class="form-control" name="about_me" rows="4"
                                      placeholder="Ingresar una breve descripción sobre usted">{{ Auth::user()->about_me }}</textarea>
                            {{ $errors->first('about_me', '<label class="control-label" for="about_me"><i class="fa fa-times-circle-o"></i> :message </label>') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button id="submit-editprofile" type="button" class="btn btn-primary">Guardar</button>
            </div>
            {{ Form::close() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
    .modal-title, .modal-body label {
        color: #5d8eae !important;
    }

    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }

    #img-text {
        color: #5d8eae;
        font-weight: bold;
    }
</style>
