<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'unique:newsletters,email'
            ],
            'bot_field' => ['prohibited'], // honeypot
        ]);

        Newsletter::create([
            'email' => $request->email,
            'ip'    => $request->ip(),
        ]);

        return back()->with('success', 'Subscription successful!');
    }
}
