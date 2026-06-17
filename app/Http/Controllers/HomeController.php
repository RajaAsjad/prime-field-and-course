<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HomeSlider;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\ContactUs;
use App\Models\ShopContact;
use App\Models\PhotoGallery;
use App\Models\Video;
use App\Models\Audio;
use App\Models\Service;
use App\Models\PortfolioItem;
use App\Models\ProcessStep;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->hasRole('Admin')) {
            $page_title = 'Dashboard';

            $slidersTotal = HomeSlider::count(); 

            $bannersTotal = Banner::count(); 

            $testimonialsTotal = Testimonial::count(); 

            $contactUsTotal = ContactUs::count(); 

            $shopContactTotal = ShopContact::count(); 

            $galleryTotal = PhotoGallery::count(); 

            $videoTotal = Video::count(); 

            $audioTotal = Audio::count();

            $servicesTotal = Service::count();
            $portfolioTotal = PortfolioItem::count();
            $processTotal = ProcessStep::count();
            $activeTestimonialsTotal = Testimonial::where('status', 1)->count();

            return view('admin.dashboard.dashboard', compact(
                'page_title',
                'slidersTotal', 
                'bannersTotal', 
                'testimonialsTotal',
                'activeTestimonialsTotal',
                'contactUsTotal', 
                'shopContactTotal', 
                'galleryTotal', 
                'videoTotal', 
                'audioTotal',
                'servicesTotal',
                'portfolioTotal',
                'processTotal',
            ));
        }

        return redirect()->route('admin.login');
    }
}


