<div class="location-information-detail">
    <h2 class="sidebar-top-content">{{{ $location['name'] }}}</h2>
    <?php $count = 0; $oneimage; $count2 = count($images);?>
    <?php if($count2 != 0){ ?>
    @foreach($images as $index => $image)
        @if($count == 0)
             <a href="assets/images/location/{{ $image['image_id'] }}" data-lightbox="myimage-1"><img src="assets/images/location/{{ $image['image_id'] }}"  width="100%" /></a>
        @else
             <a href="assets/images/location/{{ $image['image_id'] }}" data-lightbox="myimage-1"></a>
        @endif

    <?php $oneimage =$image['image_id'];  ?>
    <?php $count ++; ?>   
    @endforeach

    <a href="assets/images/location/{{ $image['image_id'] }}"  data-lightbox="myimage-1" id="link-show-location-detail" class="link-info"><i class="fa fa-image fa-4x"></i></a>
    <?php } ;?>
    <a href="#" id="link-calculate-route-'+value.id+'" onclick="calculateRouteFromMarker('{{($location['id'])}}','{{($location['lng'])}}','{{($location['lat'])}}')" class=" link-info"><i class="fa fa-road fa-4x"></i></a>
    <a href="#" id="searchnear" onclick="getNearbyPlaces()" class=" link-info"><i   class="fa fa-home fa-4x"></i></a>
    <hr>
  
   <strong>Ranking: </strong>
    <?php $rankingReadOnly = ! Auth::check() ?>
    <div id="ranking" data-ranking="{{ $location['ranking']}}" data-location-id="{{ $location['id']}}" data-readonly="{{ $rankingReadOnly }}"></div>

    <br>
    <strong>Descripción: </strong>
    <p>
        {{ nl2br($location['description']) }}
         
        <p>
        <strong>Link de referencia: </strong>
            <a href="http://{{ ($location['url']) }}" target="_blank">{{ ($location['url']) }}</a> 
        </p>
    </p>
    <br>

    <br>

    
        <fieldset>
            <legend>Comentarios</strong></legend>
            <br>
            @if(Auth::check())
                <textarea id="input-comment"  data-location-id="{{ $location['id']}}" class="form-control" name="comment" rows="3" placeholder="Ingrese un comentario, no mayor a 255 caracteres" maxlength="255"></textarea>
         
                <div id="load-comment" style="width:100%;"></div>
                <button class="btn btn-primary btn-block btn-comment" id="btn-comment">Comentar</button>
            @else 
                <p class="bg-info">Para poder realizar un comentario, primero debes estar logeado.</p>
            @endif
        </fieldset>

        <hr>

    <div id="user-comments">
        <table style="width:100%" class="table table-striped table-bordered">

        @forelse($comments as $index => $comment)
            <tr>
                <td>
                    <div class="data-comment">Usuario: {{ $comment['user']}}</div>
                    <div class="data-comment">Fecha: {{ dateMysqlToEurope($comment['created_at'], '-', $withTime = true) }} </div>
                    <br>
                    {{ $comment['comment'] }}
                </td>
            </tr>
        @empty
            <p class="bg-info">No se han encontrado comentarios para este punto interactivo, vos podés ser el primero...</p>
        @endforelse
        </table>
    </div>
</div>

<script type="text/javascript" charset="utf-8">
    $('#btn-comment').on('click', function(){
        var locationId = $('#input-comment').attr('data-location-id');
        var comment    = $('#input-comment').val();

        if(comment == null || comment == '')
        {
            alertify.error("Por favor ingrese un comentario");
        }

        sendComment(comment, locationId);
    });
</script>