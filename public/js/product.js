// SECTION

// overlay
open_quick_view.forEach(function(e, index) {
    e.addEventListener('click', function() {
        if(overlay_quick_view) {
            overlay_quick_view.classList.toggle('active')
        }
    })
})
close_quick_view.addEventListener('click', function(e) {
    if(overlay_quick_view) {
        // Ngăn sự kiện nổi bọt
        e.stopPropagation();
        overlay_quick_view.classList.toggle('active')
    }
})

// ================HANDLE SECTION===============
heart_icons.forEach(function(e) {
    e.addEventListener('click', function() {
        e.classList.toggle('active');
    })
})

filter_item.addEventListener('click', function() {
    console.log(filter_item);
    filter_item.classList.toggle('active')
    products_sort.classList.toggle('active')
})

// filter_item.addEventListener('click', function() {
//     // Thay đổi màu nền của filter_item
//     filter_item.style.backgroundColor = 'red';

//     // Thay đổi văn bản của products_sort
//     products_sort.innerHTML = 'Đã chọn đúng!';
// });



// item product
var chosen_one;
var products_list_item = take_all('.products_list-item');
const categories_item = take_all('.products_menu .categories li')

// const categories_item = take_all('.products_menu .categories li');

//



// SORT LIST
const arr_default = [];
products_list_item.forEach(function(e) {
    arr_default.push(e.outerHTML);
})

sort_list_item.forEach(function(e, index) {
    e.addEventListener('click',function() {
        if(e.classList.value.includes("increase")) {
            sort_product_by_price(false)
        } else if(e.classList.value.includes("decrease")) {
            sort_product_by_price(true)
        } else if(e.classList.value.includes("default")) {
            sort_product_by_default()
        }

        // UI
        var sort_list_item_a_active = take_one('.sort_list-item a.active');
        if(sort_list_item_a_active) {
            sort_list_item_a_active.classList.remove('active');
        }
        sort_list_item_a[index].classList.add('active');
    })
})
// function sort_product_by_price(isReverse = false) {
//     var arr_price = [];
//     var htmls = [];
//     let products_item = take_all('.products_list-item')
//     let item_detail_price = take_all('.item_detail-price span');
//     item_detail_price.forEach(function(e, index) {
//         arr_price.push({
//             product_id: btn_view[index].value,
//             price: e.innerText*1,
//             contents: products_item[index].outerHTML
//         });
//     })
//     arr_price.sort((a, b) => a.price - b.price);
//     console.log(arr_price);
//     // CHECKING IS REVERSE
//     if(isReverse) { arr_price.reverse(); }
//     for(var i = 0; i< arr_price.length; i++) {
//         htmls.push(arr_price[i].contents);
//     }
//     products_list.innerHTML = htmls.join('');
// }
// function sort_product_by_default() {
//     products_list.innerHTML = arr_default.join('');
// }
