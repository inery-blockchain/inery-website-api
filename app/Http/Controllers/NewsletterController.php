<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $email = $request->email;
        $request->validate([
            'email' => 'required|unique:newsletters|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
        ]);

        if (Newsletter::create(['email' => $email])) {

            return response()->json(['success' => true, 'msg' => 'You subscribed for our newsletters', 'data' => []], 201);
        } else {

            return response()->json(['success' => false, 'msg' => 'Something went wrong', 'data' => []]);
        }
    }

    public function sendNewsletters(Request $request)
    {
        $subscribers = Newsletter::all('email');

        // send mail to subscribers or cron job
    }
}
