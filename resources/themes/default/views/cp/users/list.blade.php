<div class="header clearfix">
    <div class="float-start">
        <h4>{{__('messages.users-manager')}}</h4>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('messages.users')}}</li>
            </ol>
        </nav>
    </div>
    <div class="actions float-end">
        <a href="" data-bs-toggle="offcanvas" data-bs-target="#newUser" class="btn btn-primary">{{__('messages.add-new-user')}}</a>
    </div>
</div>


<div  class="content-body">
    <div id="statistics" class="row">
        <div class="col-md-3">
            <div class="each shadow-sm">
                <div class="clearfix">
                    <div class="float-start">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="float-end">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>

                <h5>{{__('messages.all-users')}}</h5>
                <h2>200</h2>

            </div>
        </div>
        <div class="col-md-3">
            <div class="each shadow-sm stat-color-pink">
                <div class="clearfix">
                    <div class="float-start">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="float-end">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>

                <h5>{{__('messages.active-users')}}</h5>
                <h2>200</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="each shadow-sm stat-color-pinklight">
                <div class="clearfix">
                    <div class="float-start">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="float-end">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>

                <h5>{{__('messages.inactive-users')}}</h5>
                <h2>200</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="each shadow-sm stat-color-green">
                <div class="clearfix">
                    <div class="float-start">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="float-end">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>

                <h5>{{__('messages.subscribers')}}</h5>
                <h2>200</h2>
            </div>
        </div>
    </div>

    <div class="box box-table shadow-sm mt-4">
        <table class="modern-table ">
            <thead>
            <tr>
                <th  scope="col">{{__('messages.avatar')}}</th>
                <th  scope="col">{{__('messages.user')}}</th>
                <th scope="col">{{__('messages.email-address')}}</th>
                <th  scope="col">{{__('messages.user-role')}}</th>
                <th  scope="col">{{__('messages.gender')}}</th>
                <th  scope="col">{{__('messages.status')}}</th>
                <th  scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users->items() as $user)
                <tr >
                    <td data-label="{{__('messages.avatar')}}">
                        <img class="user-avatar-round-sm" src="{{\App\Repositories\User::repository()->getAvatar($user)}}" alt="...">
                    </td>
                    <td data-label="{{__('messages.user')}}">
                        <h6 class="mb-0">{{$user->name}}</h6>
                    </td>
                    <td data-label="{{__('messages.email-address')}}">
                        {{$user->email}}
                    </td>
                    <td data-label="{{__('messages.user-role')}}">
                        @if($user->role == 1)
                            <span class="badge bg-secondary">{{__('messages.admin')}}</span>
                        @else
                            <span class="badge bg-secondary">{{__('messages.regular')}}</span>
                        @endif
                    </td>
                    <td data-label="{{__('messages.gender')}}">
                        {{ucwords($user->gender)}}
                    </td>
                    <td data-label="{{__('messages.status')}}">
                        <span class="badge bg-success">{{__('messages.active')}}</span>
                    </td>
                    <td data-label="{{__('messages.action')}}">
                        <a href="" class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#editUser{{$user->id}}"><i class="bi bi-pencil"></i></a>
                        @if($user->id != 1)
                            <a href="{{url('cp/users')}}?action=delete&id={{$user->id}}" class="btn btn-light btn-sm confirm" data-ajax-action="true"><i class="bi bi-trash"></i></a>
                        @endif
                    </td>
                </tr>

                <div class="offcanvas offcanvas-end offcanvas-lg"   tabindex="-1" id="editUser{{$user->id}}" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">{{__('messages.edit-user')}}</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form action="{{url('cp/users')}}" method="post" class="general-form">
                            <input type="hidden" name="val[action]" value="edit"/>
                            <input type="hidden" name="val[id]" value="{{$user->id}}"/>
                            <div class="form-floating mt-3">
                                <input required type="text" value="{{$user->name}}" name="val[name]" placeholder="{{__('messages.full-name')}}" class="form-control"/>
                                <label>{{__('messages.full-name')}}</label>
                            </div>

                            <div class="form-floating mt-3">
                                <input required type="text" value="{{$user->email}}" name="val[email]" placeholder="{{__('messages.email-address')}}" class="form-control"/>
                                <label>{{__('messages.email-address')}}</label>
                            </div>

                            <div class="form-floating mt-3">
                                <select class="form-control select-timezone" name="val[gender]">
                                    <option value="">{{__('messages.select-gender')}}</option>
                                    <option {{($user->gender == 'male') ? 'selected': null}} value="male">{{__('messages.male')}}</option>
                                    <option {{($user->gender == 'female') ? 'selected': null}} value="female">{{__('messages.female')}}</option>
                                </select>
                            </div>

                            <div class="form-floating mt-3">
                                <select class="form-control select-timezone" name="val[role]">
                                    <option value="">{{__('messages.select-user-role')}}</option>
                                    <option {{($user->role == 0) ? 'selected': null}} value="0">{{__('messages.user')}}</option>
                                    <option {{($user->role == 1) ? 'selected': null}} value="1">{{__('messages.admin')}}</option>
                                </select>
                            </div>


                            <div class="form-floating mt-3">
                                <select class="form-control select-timezone" name="val[timezone]">
                                    <option value="">{{__('messages.select-timezone')}}</option>
                                    @foreach(getTimezones() as $key => $name)
                                        <option {{($user->timezone == $key) ? 'selected': null}} value="{{$key}}">{{$name}}</option>
                                    @endforeach
                                    <label>{{__('messages.select-timezone')}}</label>
                                </select>
                            </div>

                            <h6 class="mt-4">{{__('messages.change-password')}}</h6>
                            <div class="form-floating mt-3">
                                <input  type="password" name="val[password]" placeholder="{{__('messages.password')}}" class="form-control"/>
                                <label>{{__('messages.password')}}</label>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>

        {{$users->links()}}
    </div>
</div>

<div class="offcanvas offcanvas-end offcanvas-lg"   tabindex="-1" id="newUser" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">{{__('messages.new-user')}}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{url('cp/users')}}" method="post" class="general-form">
            <input type="hidden" name="val[action]" value="add"/>
            <div class="form-floating mt-3">
                <input required type="text" name="val[name]" placeholder="{{__('messages.full-name')}}" class="form-control"/>
                <label>{{__('messages.full-name')}}</label>
            </div>

            <div class="form-floating mt-3">
                <input required type="text" name="val[email]" placeholder="{{__('messages.email-address')}}" class="form-control"/>
                <label>{{__('messages.email-address')}}</label>
            </div>

            <div class="form-floating mt-3">
                <input required type="password" name="val[password]" placeholder="{{__('messages.password')}}" class="form-control"/>
                <label>{{__('messages.password')}}</label>
            </div>

            <div class="form-floating mt-3">
                <select class="form-control select-timezone" name="val[gender]">
                    <option value="">{{__('messages.select-gender')}}</option>
                    <option value="male">{{__('messages.male')}}</option>
                    <option value="female">{{__('messages.female')}}</option>
                </select>
            </div>

            <div class="form-floating mt-3">
                <select class="form-control select-timezone" name="val[role]">
                    <option value="">{{__('messages.select-user-role')}}</option>
                    <option value="0">{{__('messages.user')}}</option>
                    <option value="1">{{__('messages.admin')}}</option>
                </select>
            </div>

            <div class="form-floating mt-3">
                <select class="form-control select-timezone" name="val[timezone]">
                    <option value="">{{__('messages.select-timezone')}}</option>
                    @foreach(getTimezones() as $key => $name)
                        <option value="{{$key}}">{{$name}}</option>
                    @endforeach
                    <label>{{__('messages.select-timezone')}}</label>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">{{__('messages.submit')}}</button>
            </div>
        </form>
    </div>
</div>
