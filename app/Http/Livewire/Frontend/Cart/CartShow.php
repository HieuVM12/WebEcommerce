<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;
    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            if($cartData->quantity > 1){
                $cartData->decrement('quantity');
                $this->dispatchBrowserEvent('message',[
                    'text' => 'Đã cập nhật số lượng',
                    'type' => 'success',
                    'status' => 200
                ]);
            }else{
                $this->dispatchBrowserEvent('message',[
                    'text' => 'Chọn tối thiểu là 1',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        }else{
            $this->dispatchBrowserEvent('message',[
                'text' => 'Có lỗi xảy ra',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }
    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            $productColor = $cartData->productColor()->first();
            if($cartData->quantity < $productColor->quantity){
                if($cartData->quantity < 10){
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message',[
                        'text' => 'Đã cập nhật số lượng',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }else{
                    $this->dispatchBrowserEvent('message',[
                        'text' => 'Chọn tối đa là 10',
                        'type' => 'warning',
                        'status' => 404
                    ]);
                }
            }else{
                $this->dispatchBrowserEvent('message',[
                    'text' => 'Chỉ có '.$productColor->quantity.' sản phẩm',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        }else{
            $this->dispatchBrowserEvent('message',[
                'text' => 'Có lỗi xảy ra',
                'type' => 'error',
                'status' => 400
            ]);
        }
    }
    public function removeCartItem($cartItemId)
    {
        $cartRemove = Cart::where('user_id',auth()->user()->id)->where('id',$cartItemId)->first();
        if($cartRemove){
            $cartRemove->delete();
            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message',[
                'text' => 'Đã xóa sản phẩm khỏi giỏ hàng',
                'type' => 'success',
                'status' => 200
            ]);
        }else{
            $this->dispatchBrowserEvent('message',[
                'text' => 'Có lỗi xảy ra',
                'type' => 'error',
                'status' => 400
            ]);
        }
    }
    public function render()
    {
        $this->cart = Cart::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show',[
            'cart'=>$this->cart,
        ]);
    }
}
