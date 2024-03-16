
<div class="sending">


    <form action="{{ route('send.message') }}" method="POST">
        @csrf
        <h4 class="text">Để lại lời nhắn cho chúng tôi</h4>
        <div>
            <div class="icon">
                <i class="fa-regular fa-envelope"></i>
            </div>
            <input type="email" name="email" placeholder="Địa chỉ email của bạn">
        </div>
        <div>
            <textarea name="message" id="" placeholder="Chúng tôi giúp gì được cho bạn?"></textarea>
        </div>
        <button class="btn" type="submit">Gửi</button>
    </form>
</div>
