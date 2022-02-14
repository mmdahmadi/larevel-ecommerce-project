<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use function PHPUnit\Framework\at;

class WhishlistController extends Controller
{
    public function add(Product $product)
    {
        if (auth()->check()){
            if ($product->checkUserWishlist(auth()->id())){
                alert()->warning('محصول مورد نظر به لیست علاقه مندیها اضافه شده است', 'دقت کنید')->persistent('حله');
                return redirect()->back();
            }else{
                Wishlist::create([
                   'user_id' => auth()->id(),
                   'product_id' => $product->id,
                ]);
                alert()->success('محصول مورد نظر به لیست علاقه مندیهای شما اضافه شد', 'با تشکر');
                return redirect()->back();
            }

        }else{
            alert()->warning('برای افزودن به لیست علاقه مندیها لازم است در ابتدا وارد سایت شوید', 'دقت کنید')->persistent('حله');
            return redirect()->back();
        }
    }

    public function remove(Product $product)
    {
        if (auth()->check()){
            $wishlist = Wishlist::where('product_id' , $product->id)->where('user_id' , auth()->id())->firstOrFail();
            if ($wishlist){
                $wishlist = Wishlist::where('product_id' , $product->id)->where('user_id' , auth()->id())->delete();
            }


            alert()->success('محصول مورد نظر از لیست علاقه مندیهای شما حذف شد', 'دقت کنید')->persistent('حله');
            return redirect()->back();

        }else{
            alert()->warning('برای حذف از لیست علاقه مندیها لازم است در ابتدا وارد سایت شوید', 'دقت کنید')->persistent('حله');
            return redirect()->back();
        }
    }

    public function usersProfileIndex()
    {
        $wishlist = Wishlist::where('user_id' , auth()->id())->get();
        return view('home.users_profile.wishlist' , compact('wishlist'));
    }
}
