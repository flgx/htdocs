<div id="index-content" class="sidebar-content" @if(Session::has('showIndex')) style="display:block;margin-right:0px !important" @else style="margin-right:0px !important" @endif >
    <div id="main-menu">
        <ul id="tag-list">
            <li>
                <center>
                    <a href="#" class="tag-menu tag-active" id="btn-showAllLocations" data-id="0"  data-toggle="tooltip" data-placement="right" title="Todas los puntos interactivos">
                        <i class="fa fa-globe"></i>
                    </a>
                </center>
            </li>

            @foreach( $mainTags as $tag)
            <li>
                <center>
                    <a href="#" class="tag-menu" data-id="{{$tag['id']}}"  data-toggle="tooltip" data-placement="right" title="{{$tag['name']}}">
                        <i class="{{$tag['icon']}}"></i>
                    </a>
                </center>
            </li>
            @endforeach
        </ul>
    </div>
    <div id="all-points">
        <fieldset  class="sidebar-top-content">
            <legend>Todas los puntos interactivos</legend>

            <div id="index-list">        
                <ul id="children-tag-list">
                    @foreach($allLocations as $location)
                        <li>                            
                            <a href="#" class="btn-foundLocation" data-id="{{{ $location['id'] }}}" data-toggle="tooltip" data-placement="top" title="Buscar en el mapa -> {{{ $location['name'] }}}">
                                <i class="fa fa-angle-right"></i>&nbsp;
                                {{{ $location['name'] }}}
                            </a>
                            
                        </li>
                    @endforeach
                </ul>
            </div>
        </fieldset>
    </div>

    <div id="children-tag-content"></div>
    <div id="filter-points"></div>
    
</div>
