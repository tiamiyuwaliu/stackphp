<div class="box box-padding statistics-box">

    <div class="d-flex">
        <h5 class="flex-grow-1">{{__('messages.browsers')}}</h5>
        @if(!isset($current))
            <a href="{{url('builder/bio/reports/'.$page->slug)}}?page=browsers" data-ajax="true">{{__('messages.view-all')}}</a>
        @endif
    </div>
    <div class="pane">

    </div>
</div>
