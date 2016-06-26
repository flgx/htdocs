<fieldset  class="sidebar-top-content" style="margin-left:10px; margin-right:10px">
    <legend><i class="fa {{ $mainTag['icon'] }}"></i> &nbsp;{{ $mainTag['name']}}</legend>
</fieldset>

<div id="index-list">        
    <ul id="children-tag-list">
        @foreach($children as $child)
            <li>
                <a href="#" class="btn-foundChildrenLocation" data-id="{{$child['id']}}"  data-toggle="tooltip" data-placement="top" title="Ver los puntos interactivos de {{{ $child['name'] }}}">
                	<i class="fa fa-angle-double-right"></i>&nbsp;
                	{{{ $child['name'] }}} <span class="count-location">&nbsp;&nbsp;{{ $child['count'] }}&nbsp;&nbsp;</span>
                	<!--i class="fa fa-play" style="color:black"></i-->
                </a>
            	
            </li>
        @endforeach
    </ul>
</div>

<script type="text/javascript">
	$('[data-toggle="tooltip"]').tooltip();
	
	$('.btn-foundChildrenLocation').on('click', function(event) {
		event.preventDefault();
		var childrenTagId = $(this).attr('data-id');

		getChildrenLocations(childrenTagId);
	});
	
	<?php $separator = ''; ?>

	var filter =  [
		@foreach($locations as $location)
			{{  $separator . $location['id']  }}
			<?php $separator = ',' ?>
		@endforeach
	];
    myfilter = filter;
	showFilterMarkers(filter);
</script>