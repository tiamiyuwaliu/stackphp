<div class="header clearfix">
    <div class="float-start">
        <h4>{{__('messages.products-manager')}}</h4>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
                @if($page == 'product')
                    <li class="breadcrumb-item active" aria-current="page">{{__('messages.products')}}</li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{__('messages.plugins')}}</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="actions float-end ">
        <a href="" data-bs-toggle="modal" data-bs-target="#newProductModal" class="btn btn-primary">{{__('messages.add-new')}}</a>
    </div>
</div>


<div class="box box-table shadow-sm mt-4">
    <table class="modern-table ">
        <thead>
        <tr>
            <th scope="col">{{__('messages.title')}}</th>
            <th scope="col">{{__('messages.version')}}</th>
            <th scope="col">{{__('messages.sales')}}</th>
            <th scope="col">{{__('messages.views')}}</th>
            <th scope="col">{{__('messages.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products->items() as $product)
            <tr>
                <td data-label="{{__('messages.title')}}">
                    <h6><a href="">{{$product->short_name}}</a> </h6>
                    <p>{{$product->title}}</p>
                </td>
                <td data-label="{{__('messages.version')}}">
                    <span class="badge bg-success">{{$product->version}}</span>
                </td>
                <td data-label="{{__('messages.sales')}}">
                    <span class="badge bg-success">{{$product->sales}}</span>
                </td>
                <td data-label="{{__('messages.views')}}">
                    <span class="badge bg-success">{{$product->views}}</span>
                </td>
                <td data-label="{{__('messages.action')}}">
                    <a href="" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editPageModal{{$product->id}}"><i class="bi bi-pencil"></i></a>
                    <a href="{{url('cp/products')}}?action=delete&id={{$product->id}}" class="btn btn-light btn-sm confirm" data-ajax-action="true"><i class="bi bi-trash"></i></a>

                </td>
            </tr>
            {{view('cp.products.edit', ['product' => $product, 'page' => $page])}}
        @endforeach
        </tbody>
    </table>

</div>


{{view('cp.products.add', ['page'  => $page])}}
