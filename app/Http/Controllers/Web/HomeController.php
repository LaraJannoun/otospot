<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use App\Models\FixedSection;
use App\Models\HomeSection;

class HomeController extends Controller
{

    public function index($locale)
    {
        $page_title = 'Home';

        $sliders = HomeSlider::select([
            'id',
            'slug',
            'image',
            'title_' . $locale . ' as title',
            'subtitle_' . $locale . ' as subtitle',
        ])->orderBy('pos', 'asc')->wherePublish(1)->get();

        $intro = FixedSection::select([
            'id',
            'slug',
            'title_' . $locale . ' as title',
            'text_' . $locale . ' as text',
        ])->whereSlug('intro')->first();

        $sections = HomeSection::select([
            'id',
            'slug',
            'title_' . $locale . ' as title',
            'subtitle_' . $locale . ' as subtitle',
            'text_' . $locale . ' as text',
        ])->with('images')->get();

        $about = $sections->filter(function ($value, $key) {
            return strtolower($value['slug']) == 'first';
        })->first();

        $shop = $sections->filter(function ($value, $key) {
            return strtolower($value['slug']) == 'third';
        })->first();

        $dine = $sections->filter(function ($value, $key) {
            return strtolower($value['slug']) == 'second';
        })->first();

        $play = $sections->filter(function ($value, $key) {
            return strtolower($value['slug']) == 'forth';
        })->first();

        $unwind = $sections->filter(function ($value, $key) {
            return strtolower($value['slug']) == 'fifth';
        })->first();

        return view('web.pages.home', compact(
            'page_title',
            'sliders',
            'intro',
            'about',
            'shop',
            'dine',
            'play',
            'unwind',
        ));
    }

    public function privacy($locale)
    {
        $page_title = 'Home';

        $section = FixedSection::select([
            'id',
            'slug',
            'title_' . $locale . ' as title',
            'text_' . $locale . ' as text',
        ])->whereSlug('privacy-policy')->first();


        return view('web.pages.privacy', compact(
            'page_title',
            'section'
        ));
    }

    public function terms($locale)
    {
        $page_title = 'Home';

        $section = FixedSection::select([
            'id',
            'slug',
            'title_' . $locale . ' as title',
            'text_' . $locale . ' as text',
        ])->whereSlug('terms-and-conditions')->first();


        return view('web.pages.terms', compact(
            'page_title',
            'section'
        ));
    }
}
