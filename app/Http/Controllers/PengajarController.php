<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajar = User::where('is_admin', '=', 0);
        if(!empty(request('key'))){
            $pengajar->where('name', 'like', '%' . request('key') . '%');
        }
        return view('dashboard', ['pengajars' => $pengajar->paginate(8)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboardCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Validator::make($request->all(), [
            'name' => 'required|max:25|string',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'mapel' => 'required|array|min:1',
            // 'mapel.*'   => 'exists:mapels,id',
        ],[
            'required' => ':attribute wajib diisi',
            'string' => ':attribute harus huruf',
            'email' => 'Email tidak valid',
            'unique' => 'email sudah terdaftar',
            'mapel.required' => 'Minimal pilih 1 mata pelajaran.',
            'mapel.min'      => 'Minimal pilih 1 mata pelajaran.',
        ])->validate();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'slug' => Str::slug($request->name),
            'is_admin' => 0,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $user->mengajar()->attach($request->mapel);
        return redirect('dashboard')->with(['berhasil' => 'Pengajar baru berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboarUpdate', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:25|string',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'mapel' => 'required|array|min:1',
        ],[
            'required' => ':attribute wajib diisi',
            'string' => ':attribute harus huruf',
            'email' => 'Email tidak valid',
            'unique' => 'email sudah terdaftar',
            'mapel.required' => 'Minimal pilih 1 mata pelajaran.',
            'mapel.min'      => 'Minimal pilih 1 mata pelajaran.',
        ])->validate();

        // Update data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'slug' => Str::slug($request->name)
        ]);

        // Update pivot mapel → pakai sync biar overwrite data lama
        $user->mengajar()->sync($request->mapel);

        return redirect('dashboard')->with(['berhasil' => 'Data pengajar berhasil diperbarui']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->absensi()->exists() == true || $user->nilai()->exists() == true){
            return redirect('dashboard')->with(['berhasil' => 'Sistem secara otomatis menjaga integritas data pengajar, mapel, absensi dan nilai. Saat ini anda tidak dizinkan oleh sistem untuk menghapus ' . $user->name . ' dari daftar team']);
        }
        $user->mengajar()->detach();
        $user->delete();
        return redirect('dashboard')->with(['berhasil' => $user->name . ' berhasil dihapus dari daftar pengajar']);
    }
}
