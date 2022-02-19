<div class="header">
    <h4>{{__('messages.themes-manager')}}</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('messages.themes')}}</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-table shadow-sm mt-4">
            <table class="modern-table ">
                <thead>
                <tr>
                    <th scope="col">{{__('messages.theme')}}</th>
                    <th scope="col">{{__('messages.version')}}</th>
                    <th scope="col">{{__('messages.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($themes as $theme => $info)
                    <tr>

                        <td data-label="{{__('messages.theme')}}">
                            <h6>{{$info['title']}} - <span class="badge bg-info">{{$info['author']}}</span></h6>
                        </td>
                        <td data-label="{{__('messages.version')}}">
                            <span class="badge bg-success">V{{$info['version']}}</span>
                        </td>
                        <td data-label="{{__('messages.action')}}">
                            @if(config('theme', 'default') == $theme)
                                <h5><span class="badge bg-success">{{__('messages.active')}}</span></h5>
                            @else
                                <a href="{{url('cp/themes')}}?action=enable&id={{$theme}}" class="btn btn-sm btn-success">{{__('messages.enable')}}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box shadow-sm mt-4">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h6>{{__('messages.custom-css')}}</h6>
                        <a href="" data-bs-toggle="modal"  data-bs-target="#customCssModal" class="btn "><i class="bi bi-pen"></i></a>
                    </div>
                    <p class="text-muted">{{__('messages.custom-css-note')}}</p>
                </li>
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h6>{{__('messages.custom-js')}}</h6>
                        <a href="" class="btn " data-bs-target="#customJsModal" data-bs-toggle="modal"><i class="bi bi-pen"></i></a>
                    </div>
                    <p class="text-muted">{{__('messages.custom-js-note')}}</p>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="modal" id="customJsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form enctype="multipart/form-data" class="general-form"  action="{{url('cp/settings')}}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('messages.custom-js')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mt-3">
                        <textarea placeholder="{{__('messages.custom-js')}}" class="form-control min-textarea-height"  name="val[custom-js]">{{config('custom-js')}}</textarea>
                        <label>{{__('messages.custom-js')}}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal" id="customCssModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form enctype="multipart/form-data" class="general-form"  action="{{url('cp/settings')}}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('messages.custom-css')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mt-3">
                        <textarea placeholder="{{__('messages.custom-css')}}" class="form-control min-textarea-height"  name="val[custom-css]">{{config('custom-css')}}</textarea>
                        <label>{{__('messages.custom-css')}}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>
