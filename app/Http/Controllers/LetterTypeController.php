<?php

namespace App\Http\Controllers;

use App\Exports\LetterTypeExport;
use App\Models\letterType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $letterTypes = LetterType::all();
        return view('letterType.index', compact('letterTypes')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $letterTypes = LetterType::all();
        return view('letterType.create', compact('letterTypes'));   }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'letter_code' => 'required',
            'name_type' => 'required',
        ]);
        
        $baseLetterCode = $request->letter_code;
    $newLetterType = $baseLetterCode;

    // Check if a similar entry already exists
    $countSimilarEntries = letterType::where('letter_code', 'LIKE', $baseLetterCode . '%')->count();

    // If similar entries exist, append a numeric suffix
    if ($countSimilarEntries > 0) {
        $newLetterType = $baseLetterCode . '-' . ($countSimilarEntries + 1);
    }

    LetterType::create([
        'letter_code' => $newLetterType, // Corrected field name
        'name_type' => $request->name_type,
    ]);

        return redirect()->route('letterType.data')->with('success', 'Berhasil menambahkan Klasifikasi Surat');
    }

    /**
     * Display the specified resource.
     */
    public function show(letterType $letterType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $letterType = LetterType::find($id);
        return view('letterType.edit', compact('letterType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'letter_code' => 'required|min:3', 
            'name_type' => 'required|min:3',
        ]);
        
        LetterType::where('id', $id)->update([
            'letter_code' => $request->letter_code,
            'name_type' => $request->name_type,
        ]);
      
       return redirect()->route('letterType.data')->with('success', 'Berhasil Mengubah Data Klasifikasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        LetterType::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil Menghapus Data klasifikasi');
    }

    public function downloadExcel()
    {
        $file_name = 'data_klasifikasi_surat.xlsx';

        return Excel::download(new LetterTypeExport, $file_name);
    }
}

