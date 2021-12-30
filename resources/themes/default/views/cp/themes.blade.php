<div class="header">
    <h3>{{__('messages.themes-manager')}}</h3>
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
                <th>{{__('messages.theme')}}</th>
                <th>{{__('messages.version')}}</th>
                <th>{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($themes as $theme => $info)
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="moduleInput{{$theme}}">
                            <label class="form-check-label" for="moduleInput{{$theme}}">
                            </label>
                        </div>
                    </td>
                    <td>
                        <h5>{{$info['title']}} - <span class="badge bg-info">{{$info['author']}}</span></h5>

                    </td>
                    <td>
                        <span class="badge bg-success">V{{$info['version']}}</span>
                    </td>
                    <td>
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
