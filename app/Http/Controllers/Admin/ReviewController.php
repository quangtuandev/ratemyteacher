<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReviewTeacher;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = ReviewTeacher::all();
        return view('admin.review.index', compact('reviews'));
    }

    public function destroy($id)
    {
        $review = ReviewTeacher::where('id', $id)->delete();
        if ($review) {
            return redirect()->back()->with('message','Xóa thành công');
        }
        return redirect()->back()->with('message','Đã có lỗi xảy ra vui lòng thử lại');
    }
}
