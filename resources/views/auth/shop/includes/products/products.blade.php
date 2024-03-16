
<!-- overlay quick view -->
<div class="products_list" id="ListProducts">
    {{-- hien thi danh sach san pham --}}
    @include('auth.shop.includes.products.includes.sort',['visible'=>$response['visible']])
    @include('auth.shop.includes.quick_view.quick_view')
</div>
@if($response['pages']>1)
    @include('auth.shop.includes.products.includes.pagination',['page'=>$response['page'],'pages'=>$response['pages']])
@endif
