<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Notification;
use App\User;
use App\Notifications\StatusNotification;
use App\Models\PostComment;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = PostComment::getAllComments();
        return view('backend.comment.index')->with('comments', $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $post_info = Post::getPostBySlug($request->slug);
        // return $post_info;
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        // $data['post_id']=$post_info->id;
        $data['status'] = 'active';
        // return $data;
        $status = PostComment::create($data);
        $user = User::where('role', 'admin')->get();
        $details = [
            'title' => "New Comment created",
            'actionURL' => route('blog.detail', $post_info->slug),
            'fas' => 'fas fa-comment'
        ];
        Notification::send($user, new StatusNotification($details));
        if ($status) {
            request()->session()->flash('success', 'ขอขอบคุณที่แสดงความคิดเห็นกับเรา');
        } else {
            request()->session()->flash('error', 'บางอย่างผิดพลาด! กรุณาลองอีกครั้ง!!');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comments = PostComment::find($id);
        if ($comments) {
            return view('backend.comment.edit')->with('comment', $comments);
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
    public function update(Request $request, $id)
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
            return redirect()->route('comment.index');
        } else {
            request()->session()->flash('error', 'ไม่พบความคิดเห็น');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
}
