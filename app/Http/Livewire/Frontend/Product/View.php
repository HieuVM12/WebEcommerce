<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $product, $productsRelated, $productColorSelectedQuantity, $quantityCount = 1, $productColorId;

    public function mount($product,$productsRelated)
    {
        $this->productsRelated= $productsRelated;
        $this->product=$product;
    }

    public function addToWishlist($productId)
    {
        if(Auth::check())
        {
            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists()){
                session()->flash('message','Sản phẩm đã tồn tại trong danh sách yêu thích!');
            }
            else
            {
                Wishlist::create([
                    'user_id'=> auth()->user()->id,
                    'product_id' => $productId,
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message','Sản phẩm đã được thêm vào danh sách yêu thích');
            }
        }
        else
        {
            session()->flash('message','Đăng nhập để tiếp tục');
            return false;
        }
    }
    public function incrementQuantity()
    {
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }else{
            $this->dispatchBrowserEvent('message',[
                'text' => 'Chọn tối đa là 10',
                'type' => 'warning',
                'status' => 404
            ]);
        }

    }
    public function decrementQuantity()
    {
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }else{
            $this->dispatchBrowserEvent('message',[
                'text' => 'Chọn tối thiểu là 1',
                'type' => 'warning',
                'status' => 404
            ]);
        }
    }
    public function addToCart(int $productId)
    {
        if(Auth::check()){
            if($this->product->where('id',$productId)->where('status','0')->exists()){
                if($this->productColorSelectedQuantity!==null){
                    $productColor = $this->product->productColors()->where('id',$this->productColorId)->first();
                    if($productColor->quantity>0){
                        if($productColor->quantity >= $this->quantityCount){
                            if(Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->where('product_color_id',$this->productColorId)->exists()){
                                $this->dispatchBrowserEvent('message',[
                                    'text' => 'Sản phẩm đã tồn tại trong giỏ hàng',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                            else{
                                Cart::create([
                                    'user_id'=>auth()->user()->id,
                                    'product_id'=>$productId,
                                    'product_color_id'=>$this->productColorId,
                                    'quantity'=>$this->quantityCount
                                ]);
                                $this->emit('CartAddedUpdated');
                                $this->dispatchBrowserEvent('message',[
                                    'text' => 'Đã thêm vào giỏ hàng',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            }
                        }else{
                            $this->dispatchBrowserEvent('message',[
                                'text' => 'Màu này không đủ số lượng sản phẩm',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }else{
                        $this->dispatchBrowserEvent('message',[
                            'text' => 'Màu này đã hết hàng',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                }else{
                    $this->dispatchBrowserEvent('message',[
                        'text' => 'Chọn màu sản phẩm',
                        'type' => 'warning',
                        'status' => 404
                    ]);
                }
            }else{
                $this->dispatchBrowserEvent('message',[
                    'text' => 'Sản phẩm không tồn tại',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        }else{
            $this->dispatchBrowserEvent('message',[
                'text' => 'Đăng nhập để tiếp tục',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }
    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
        $productColor = $this->product->productColors()->where('id',$productColorId)->first();
        $this->productColorSelectedQuantity = $productColor->quantity;
    }

    public function render()
    {
        return view('livewire.frontend.product.view',[
            'product'=>$this->product,
            'productsRelated'=>$this->productsRelated,
        ]);
    }
}
