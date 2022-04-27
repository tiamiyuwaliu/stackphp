<div class="content-padding scroll-inner-right modern-scroll">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="box stat">
                    <i class="bi bi-graph-down-arrow"></i>
                    <div class="info">
                        <h4>0</h4>
                        <h6>{{__('messages.page-views')}}</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box stat">
                    <i class="bi bi-link"></i>
                    <div class="info">
                        <h4>0</h4>
                        <h6>{{__('messages.active-pages')}}</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box stat">
                    <i class="bi bi-box-arrow-up-left"></i>
                    <div class="info">
                        <h4>0</h4>
                        <h6>{{__('messages.inactive-pages')}}</h6>
                    </div>
                </div>
            </div>

        </div>
        <div class="box box-padding d-flex">
            <h6 class="flex-grow-1">{{__('messages.bio-link')}}</h6>
            <div>
                <a href="" data-bs-target="#bioLinkModal" data-bs-toggle="modal" class="btn btn-dark btn-sm">{{__('messages.create-page')}}</a>
            </div>
        </div>



        @if(count($links))
           <h5 class="mt-3 mb-3">{{__('messages.bio-pages')}}</h5>

            <div class="links-container">
                @foreach($links as $link)
                    {!! view('app/builder/bio/display', ['link' => $link]) !!}
                @endforeach
            </div>
        @else
            <div class="empty-result">
                <img  src="{{url('resources/themes/default/images/empty-result.png')}}"/>
            </div>
        @endif
    </div>
</div>


<div class="modal" id="bioLinkModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('messages.add-bio-link')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('builder/bio')}}" method="post" class="general-form">
                <input type="hidden" name="val[action]" value="add"/>
                <div class="modal-body">
                    <div class="mb-3">
                        <input  required type="text" name="val[title]" class="form-control" id="floatingInputTitle" placeholder="{{__('messages.title')}}">

                    </div>

                    <label for="basic-url" class="form-label">{{__('messages.biolink-url')}}</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text" >{{config('link-base-domain', url('/'))}}/</span>
                        <input type="text" class="form-control" name="val[slug]" placeholder="slug-here" >
                    </div>
                    <small class="text-muted">{{__('messages.leave-empty-generate-one')}}</small>
                </div>
                <div class="mt-3 d-flex p-3 pt-1">
                    <button type="submit" class="btn btn-primary ">{{__('messages.create-page')}}</button>

                </div>
            </form>
        </div>
    </div>
</div>
