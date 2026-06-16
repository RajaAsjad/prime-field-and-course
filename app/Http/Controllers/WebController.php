<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\ProcessStep;
use App\Models\Service;
use App\Models\Testimonial;

class WebController extends Controller
{
    public function Index()
    {
        $name = site('name', 'Prime Field and Course Solutions LLC');
        $tagline = site('tagline', 'Golf Course & Athletic Field Construction');
        $page_title = "{$name} — {$tagline}";

        $services = Service::where('status', 1)->orderBy('sort_order')->orderBy('id')->get();
        $processSteps = ProcessStep::where('status', 1)->orderBy('sort_order')->orderBy('id')->get();
        $portfolioItems = PortfolioItem::where('status', 1)->orderBy('sort_order')->orderBy('id')->get();
        $testimonials = Testimonial::where('status', 1)->orderBy('id', 'desc')->get();

        return view('website.index', compact(
            'page_title',
            'services',
            'processSteps',
            'portfolioItems',
            'testimonials'
        ));
    }

    public function About()
    {
        return $this->renderPage('website.about', 'About');
    }

    public function Contact()
    {
        return $this->renderPage('website.contact', 'Contact');
    }

    protected function renderPage(string $view, ?string $suffix = null)
    {
        $name = site('name', 'Website');
        $page_title = $suffix ? "{$suffix} | {$name}" : "{$name} — " . site('tagline', '');

        return view($view, compact('page_title'));
    }
}
