<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class MemberController extends Controller
{

    public function index() {
        $allusers = User::all();
        return view('admin.staff', compact('allusers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|in:admin,editor',
            'avatar' => 'required|image',
            'phone' => 'required|string|max:15',
            
        ]);
      
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'avatar' => $request->file('avatar')->store('avatars', 'public'),
            'phone'=>$request->phone,
            'password' => Hash::make($request->password),
            

        ]);

        return redirect()->back()
            ->with('success', 'Utilisateur créé avec succès!');
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.staff', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'role' => 'required|in:admin,editor',
            'avatar' => 'nullable|image',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;

        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user->save();

        return redirect()->route('staff')->with('success', 'Utilisateur mis à jour avec succès!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('staff')->with('success', 'Utilisateur supprimé avec succès!');
    }
}
