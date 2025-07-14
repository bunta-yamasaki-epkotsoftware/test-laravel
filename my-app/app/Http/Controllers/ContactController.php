<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    /**
     * お問い合わせフォームの表示
     */
    public function index()
    {
        return view('contact.index');
    }
    /**
     * 確認画面の表示
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        //確認画面の表示
        $contactData = $request->all();
        return view('contact.confirm', compact('contactData'));
        /* return view('contact.confirm', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]); */
    }
    /**
     * お問い合わせ内容の送信処理
     */
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $contactData = $request->only('name', 'email', 'message');

        //メールの送信（運営者）
        Mail::to(config('mail.from.address'))->send(new ContactMail($contactData, 'admin'));

        //メールの送信（ユーザー）
        Mail::to($request->email)->send(new ContactMail($contactData, 'user'));

        return redirect()->route('contact.complete');
    }
    /**
     * お問い合わせ完了画面の表示
     */
    public function complete()
    {
        return view('contact.complete');
    }
}
