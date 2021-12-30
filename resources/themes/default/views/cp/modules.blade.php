<div class="header">
    <h3>{{__('messages.module-manager')}}</h3>
</div>

<div class="content-body">
    <div class="table-responsive mt-4">
        <table class="table table-striped table-custom ">
            <thead>
            <tr>
                <th>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        </label>
                    </div>
                </th>
                <th>{{__('messages.module')}}</th>
                <th>{{__('messages.version')}}</th>
                <th>{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
                @foreach($modules as $module => $info)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="moduleInput{{$module}}">
                                <label class="form-check-label" for="moduleInput{{$module}}">
                                </label>
                            </div>
                        </td>
                        <td>
                            <h5>{{$info['title']}} - <span class="badge bg-info">{{$info['author']}}</span></h5>
                            <p>{{$info['description']}}</p>
                        </td>
                        <td>
                            <span class="badge bg-success">V{{$info['version']}}</span>
                        </td>
                        <td>
                            @if(\App\Repositories\Module::repository()->isActive($module))
                                <a href="{{url('cp/modules')}}?action=disable&id={{$module}}" data-ajax-action="true" class="btn btn-sm btn-danger confirm">{{__('messages.disable')}}</a>
                            @else
                                <a href="{{url('cp/modules')}}?action=enable&id={{$module}}" data-ajax-action="true" class="btn btn-sm btn-success confirm">{{__('messages.enable')}}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
