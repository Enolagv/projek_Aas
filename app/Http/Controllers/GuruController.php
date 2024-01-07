<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = Guru::all();
        return view('user.guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        return view('user.guru.create', compact('gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
        ]);

        $emailPrefix = substr($request->email, 0, 3);
        $namePrefix = substr($request->name, 0, 3);

        $password = $emailPrefix . $namePrefix;

        Guru::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

        return redirect()->route('guru.data')->with('success', 'Berhasil menambahkan data guru!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guru = Guru::find($id);
        return view('user.guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3', 
            'password' => 'required',
        ]);

        $guruData = [
            'name' => $request->name,
            'email' => $request->email,
          
        ];

        if ($request->filled('password')) {
            $guruData['password'] = bcrypt($request->password);
        }

        Guru::where('id', $id)->update($guruData);

        return redirect()->route('guru.data')->with('success', 'Berhasil mengubah data guru!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Guru::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
