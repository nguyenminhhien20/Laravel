<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // Hiển thị danh sách liên hệ
    public function index()
    {
        $list = Contact::select(
            'contact.id',
            'contact.name',
            'contact.email',
            'contact.phone',
            'contact.title',
            'contact.content',
            'contact.status'
        )
            ->leftJoin('user', 'contact.user_id', '=', 'user.id')
            ->orderBy('contact.created_at', 'desc')
            ->paginate(5);

        return view('backend.contact.index', compact('list'));
    }

    // Hiển thị form tạo mới liên hệ
    public function create()
    {
        $list_user = User::where('status', 1)->get();
        return view('backend.contact.create', compact('list_user'));
    }

    // Lưu thông tin liên hệ mới
    public function store(StoreContactRequest $request)
    {
        $contact = new Contact();
        $contact->user_id    = auth()->id(); // hoặc null nếu khách
        $contact->name       = $request->name;
        $contact->email      = $request->email;
        $contact->phone      = $request->phone;
        $contact->title      = $request->title;
        $contact->content    = $request->content;
        $contact->reply_id   = 0;
        $contact->created_by = auth()->id() ?? 0;
        $contact->status     = 1;
        $contact->save();

        return redirect()->route('contact.index')->with('success', 'Gửi liên hệ thành công!');
    }

    // Hiển thị chi tiết một liên hệ
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('backend.contact.show', compact('contact'));
    }

    // Hiển thị form chỉnh sửa liên hệ
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        $list_user = User::where('status', 1)->get();
        return view('backend.contact.edit', compact('contact', 'list_user'));
    }

    // Cập nhật thông tin liên hệ
    public function update(StoreContactRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->name       = $request->name;
        $contact->email      = $request->email;
        $contact->phone      = $request->phone;
        $contact->title      = $request->title;
        $contact->content    = $request->content;
        $contact->status     = $request->status;
        $contact->updated_by = auth()->id();
        $contact->save();

        return redirect()->route('contact.index')->with('success', 'Cập nhật liên hệ thành công!');
    }

    // Xoá mềm liên hệ (chuyển vào thùng rác)
    public function delete($id)
    {
        $contact = Contact::withTrashed()->find($id);

        if (!$contact) {
            return redirect()->route('contact.trash')->with('error', 'Liên hệ không tồn tại trong thùng rác.');
        }

        // Xóa ảnh nếu có (nếu có dùng thumbnail)
        $image_path = public_path('assets/images/contact/' . $contact->thumbnail);
        if (\File::exists($image_path)) {
            \File::delete($image_path);
        }

        // Xóa vĩnh viễn
        $contact->forceDelete();

        return redirect()->route('contact.trash')->with('success', 'Đã xóa vĩnh viễn liên hệ');
    }


    // Hiển thị danh sách liên hệ trong thùng rác
    public function trash()
    {
        $list = Contact::onlyTrashed()
            ->select(
                'contact.id',
                'contact.name',
                'contact.email',
                'contact.phone',
                'contact.title',
                'contact.content',
                'contact.status'
            )
            ->leftJoin('user', 'contact.user_id', '=', 'user.id')
            ->orderBy('contact.created_at', 'desc')
            ->paginate(5);

        return view('backend.contact.trash', compact('list'));
    }

    // Khôi phục liên hệ đã xoá mềm
    public function restore(string $id)
    {
        $contact = Contact::withTrashed()->find($id);

        if ($contact == null) {
            return redirect()->route('contact.index')->with('error', 'Liên hệ không tồn tại!');
        }

        $contact->restore();

        return redirect()->route('contact.trash')->with('success', 'Khôi phục liên hệ thành công.');
    }

    // Xoá vĩnh viễn liên hệ khỏi database
    public function destroy($id)
    {
        $contact = contact::find($id);

        if (!$contact) {
            return redirect()->route('contact.index')->with('error', 'liên hệ không tồn tại.');
        }

        $contact->delete(); // Soft delete

        return redirect()->route('contact.index')->with('success', 'Liên hệ đã được chuyển vào thùng rác.');
    }
}
