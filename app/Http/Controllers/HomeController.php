<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Actualite;
use App\Models\Polls;
use App\Models\Post;
use App\Models\Member;

class HomeController extends Controller
{
    //

    public function about(){
        return view('layouts.about', [
            'boardMembers' =>Member::orderByRaw("FIELD(role, 'Président', 'Vice-Président', 'Secrétaire', 'Trésorier', 'Membre')")
            ->orderBy('fullname')
            ->get(),
        ]);
    }
   public function index()
    {
        $featuredNews = Actualite::where('status', 'published')
        ->latest()
        ->take(6)
        ->get();

        $latestNews = Actualite::where('status', 'published')
        ->latest()
        ->take(6)
        ->get();

        $latestNews = Actualite::where('status', 'published')
        ->latest() 
        ->take(6)
        ->get();

        $upcomingEvents= Event::latest()

       
        ->paginate(8);


        $activePolls=Polls::where('is_public', true)
        ->where('status', 'active')
        ->paginate(10);

        $nextEvent=Event::where('date_heure','<',now())
        ->latest()
        ->take(1)
        ->get();

        $blogPosts = Post::published()
        ->latest()
        ->take(6)
        ->get();

        return view('layouts.home',compact('featuredNews','latestNews','upcomingEvents','activePolls','nextEvent', 'blogPosts'));
    }
}
