<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.pages.contact.index');
    }

    public function submit(Request $request)
    {
        // Custom manual anti-spam filters
        $request->merge([
            'ip' => $request->ip()
        ]);

        $request->validate([
            // -------------------
            // NORMAL VALIDATION
            // -------------------
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s\-\.\']+$/'
            ],

            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'regex:/^[^\s]+@[^\s]+\.[^\s]+$/'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
                'regex:/^[0-9\+\-\s\(\)]+$/'
            ],

            'subject' => [
                'required',
                'string',
                'max:255',
                'not_regex:/http|www|link|url|buy|promo|discount/i'
            ],

            'message' => [
                'required',
                'string',
                'min:20',
                'max:2000',
                'not_regex:/http|www|\.com|\.net|\.org|<a|href=/i', // block links
                'not_regex:/buy now|free money|click here|crypto|investment/i',
            ],

            // -------------------
            // BOT PROTECTION
            // -------------------

            // Honeypot (hidden field)
            'website' => ['prohibited'],  

        ], [
            'name.regex' => 'The name contains invalid characters.',
            'subject.not_regex' => 'Suspicious content detected in subject.',
            'message.not_regex' => 'Messages containing links or spam keywords are not allowed.',
            'website.prohibited' => 'Spam detected.',
        ]);

        // -------------------
        // RATE LIMITING PER IP
        // -------------------

        $ip = $request->ip();
        $cacheKey = 'contact_form_' . $ip;

        if (cache()->has($cacheKey)) {
            return back()
                ->withErrors(['error' => 'You are submitting too fast. Please wait 60 seconds before trying again.'])
                ->withInput();
        }

        cache()->put($cacheKey, true, now()->addSeconds(60)); // 1 minute delay

        // -------------------
        // SAVE
        // -------------------

        ContactMessage::create($request->except('website'));

        return back()->with('success', 'Your message has been sent successfully.');
    }

}
