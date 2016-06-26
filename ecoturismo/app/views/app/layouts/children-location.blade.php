
<fieldset  class="sidebar-top-content" style="margin-left:10px; margin-right:10px;">
   <legend>{{{ $nameTag }}}</legend>
</fieldset>

<div id="index-list">      
    <ul id="children-tag-list">
        @foreach($locations as $location)
            <li>
                <a href="#" class="activepoint btn-foundLocation" data-id="{{{ $location['id'] }}}"  data-toggle="tooltip" data-placement="top" title="Buscar en el mapa -> {{{ $location['name'] }}}">
                	<i class="fa fa-angle-right"></i>&nbsp;
                	{{{ $location['name'] }}}
                </a>
            </li>
        @endforeach
    </ul>    
<div class="clearfix"></div>
<br><br>
<div class="margin-left">Regresar al <strong><a href="#" id="return-to-child-tag">listado de la categoría</a></strong></div>
</div>



<script type="text/javascript">
	$('[data-toggle="tooltip"]').tooltip();
	$('.btn-foundLocation').on('click', foundLocation);
	$('#return-to-child-tag').on('click', function(event) {
		event.preventDefault();
		showChildrenTagContainer();
	});

	<?php $separator = ''; ?>

	var filter =  [
		@foreach($locations as $location)
			{{  $separator . $location['id']  }}
			<?php $separator = ',' ?>
		@endforeach
	];

	showFilterMarkers(filter);
</script>