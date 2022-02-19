
<div class="header">
    <h4>{{__('messages.module-manager')}}</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('messages.module-manager')}}</li>
        </ol>
    </nav>
</div>

<div class="box box-table shadow-sm mt-4">
    <table class="modern-table">
        <thead>
        <tr>
            <th scope="col">{{__('messages.module')}}</th>
            <th scope="col">{{__('messages.version')}}</th>
            <th scope="col">{{__('messages.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($modules as $module => $info)
            <tr>
                <td data-label="{{__('messages.module')}}">
                    <h5>{{$info['title']}} - <span class="badge bg-info">{{$info['author']}}</span></h5>
                    <p>{{$info['description']}}</p>
                </td>
                <td data-label="{{__('messages.version')}}">
                    <span class="badge bg-success">V{{$info['version']}}</span>
                </td>
                <td data-label="{{__('messages.action')}}">
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
