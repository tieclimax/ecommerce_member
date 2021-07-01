<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        return view('superadmin.notification.index');
    }
    public function show(Request $request)
    {
        $notification = Auth()->user()->notifications()->where('id', $request->id)->first();
        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['actionURL']);
        }
    }
    public function delete($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $status = $notification->delete();
            if ($status) {
                request()->session()->flash('success', 'ลบการประกาศแจ้งเตือนสำเร็จ');
                return back();
            } else {
                request()->session()->flash('error', 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง!');
                return back();
            }
        } else {
            request()->session()->flash('error', 'ไม่พบการแจ้งเตือน');
            return back();
        }
    }
}
