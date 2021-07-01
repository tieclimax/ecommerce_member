<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\User;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\PostComment;
use App\Rules\MatchOldPassword;
use Hash;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        return view('user.index');
    }

    public function profile()
    {
        $profile = Auth()->user();
        $seller = User::where('provider_id', $profile->id)->first();
        // dd($seller);
        // return $profile;
        return view('user.users.profile', compact('profile', 'seller'));
    }

    public function profileUpdate(Request $request, $id)
    {
        // return $request->all();

        // dd($request->all())
        $user = User::findOrFail($id);
        $data = $request->all();
        // dd($data);
        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'ทำการอัพเดทโปรไฟล์ของคุณเรียบร้อยแล้ว');
        } else {
            request()->session()->flash('error', 'กรุณาลองอีกครั้ง!');
        }
        return redirect()->back();
    }
    public function certUpdate(Request $request, $id)
    {

        // dd($request->all());
        $user = User::findOrFail($id);

        $data = $request->all();

        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'ทำการอัพเดทใบอนุญาติการลงขายสินค้าของคุณเรียบร้อยแล้ว');
        } else {
            request()->session()->flash('error', 'กรุณาลองอีกครั้ง!');
        }
        return redirect()->back();
    }

    // Order
    public function orderIndex()
    {
        $orders = Order::orderBy('id', 'DESC')->whereIn("status", ["new", "process", "cancel"])->where('user_id', auth()->user()->id)->paginate(5);
        return view('user.order.index')->with('orders', $orders);
    }
    public function userOrderDelete($id)
    {
        $order = Order::find($id);
        if ($order) {
            if ($order->status == "process" || $order->status == 'delivered' || $order->status == 'cancel') {
                return redirect()->back()->with('error', 'You can not delete this order now');
            } else {
                $status = $order->delete();
                if ($status) {
                    request()->session()->flash('success', 'ลบคำสั่งซื้อสำเร็จ');
                } else {
                    request()->session()->flash('error', 'ไม่สามารถลบคำสั่งซื้อได้ในขณะนี้');
                }
                return redirect()->route('user.order.index');
            }
        } else {
            request()->session()->flash('error', 'ไม่พบคำสั่งซื้อ');
            return redirect()->back();
        }
    }

    public function orderShow($id)
    {
        $order = Order::find($id);
        $product_carts = Cart::where("order_id", $id)->get();

        return view('user.order.show', compact("order", "product_carts"));
    }
    public function orderEdit($id)
    {
        $order = Order::find($id);
        return view('user.order.edit')->with('order', $order);
    }

    public function slipUpload(Request $request, $id)
    {
        $order = Order::find($id);
        $this->validate($request, [
            'slip_photo' => 'string|required'
        ]);
        $data = $request->all();
        // dd($order->status);
        if ($order->status != "new") {
            request()->session()->flash('error', 'อัปโหลดรูปภาพไม่สำเร็จ สถานะกำลังอยู่ระหว่างดำเนินการ!');
            return redirect()->route('user.order.index');
        }
        $status = $order->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'อัปโหลดรูปภาพสำเร็จ');
        } else {
            request()->session()->flash('error', 'อัปโหลดรูปภาพไม่สำเร็จ');
        }
        return redirect()->route('user.order.index');
    }
    // Product Review
    public function productReviewIndex()
    {
        $reviews = ProductReview::getAllUserReview();
        return view('user.review.index')->with('reviews', $reviews);
    }

    public function productReviewEdit($id)
    {
        $review = ProductReview::find($id);
        // return $review;
        return view('user.review.edit')->with('review', $review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productReviewUpdate(Request $request, $id)
    {
        $review = ProductReview::find($id);
        if ($review) {
            $data = $request->all();
            $status = $review->fill($data)->update();
            if ($status) {
                request()->session()->flash('success', 'อัปเดตรีวิวเรียบร้อยแล้ว');
            } else {
                request()->session()->flash('error', 'บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!!');
            }
        } else {
            request()->session()->flash('error', 'ไม่พบรีวิว !!');
        }

        return redirect()->route('user.productreview.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productReviewDelete($id)
    {
        $review = ProductReview::find($id);
        $status = $review->delete();
        if ($status) {
            request()->session()->flash('success', 'ลบบทวิจารณ์เรียบร้อยแล้ว');
        } else {
            request()->session()->flash('error', 'บางอย่างผิดพลาด! ลองอีกครั้ง');
        }
        return redirect()->route('user.productreview.index');
    }

    public function userComment()
    {
        $comments = PostComment::getAllUserComments();
        return view('user.comment.index')->with('comments', $comments);
    }
    public function userCommentDelete($id)
    {
        $comment = PostComment::find($id);
        if ($comment) {
            $status = $comment->delete();
            if ($status) {
                request()->session()->flash('success', 'ลบความคิดเห็นของโพสต์เรียบร้อยแล้ว');
            } else {
                request()->session()->flash('error', 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง!');
            }
            return back();
        } else {
            request()->session()->flash('error', 'ไม่พบโพสต์ความคิดเห็น');
            return redirect()->back();
        }
    }
    public function userCommentEdit($id)
    {
        $comments = PostComment::find($id);
        if ($comments) {
            return view('user.comment.edit')->with('comment', $comments);
        } else {
            request()->session()->flash('error', 'ไม่พบความคิดเห็น');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userCommentUpdate(Request $request, $id)
    {
        $comment = PostComment::find($id);
        if ($comment) {
            $data = $request->all();
            // return $data;
            $status = $comment->fill($data)->update();
            if ($status) {
                request()->session()->flash('success', 'อัปเดตความคิดเห็นเรียบร้อยแล้ว');
            } else {
                request()->session()->flash('error', 'บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!!');
            }
            return redirect()->route('user.post-comment.index');
        } else {
            request()->session()->flash('error', 'ไม่พบความคิดเห็น');
            return redirect()->back();
        }
    }

    public function changePassword()
    {
        return view('user.layouts.userPasswordChange');
    }
    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('user')->with('success', 'เปลี่ยนรหัสผ่านสำเร็จแล้ว');
    }
}
