<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Actualite;
use App\Models\Polls;

class HomeController extends Controller
{
    //
   public function index()
    {
        $featuredNews = Actualite::where('status', 'published')
        ->latest()
        ->take(3)
        ->get();

        $latestNews = Actualite::where('status', 'published')
        ->latest()
        ->take(6)
        ->get();

        $latestNews = Actualite::where('status', 'published')
        ->latest() 
        ->take(6)
        ->get();

        $upcomingEvents= Event::where('date_heure', '>', now())
        ->latest()
        ->take(3)
        ->get();

        $activePolls=Polls::where('is_public', true)
        ->where('status', 'active')
        ->paginate(10);

        $nextEvent=Event::where('date_heure','>',now())
        ->latest()
        ->take(1)
        ->get();


        return view('layouts.home',compact('featuredNews','latestNews','upcomingEvents','activePolls','nextEvent'));
    }
}
