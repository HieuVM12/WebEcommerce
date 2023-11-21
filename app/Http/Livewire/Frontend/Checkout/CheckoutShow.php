<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Support\Str;
class CheckoutShow extends Component
{
    public $carts, $totalProductAmount;
    public $fullname, $email, $phone, $address, $address2, $payment_mode =NULL , $payment_id =NULL;
    protected $listeners = ['validationForAll', 'transactionEmit' => 'paidOnlineOrder'];
    public function paidOnlineOrder($value)
    {
        $this->payment_id = $value;
        $this->payment_mode = 'PayPal';
        $codeOrder = $this->placeOrder();
        if($codeOrder)
        {
            Cart::where('user_id',auth()->user()->id)->delete();
            $this->dispatchBrowserEvent('message',[
                'text' => 'Đặt hàng thành công',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect('thank-you');
        }else{
            $this->dispatchBrowserEvent('message',[
                'text' => 'Có lỗi xảy ra',
                'type' => 'error',
                'status' => 400
            ]);
        }
    }
    public function validationForAll()
    {
        $this->validate();
    }
    public function rules()
    {
        return [
            'fullname' => 'required|string|max:120',
            'email' => 'required|email|max:120',
            'phone'=> 'required|min:10|max:10|string|regex:/^[0-9]*$/',
            'address'=>'required|max:255',
            'address2'=>'nullable|max:255'
        ];
    }
    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' =>auth()->user()->id,
            'tracking_no' => Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' =>$this->phone,
            'address' =>$this->address,
            'address2' => $this->address2,
            'status_message' => 'Đang xử lý',
            'payment_mode' => $this->payment_mode,
            'payment_id' =>$this->payment_id,
            'total' => $this->totalProductAmount(),
        ]);
        foreach($this->carts as $cartItem)
        {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' =>$cartItem->product_id,
                'product_color_id'=>$cartItem->product_color_id,
                'quantity'=>$cartItem->quantity,
                'price' => $cartItem->product->selling_price
            ]);

        }
        return $order;
    }
    public function codeOrder()
    {
        $this->payment_mode = 'Cash';
        $codeOrder = $this->placeOrder();
        if($codeOrder)
        {
            Cart::where('user_id',auth()->user()->id)->delete();
            $this->dispatchBrowserEvent('message',[
                'text' => 'Đặt hàng thành công',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect('thank-you');
        }else{
            $this->dispatchBrowserEvent('message',[
                'text' => 'Có lỗi xảy ra',
                'type' => 'error',
                'status' => 400
            ]);
        }
    }
    public function totalProductAmount()
    {
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        $this->totalProductAmount = 0;
        foreach($this->carts as $cartItem)
        {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }
    public function render()
    {
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show',[
            'totalProductAmout' => $this->totalProductAmount,
            'cart'=>$this->carts,
        ]);
    }
}
