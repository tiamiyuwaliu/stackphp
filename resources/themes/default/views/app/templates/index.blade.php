<div class="content-padding modern-scroll scroll-inner-right">
    <div class="container">
        <div class="clearfix">
            <div class="float-start">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{$page == 'caption' ? 'active' : null}}" data-ajax="true"  href="{{url('templates')}}">{{__('messages.captions')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{$page == 'hashtag' ? 'active' : null}}" data-ajax="true" href="{{url('templates/hashtag')}}">{{__('messages.hashtags')}}</a>
                    </li>

                </ul>
            </div>
            <div class="float-end">
                <a href="" data-bs-target="#addTemplateModal" data-bs-toggle="modal" class="btn btn-dark btn-sm">{{__('messages.add-template')}}</a>
            </div>
        </div>

        @if(count($templates))
            <div class="template-list-container mt-3">
                @foreach($templates as $template)
                    {!! view('app/templates/display', ['template' => $template]) !!}
                @endforeach
            </div>
        @else
            <div class="empty-result">
                <img  src="{{url('resources/themes/default/images/empty-result.png')}}"/>
            </div>
        @endif
    </div>
</div>

<div class="modal" tabindex="-1" id="addTemplateModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('messages.add-template')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{app('request')->fullUrl()}}" method="post" class="general-form">
                <input type="hidden" name="val[action]" value="add"/>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="val[title]" id="titleInput" placeholder="{{__('messages.title')}}"/>
                        <label for="titleInput">{{__('messages.title')}}</label>
                    </div>

                    <div class="form-floating mt-2">
                        <textarea class="form-control textarea-height-100"  name="val[content]" id="contentInput" placeholder="{{__('messages.content')}}"></textarea>
                        <label for="contentInput">{{__('messages.content')}}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


