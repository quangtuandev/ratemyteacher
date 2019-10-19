<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.teacher.index', compact('teachers'));
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        if ($user) {
            return redirect()->back()->withFlashSuccess('Xóa thành công');
        }
        return redirect()->back()->withFlashDanger('Đã có lỗi xảy ra vui lòng thử lại');
    }
}
