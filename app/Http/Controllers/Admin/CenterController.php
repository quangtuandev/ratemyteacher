<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Center;

class CenterController extends Controller
{
    public function index()
    {
        $centers = center::all();
        return view('admin.center.index', compact('centers'));
    }

    public function destroy($id)
    {
        $center = Center::where('id', $id)->delete();
        if ($center) {
            return redirect()->back()->withFlashSuccess('Xóa thành công');
        }
        return redirect()->back()->withFlashDanger('Đã có lỗi xảy ra vui lòng thử lại');
    }
}
