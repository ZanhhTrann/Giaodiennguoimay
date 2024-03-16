@php
    // lay danh sach cac loai vay
    $catController=new \App\Http\Controllers\CategoriesController();
    $catController->__getCategories();
@endphp
{{-- hien thi danh sach cac loai san pham --}}
<ul class="categories">
    <input type="hidden" name="selectedValue" id="selectedValue" value="">
    <li data-cid="0000" class="category-item {{ ("Tất cả sản phẩm" == $value) ? 'active' : '' }}"><a href="{{route('shopView',['value'=>'Tất cả sản phẩm','sort'=>'Mặc định','buy'=>'Tất cả','rent'=>'Tất cả','page'=>1])}}">Tất cả sản phẩm</a></li>
    <!-- Danh sách các danh mục -->
    @foreach (session('categories') as $category)
        <li data-cid="{{$category->Cid}}" class="category-item {{ ($category->Categories_name == $value) ? 'active' : '' }}"><a href="{{route('shopView',['value'=>$category->Categories_name,'sort'=>'Mặc định','buy'=>'Tất cả','rent'=>'Tất cả','page'=>1])}}">{{ $category->Categories_name}}</a></li>
    @endforeach
</ul>
