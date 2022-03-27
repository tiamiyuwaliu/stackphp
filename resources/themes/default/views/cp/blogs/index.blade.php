<div class="header clearfix">
    <div class="float-start">
        <h4>{{__('messages.blogs')}}</h4>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('messages.blogs')}}</li>
            </ol>
        </nav>
    </div>
    <div class="actions float-end ">
        <a href="" data-bs-toggle="modal" data-bs-target="#newBlogModal" class="btn btn-primary">{{__('messages.add-new')}}</a>
    </div>
</div>

<div class="box box-table shadow-sm mt-4">
    <table class="modern-table ">
        <thead>
        <tr>
            <th scope="col">{{__('messages.title')}}</th>
            <th scope="col">{{__('messages.views')}}</th>
            <th scope="col">{{__('messages.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($blogs->items() as $blog)
            <tr>
                <td data-label="{{__('messages.title')}}">
                    <h6><a href="">{{$blog->title}}</a> </h6>
                    <p>{{$blog->description}}</p>
                </td>
                <td data-label="{{__('messages.views')}}">
                    <span class="badge bg-success">{{$blog->views}}</span>
                </td>
                <td data-label="{{__('messages.action')}}">
                    <a href="" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editBlogModal{{$blog->id}}"><i class="bi bi-pencil"></i></a>
                    <a href="{{url('cp/blogs')}}?action=delete&id={{$blog->id}}" class="btn btn-light btn-sm confirm" data-ajax-action="true"><i class="bi bi-trash"></i></a>

                </td>
            </tr>
            {{view('cp.blogs.edit', ['blog' => $blog])}}
        @endforeach
        </tbody>
    </table>

</div>

<div class="modal fade " id="newBlogModal"  tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered ">

        <div class="modal-content">
            <form action="{{url('cp/blogs')}}" method="post" class="general-form">
                <input type="hidden" name="val[action]" value="add"/>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">{{__('messages.new-post')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="form-floating mt-3">
                        <input placeholder="a" required type="text" name="val[title]" class="form-control"/>
                        <label>{{__('messages.title')}}</label>
                    </div>
                    <div class="form-floating mt-3">
                        <input required type="text" name="val[slug]" placeholder="social-box-url-slug"  class="form-control"/>
                        <label>{{__('messages.friendly-url')}}</label>
                    </div>





                    <div class="row">
                        <div class="col-md-6">
                            <div class=" mt-3">
                                <label>{{__('messages.preview-image')}}</label>
                                <input  type="file" name="image_1" class="form-control"/>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" mt-3">
                                <label>{{__('messages.large-preview-image')}}</label>
                                <input  type="file" name="image_2" class="form-control"/>

                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label>{{__('messages.description')}}</label>
                        <textarea  name="val[description]" rows="3"  class="form-control "></textarea>
                    </div>
                    <div class="mt-4">
                        <label>{{__('messages.main-content')}}</label>
                        <textarea  name="html" rows="10"  class="form-control "></textarea>
                    </div>




                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">{{__('messages.submit')}}</button>
                </div>
            </form>
        </div>

    </div>
</div>

