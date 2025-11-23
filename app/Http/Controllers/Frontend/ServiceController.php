<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SubService;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('subServices')->get();

        return view('frontend.pages.services.index', compact('services'));
    }

    public function show($slug)
    {
        $service = Service::with('subServices')->where('slug', $slug)->firstOrFail();
        $services = Service::with('subServices')->get();

        return view('frontend.pages.services.show', compact('service', 'services'));
    }

    public function subService($serviceSlug, $subSlug)
    {
        $service = Service::where('slug', $serviceSlug)->firstOrFail();

        $subService = SubService::where('slug', $subSlug)
            ->where('service_id', $service->id)
            ->firstOrFail();

        return view('frontend.pages.services.subservice', compact('service', 'subService'));
    }
}
