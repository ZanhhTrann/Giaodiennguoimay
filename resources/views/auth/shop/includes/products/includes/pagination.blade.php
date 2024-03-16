@if(!empty($pages))
    <div>
        <ul class="pagination">
            @if($page > 1)
                <li>
                    <a class="page" data-page="{{$page-1}}" href="#"><<</a>
                </li>
            @endif
            @if($page > 3)
                <li>
                    <a class="page" data-page="{{1}}" href="#">1</a>
                </li>
            @endif
            @if($page > 4)
                <li>...</li>
            @endif
            @for($i=(($page>=3)? $page-2:1); $i <= ((($page+3)<=$pages?$page+2:$pages)); $i++)
                <li>
                    <a class="page  {{ ($i == $page) ? 'active' : '' }}" data-page="{{$i}}" href="#">{{ $i }}</a>
                </li>
            @endfor
            @if($page < $pages-3)
                <li>...</li>
            @endif
            @if($page < $pages-2)
                <li>
                    <a class="page" data-page="{{$pages}}" href="#">{{$pages}}</a>
                </li>
            @endif
            @if($page < $pages)
                <li>
                    <a class="page" data-page={{$page+1}} href="#">>></a>
                </li>
            @endif
        </ul>
    </div>
@endif
<script>
    document.querySelectorAll(".page").forEach(function(link) {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            // var newPage = link.getAttribute("data-page");

            var activeValues = getActiveValues();
            activeValues['page']=link.getAttribute("data-page");
            // console.log(activeValues['page']);
            // Gọi hàm sendFormData để thực hiện load dữ liệu
            $.ajax({
                url: "{{ route('updatePagination') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    value: activeValues,
                },
                success: function (data) {
                    // Ẩn hiệu ứng loading khi nhận được response
                    // console.log(data);
                    // Chỉ định giá trị cụ thể của redirectUrl
                    window.location.replace(data)
                },
                error: function () {
                    // Xử lý khi có lỗi
                    $('#list').html('<div class="spinner"><div class="error-message">Có lỗi xảy ra</div></div>');
                }
            });
        });
    });

</script>
