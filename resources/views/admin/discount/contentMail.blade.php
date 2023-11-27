<p>Xin chào khách hàng {{$user->name}},</p>
<p>Nhân dịp sự kiện {{$discount->description}}, cửa hàng ZayShop tặng bạn code mã giảm giá: [<strong> {{$discount->code}} </strong>] giảm <strong>{{$discount->discount_percentage}}%</strong> giá trị đơn hàng.</p>
<p>Thời gian hiệu lực từ ngày {{ \Carbon\Carbon::parse($discount->valid_from)->format('d-m-Y') }} đến ngày {{ \Carbon\Carbon::parse($discount->valid_to)->format('d-m-Y') }}</p>
<p>Thân ái,</p>
<p>Hiếu</p>

