<?php
namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Hiển thị form liên hệ (GET)
    public function index()
    {
        return view('frontend.contact');
    }

   public function store(Request $request)
    {
        // Xác thực dữ liệu form
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1000',

        ]);

        // Lưu thông tin vào cơ sở dữ liệu
        $contact = Contact::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'created_by' => auth()->id() ?? 0,
            'status' => 1,
        ]);

        // Nếu lưu thành công, trả về thông báo thành công
        return redirect()->route('site.contact')
            ->with('success', 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ trả lời bạn trong thời gian sớm nhất.');
    }
}
