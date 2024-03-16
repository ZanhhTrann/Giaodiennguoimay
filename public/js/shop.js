const take_one = document.querySelector.bind(document);
const take_all = document.querySelectorAll.bind(document);
$('.owl-carousel').owlCarousel({
    items:1,
    loop:true,
    // margin:10,
    nav:false,
    // autoplay:true,
    autoplayTimeout: 3000,
    autoplayHoverPause:true,
    responsive: {
        768: {
            nav: true,
            dots: false
        }
    }
})
// HEADER
const header = take_one('#header');
const header_menu = take_one('#header .header_menu')
const search_btn = take_one('.header_nav .search')
const header_search = take_one('.header_search')
const header_search_iconClose = take_one('.header_search .icon-close')
const icon_bars = take_one('.icon.bars')
const icon_cart = take_one('.icon.cart')
const icon_heart = take_one('.icon.heart')

const products_list = take_one('.products_list');
const heart_icons = take_all('.products_list .item_detail .icon');
const filter_item = take_one('#section .overview_product .filter_item')
const products_sort = take_one('#section .overview_product .products_sort')
const categories_sort=take_one('#section .overview_product .categories_sort')
const btn_view = take_all('.products_list-item .btn_view');
const item_detail_price = take_all('.item_detail-price span');
const sort_list_item = take_all('.sort_list-item');
const sort_list_item_a = take_all('.sort_list-item a');
// overlay
const overlay_quick_view = take_one('.overlay_quick_view');
const close_quick_view = take_one('.close_quick_view')
const open_quick_view = take_all('.products_list-item .item_img .btn');
const next_img_desc = take_all('.btn_next')
const prev_img_desc = take_all('.btn_prev')
const slide_banner = take_all('.slide_banner');

// overlay
const header_cart_overlay = take_one('.header_cart.overlay')
const close_overlay_btn = take_one('.header_cart-container_title .icon')
// wishlist
const header_wishlist_overlay = take_one('.wishlist.overlay')
const close_wishlist = take_one('.wishlist-container_title .icon')

$(document).ready(function () {

window.addEventListener("scroll", function() {
    // $(document).width() > 992
    if(window.scrollY > 0) {
        header.classList.add('active')
    } else {
        header.classList.remove('active')
    }

    var btn_BackToTop = document.querySelector('.btn_back-to-top');
    btn_BackToTop.classList.toggle('active', window.scrollY > 250);
})

// ================HANDLE BACK-TO-TOP===============
$('.btn_back-to-top').click(function(){
    $('html').animate({scrollTop: 0});
    // removing smooth scroll on slide-up button click
    $('html').css("scrollBehavior", "auto");
});



// ================HANDLE HEADER================
search_btn.addEventListener("click", function() {
    header_search.classList.toggle('active')
})
header_search_iconClose.addEventListener("click", (e)=> {
    // Ngăn sự kiện nổi bọt
    e.stopPropagation();
    header_search.classList.toggle('active')
})
header_search.addEventListener("click", (e)=> {
    if(e.currentTarget == e.target) {
        header_search.classList.toggle('active')
    }
})
// Kiểm tra xem trang đã lưu trong Local Storage chưa
const currentPage = localStorage.getItem('currentPage');

// Nếu trang đã lưu trong Local Storage, kích hoạt nó
if (currentPage) {
    const menuItem = document.querySelector(`.item[data-page="${currentPage}"]`);
    if (menuItem) {
        menuItem.classList.add('active');
    }
}

// Lắng nghe sự kiện click trên menu
const menuItems = document.querySelectorAll('.item');
menuItems.forEach((menuItem) => {
    menuItem.addEventListener('click', (event) => {
        // Loại bỏ lớp 'active' từ tất cả các phần tử menu
        menuItems.forEach((item) => item.classList.remove('active'));

        // Thêm lớp 'active' vào phần tử menu được chọn
        const selectedPage = event.currentTarget.getAttribute('data-page');
        event.currentTarget.classList.add('active');

        // Lưu trạng thái trang đang chọn vào Local Storage
        localStorage.setItem('currentPage', selectedPage);
    });
});


var btn_icons = [icon_cart, icon_heart];
btn_icons.forEach(function(e) {
    e.addEventListener('click', function() {
        e.classList.toggle('active')
    })
})
// overlay: open-close
icon_cart.addEventListener('click', function() {
    header_cart_overlay.classList.toggle('active')
})
header_cart_overlay.addEventListener('click', function(e) {
    if(e.currentTarget == e.target) {
        header_cart_overlay.classList.toggle('active')
        icon_cart.classList.toggle('active')
    }
})
close_overlay_btn.addEventListener('click', function(e) {
    e.stopPropagation();
    header_cart_overlay.classList.toggle('active')
    icon_cart.classList.toggle('active')
})

// wishlist
icon_heart.addEventListener('click', function() {
    header_wishlist_overlay.classList.toggle('active')
})
header_wishlist_overlay.addEventListener('click', function(e) {
    if(e.currentTarget == e.target) {
        header_wishlist_overlay.classList.toggle('active')
        icon_heart.classList.toggle('active')
    }
})
close_wishlist.addEventListener('click', function(e) {
    e.stopPropagation();
    header_wishlist_overlay.classList.toggle('active')
    icon_heart.classList.toggle('active')
})


});

// SECTION

// overlay
// open_quick_view.forEach(function(e, index) {
//     e.addEventListener('click', function() {
//         if(overlay_quick_view) {
//             overlay_quick_view.classList.toggle('active')
//         }
//     })
// })
// close_quick_view.addEventListener('click', function(e) {
//     if(overlay_quick_view) {
//         // Ngăn sự kiện nổi bọt
//         e.stopPropagation();
//         overlay_quick_view.classList.toggle('active')
//     }
// })

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
// const arr_default = [];
// products_list_item.forEach(function(e) {
//     arr_default.push(e.outerHTML);
// })

sort_list_item.forEach(function(e, index) {
    e.addEventListener('click',function() {
    })
})







