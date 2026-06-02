<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
       $list = User::select('id', 'name', 'email', 'phone', 'username', 'address', 'password', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);


        return view('backend.user.index', compact('list'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $slug = Str::of($request->name)->slug('-');

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone ?? '';
        $user->address = $request->address ?? '';
        $user->username = $request->username ?? $slug;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = $slug . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/user'), $fileName);
            $user->avatar = $fileName;
        } else {
            $user->avatar = 'default.jpg'; // hoặc giá trị mặc định khác nếu cần
        }

        $user->status = $request->status;
        $user->created_by = auth()->id() ?? 0;
        $user->updated_by = auth()->id() ?? 0;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Thêm người dùng thành công!');
    }

    public function show(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        return view('backend.user.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('backend.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $slug = Str::of($request->name)->slug('-');

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone ?? '';
        $user->address = $request->address ?? '';
        $user->username = $request->username ?? $slug;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = $slug . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/user'), $fileName);
            $user->avatar = $fileName;
        }

        $user->status = $request->status;
        $user->updated_by = auth()->id() ?? 0;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Cập nhật người dùng thành công!');
    }

       public function destroy($id)
    {
        $user = user::find($id);

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Người dùng không tồn tại.');
        }

        $user->delete(); // Soft delete

        return redirect()->route('user.index')->with('success', 'Người dùng đã được chuyển vào thùng rác.');
    }

    public function trash()
    {
        $list = User::onlyTrashed()
            ->select('id', 'name', 'email', 'phone', 'username', 'password', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.user.trash', compact('list'));
    }

     public function delete($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return redirect()->route('user.trash')->with('error', ' Người dùng không tồn tại trong thùng rác.');
        }


        // Xóa ảnh nếu có
        $image_path = public_path('assets/images/user/' . $user->avatar);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        // Xóa vĩnh viễn
        $user->forceDelete();

        return redirect()->route('user.trash')->with('success', 'Đã xóa vĩnh viễn người dùng.');
    }

    public function restore(string $id)
    {
        $user = User::withTrashed()->find($id);

        if ($user == null) {
            return redirect()->route('user.index')->with('error', 'Mẫu tin không tồn tại!');
        }

        $user->restore();

        return redirect()->route('user.trash')->with('success', 'Khôi phục thành công');
    }
}
