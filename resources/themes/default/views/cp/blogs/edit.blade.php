<div class="modal fade " id="editBlogModal{{$blog->id}}"  tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered ">

        <div class="modal-content">
            <form action="{{url('cp/blogs')}}" method="post" class="general-form">
                <input type="hidden" name="val[action]" value="save"/>
                <input type="hidden" name="val[id]" value="{{$blog->id}}"/>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">{{__('messages.edit-post')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="form-floating mt-3">
                        <input placeholder="a" required type="text" value="{{$blog->title}}" name="val[title]" class="form-control"/>
                        <label>{{__('messages.title')}}</label>
                    </div>
                    <div class="form-floating mt-3">
                        <input required type="text" name="val[slug]" value="{{$blog->slug}}" placeholder="social-box-url-slug"  class="form-control"/>
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
                        <textarea  name="val[description]" rows="3"  class="form-control ">{{$blog->description}}</textarea>
                    </div>
                    <div class="mt-4">
                        <label>{{__('messages.main-content')}}</label>
                        <textarea  name="html" rows="10"  class="form-control ">{{$blog->content}}</textarea>
                    </div>




                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">{{__('messages.save')}}</button>
                </div>
            </form>
        </div>

    </div>
</div>
