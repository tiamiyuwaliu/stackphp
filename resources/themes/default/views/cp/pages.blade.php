
<div class="header clearfix">
    <div class="float-start">
        <h4>{{__('messages.pages-manager')}}</h4>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('messages.pages')}}</li>
            </ol>
        </nav>
    </div>
    <div class="actions float-end ">
        <a href="" data-bs-toggle="modal" data-bs-target="#newPageModal" class="btn btn-primary">{{__('messages.add-new-page')}}</a>
    </div>
</div>


<div class="box box-table shadow-sm mt-4">
    <table class="modern-table ">
        <thead>
        <tr>
            <th scope="col">{{__('messages.page')}}</th>
            <th scope="col">{{__('messages.views')}}</th>
            <th scope="col">{{__('messages.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages->items() as $page)
            <tr>
                <td data-label="{{__('messages.page')}}">
                    <h6><a href="{{url($page->page_slug)}}">{{$page->page_title}}</a> </h6>
                    <p>{{url($page->page_slug)}}</p>
                </td>
                <td data-label="{{__('messages.views')}}">
                    <span class="badge bg-success">{{$page->page_views}}</span>
                </td>
                <td data-label="{{__('messages.action')}}">
                    <a href="" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editPageModal{{$page->id}}"><i class="bi bi-pencil"></i></a>
                    <a href="{{url('cp/pages')}}?action=delete&id={{$page->id}}" class="btn btn-light btn-sm confirm" data-ajax-action="true"><i class="bi bi-trash"></i></a>

                </td>
            </tr>
            <div class="modal fade " id="editPageModal{{$page->id}}"  tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-centered ">

                    <div class="modal-content">
                        <form action="{{url('cp/pages')}}" method="post" class="general-form">
                            <input type="hidden" name="val[action]" value="edit"/>
                            <input type="hidden" name="val[id]" value="{{$page->id}}"/>
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalToggleLabel">{{__('messages.edit-page')}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating mt-2">
                                    <select class="form-control" name="val[type]">
                                        <option {{($page->page_type == 0) ? 'selected': null}} value="0">{{__('messages.page')}}</option>
                                        <option {{($page->page_type == 1) ? 'selected': null}} value="1">{{__('messages.link')}}</option>
                                    </select>
                                    <label>{{__('messages.page-type')}}</label>
                                </div>
                                <div class="mt-3">
                                    <label>{{__('messages.url')}}</label>
                                    <div class="input-group mt-2 mb-3">
                                        <span class="input-group-text" id="basic-addon3">{{url('/')}}/</span>
                                        <input value="{{$page->page_slug}}" required type="text" class="form-control" name="val[url]" >
                                    </div>
                                </div>

                                <div class="form-floating mt-3">
                                    <input value="{{$page->page_title}}" required type="text" name="val[title]" class="form-control"/>
                                    <label>{{__('messages.page-title')}}</label>
                                </div>

                                <div class="mt-4">
                                    <label>{{__('messages.content')}}</label>
                                    <textarea required name="val[content]" rows="10" class="form-control">{{$page->page_content}}</textarea>
                                </div>

                                <div class="form-floating mt-2">
                                    <select class="form-control" name="val[position]">
                                        <option {{($page->position == 0) ? 'selected': null}} value="0">{{__('messages.bottom-menu')}}</option>
                                        <option {{($page->position == 1) ? 'selected': null}} value="1">{{__('messages.top-menu')}}</option>
                                    </select>
                                    <label>{{__('messages.position')}}</label>
                                </div>

                                <div class="form-floating mt-3">
                                    <input  type="text" name="val[order]" value="{{$page->page_order}}" class="form-control"/>
                                    <label>{{__('messages.order')}}</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">{{__('messages.submit')}}</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
        </tbody>
    </table>

</div>


<div class="modal fade " id="newPageModal"  tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered ">

            <div class="modal-content">
                <form action="{{url('cp/pages')}}" method="post" class="general-form">
                    <input type="hidden" name="val[action]" value="add"/>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">{{__('messages.new-page')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mt-2">
                            <select class="form-control" name="val[type]">
                                <option value="0">{{__('messages.page')}}</option>
                                <option value="1">{{__('messages.link')}}</option>
                            </select>
                            <label>{{__('messages.page-type')}}</label>
                        </div>
                        <div class="mt-3">
                            <label>{{__('messages.url')}}</label>
                            <div class="input-group mt-2 mb-3">
                                <span class="input-group-text" id="basic-addon3">{{url('/')}}/</span>
                                <input required type="text" class="form-control" name="val[url]" >
                            </div>
                        </div>

                        <div class="form-floating mt-3">
                            <input required type="text" name="val[title]" class="form-control"/>
                            <label>{{__('messages.page-title')}}</label>
                        </div>

                        <div class="mt-4">
                            <label>{{__('messages.content')}}</label>
                            <textarea required name="val[content]" rows="10" class="form-control"></textarea>
                        </div>

                        <div class="form-floating mt-2">
                            <select class="form-control" name="val[position]">
                                <option value="0">{{__('messages.bottom-menu')}}</option>
                                <option value="1">{{__('messages.top-menu')}}</option>
                            </select>
                            <label>{{__('messages.position')}}</label>
                        </div>

                        <div class="form-floating mt-3">
                            <input type="text" name="val[order]" value="0" class="form-control"/>
                            <label>{{__('messages.order')}}</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">{{__('messages.submit')}}</button>
                    </div>
                </form>
            </div>

    </div>
</div>
