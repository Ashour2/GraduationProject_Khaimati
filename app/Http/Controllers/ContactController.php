<?php

namespace App\Http\Controllers;

use App\Models\Communication;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private function communications(): array
    {
        return Communication::pluck('value', 'name')->toArray();
    }

    public function home()
    {
        return view('public.home', ['communications' => $this->communications()]);
    }

    public function index()
    {
        return view('public.contact', ['communications' => $this->communications()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:1000',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'subject.required' => 'العنوان مطلوب',
            'message.required' => 'الرسالة مطلوبة',
        ]);

        Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'new',
            'created_at' => now(),
        ]);

        return back()->with('success', 'تم إرسال رسالتك بنجاح');
    }
}