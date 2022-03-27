<div class="modal fade " id="newProductModal"  tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered ">

        <div class="modal-content">
            <form action="{{url('cp/products')}}" method="post" class="general-form">
                <input type="hidden" name="val[action]" value="add"/>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">{{__('messages.new-product')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($page == 'plugins')
                        <div class="form-floating mt-2">
                            <select required class="form-control" name="val[product_id]">
                                @foreach(\App\Repositories\Product::repository()->getAllList(1) as $product)
                                    <option value="{{$product->id}}">{{$product->title}}</option>
                                @endforeach


                            </select>
                            <label>{{__('messages.product')}}</label>
                        </div>
                    @endif
                    <div class="form-floating mt-2">
                        <select class="form-control" name="val[type]">
                            <option value="1">{{__('messages.product')}}</option>
                            <option value="2">{{__('messages.plugin')}}</option>
                        </select>
                        <label>{{__('messages.product-type')}}</label>
                    </div>

                        <div class="form-floating mt-3">
                            <input required type="text" name="val[slug]" placeholder="social-box-url-slug"  class="form-control"/>
                            <label>{{__('messages.friendly-url')}}</label>
                        </div>
                    <div class="form-floating mt-3">
                        <input placeholder="a" required type="text" name="val[date]"  class="form-control"/>
                        <label>{{__('messages.update-date')}}</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mt-3">
                                <input placeholder="a" required type="text" name="val[name]" class="form-control"/>
                                <label>{{__('messages.short-name')}}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mt-3">
                                <input placeholder="a" required type="text" name="val[title]" class="form-control"/>
                                <label>{{__('messages.title')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mt-3">
                                <input placeholder="a" required type="text" name="val[version]" class="form-control"/>
                                <label>{{__('messages.version')}}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mt-3">
                                <input placeholder="a"  type="text" name="val[sales]" class="form-control"/>
                                <label>{{__('messages.sales')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mt-3">
                                <input placeholder="a" type="text" name="val[demo_link]" class="form-control"/>
                                <label>{{__('messages.demo-link')}}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mt-3">
                                <input placeholder="a" type="text" name="val[doc_link]" class="form-control"/>
                                <label>{{__('messages.documentation-link')}}</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mt-3">
                                <input placeholder="a" type="text" name="val[price_regular]" class="form-control"/>
                                <label>{{__('messages.price-regular')}}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mt-3">
                                <input placeholder="a" type="text" name="val[price_extended]" class="form-control"/>
                                <label>{{__('messages.price-extended')}}</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mt-3">
                                <input placeholder="a" type="text" name="val[regular_link]" class="form-control"/>
                                <label>{{__('messages.regular-link')}}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mt-3">
                                <input placeholder="a" type="text" name="val[extended_link]" class="form-control"/>
                                <label>{{__('messages.extended-link')}}</label>
                            </div>
                        </div>
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
                        <textarea  name="description"  class="form-control "></textarea>
                    </div>
                    <div class="mt-4">
                        <label>{{__('messages.features')}}</label>
                        <textarea  name="features"  class="form-control"></textarea>
                    </div>
                    <div class="mt-4">
                        <label>{{__('messages.html-content')}}</label>
                        <textarea  name="html"  class="form-control min-textarea-height"></textarea>
                    </div>

                    <div class="mt-4">
                        <label>{{__('messages.changelog')}}</label>
                        <textarea  name="changelog"  class="form-control min-textarea-height"></textarea>
                    </div>



                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">{{__('messages.submit')}}</button>
                </div>
            </form>
        </div>

    </div>
</div>
