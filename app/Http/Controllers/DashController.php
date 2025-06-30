<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Actualite;
use Carbon\Carbon;


class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $recentUsers=User::latest() ->paginate(8);
        $pendingCount = Actualite::where('status', 'draft')->count();
        $upcomingEvents = Event::where('date_heure', '>', now())->count();
        $newRegistrationsWeek = User::where('created_at', '>=', Carbon::now()->subWeek())
    ->count();
        $totalUsers = User::where('role', 'user')->count();
        return view('admin.home',compact('recentUsers','pendingCount', 'upcomingEvents', 'newRegistrationsWeek', 'totalUsers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
