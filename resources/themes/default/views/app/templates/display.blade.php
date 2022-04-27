<div class="box box-padding clearfix mb-2">
    <div class="float-start">
        <h6>{{$template->title}}</h6>
        <p class="color-grey">{{$template->content}}</p>
    </div>
    <div class="float-end">
        <a href="{{app('request')->fullUrl()}}?action=delete&id={{$template->id}}" class="btn btn-sm confirm" data-ajax-action="true"><i class="bi bi-trash"></i></a>
        <a href="" data-bs-target="#editTemplateModal{{$template->id}}" data-bs-toggle="modal" class="btn btn-secondary btn-sm btn-rounded" >{{__('messages.edit')}}</a>
    </div>
</div>


<div class="modal" tabindex="-1" id="editTemplateModal{{$template->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('messages.edit-template')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{app('request')->fullUrl()}}" method="post" class="general-form">
                <input type="hidden" name="val[action]" value="edit"/>
                <input type="hidden" name="val[id]" value="{{$template->id}}"/>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" value="{{$template->title}}" name="val[title]" id="titleInput" placeholder="{{__('messages.title')}}"/>
                        <label for="titleInput">{{__('messages.title')}}</label>
                    </div>

                    <div class="form-floating mt-2">
                        <textarea class="form-control textarea-height-100"  name="val[content]" id="contentInput" placeholder="{{__('messages.content')}}">{{$template->content}}</textarea>
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


