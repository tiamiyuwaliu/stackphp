<div class="header clearfix">
    <h3 class="float-start">{{__('messages.users-manager')}}</h3>
    <div class="actions float-end ">
        <a href="" data-bs-toggle="offcanvas" data-bs-target="#newUser" class="btn btn-primary">{{__('messages.add-new-user')}}</a>
        <a href="" class="btn btn-outline-secondary"><i class="bi bi-funnel"></i></a>
    </div>
</div>

<div  class="content-body">
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
                    <th>{{__('messages.user')}}</th>
                    <th>{{__('messages.status')}}</th>
                    <th>{{__('messages.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users->items() as $user)
                    <tr >
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="userCheckInput{{$user->id}}">
                                <label class="form-check-label" for="userCheckInput{{$user->id}}">
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex ">
                                <div class="flex-shrink-0">
                                    <img class="user-avatar-round-sm" src="{{\App\Repositories\User::repository()->getAvatar($user)}}" alt="...">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-0">{{$user->name}}</h5>
                                    <p>{{$user->email}}</p>
                                </div>
                            </div>

                        </td>

                        <td>
                            <span class="badge bg-success">{{__('messages.active')}}</span>
                        </td>
                        <td>
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
                                    <select class="form-control select-timezone" name="val[timezone]">
                                        <option value="">{{__('messages.select-timezone')}}</option>
                                        @foreach(getTimezones() as $key => $name)
                                            <option {{($user->timezone == $key) ? 'selected': null}} value="{{$key}}">{{$name}}</option>
                                        @endforeach
                                        <label>{{__('messages.select-timezone')}}</label>
                                    </select>
                                </div>

                                <h5 class="mt-4">{{__('messages.change-password')}}</h5>
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
