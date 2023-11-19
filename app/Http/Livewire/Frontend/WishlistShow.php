<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistShow extends Component
{
    public function removeWishlistItem(int $wishlistItemId)
    {
        Wishlist::where('user_id',auth()->user()->id)->where('id',$wishlistItemId)->delete();
        $this->emit('wishlistAddedUpdated');
        $this->dispatchBrowserEvent('message',[
            'text'=>'Xóa thành công',
            'type'=>'success',
            'status'=>200
        ]);
    }
    public function render()
    {
        $wishlist = Wishlist::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show',[
            'wishlist'=> $wishlist,
        ]);
    }
}
