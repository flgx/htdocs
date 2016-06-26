<?php $currentModule = ''; ?>
@foreach ($resources as  $resource)	
	<?php $checked = '' ?>

	@foreach ($availables as $available)
		@if( $available->resource_id == $resource['id'] )
			<?php $checked = 'checked' ?>
		@endif
	@endforeach

	@if($currentModule != $resource['module'])
		<?php $currentModule = $resource['module']; ?>
		<br>
        <div class="callout callout-info">
            <h4>{{{ $currentModule }}}</h4>
        </div>	
	@endif
		<div class="form-group" style="margin-left:50px">
	      	<div class="checkbox">
	      		<div class="row">
	      			<div class="col-sm-1">
				        <label>		            
				            <b>{{ strtoUpper($resource['action']) }}</b> 
				        </label>
				    </div>
	      			<div class="col-sm-2">
		      			<input type="checkbox" name="resources[]" value="{{ $resource['id'] }}" {{{ $checked }}} />
			        </div>			        
			    </div>
		    </div>
		</div>
@endforeach


<?php /*
	@foreach ($availables as $available)
		@if( $available['resource'] == $index )
			<?php $checked = 'checked' ?>
		@endif
	@endforeach


	<div class="form-group">
	    <div class="col-sm-offset-1 col-sm-10">
	      	<div class="checkbox">
	      		<div class="row">
	      			<div class="col-sm-3">
		      			<input type="checkbox" class="resources" name="resources[]" value="{{ $index }}"  {{{ $checked }}}/>
			        </div>
			        <div class="col-sm-9">
				        <label>		            
				            <b>{{ $index }}</b> ({{ $value }})
				        </label>
				    </div>
			    </div>

		    </div>
	    </div>
	</div>*/ ?>