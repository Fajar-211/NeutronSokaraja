<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserprofilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function edit(User $user)
    {
        return view('user.profil', ['header' => 'Profile edit', 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:25|string',
            'email' => 'required|string|email:dns|max:255|unique:users,email,'.$user->id,
            'avatar' => 'image|max:2000'
        ],[
            'required' => ':attribute wajib diisi',
            'string' => ':attribute harus huruf',
            'email' => 'Email tidak valid',
            'unique' => 'email sudah terdaftar',
            'avatar.max' => 'Ukuran gambar maksimal 2mb',
            'name.max' => 'maksimal 25 kata',
            'image' => 'hanya jpg/jpeg/png'
        ])->validate();
        if($request->hasFile('avatar')){
            if(!empty(Auth::user()->avatar)){
                Storage::disk('public')->delete(Auth::user()->avatar);
            }
            $path = ($request->file('avatar')->store('img', 'public'));
            $user->update(['avatar' => $path]);
        }
        if($request->password == null){
            $pwd = Hash::make('password');
        }else{
            $pwd = Hash::make($request->password);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pwd
        ]);
        return redirect('home')->with(['berhasil' => 'Profile berhasil dirubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
