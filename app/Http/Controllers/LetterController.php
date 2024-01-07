<?php

namespace App\Http\Controllers;

use App\Models\letter;
use App\Models\User;
use App\Models\Guru;
use App\Models\result;
use App\Models\letterType;
use Illuminate\Http\Request;
use PDf;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $letters = Letter::with('letterType', 'user');
        return view('letter.index', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        $letter = Letter::all();
        $classificate = letterType::get();
        return view('letter.create', compact('letter', 'gurus', 'classificate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        $request->validate([
            'letter_type_id' => 'required',
            'letter_perihal' => 'required',
            'recipients' => 'required|array',
            'content' => 'required',
            'notulis' => 'required'
        ]);
        
        // Menyimpan data surat ke dalam database
        letter::create([
            'letter_type_id' => $request->letter_type_id,
            'letter_perihal' => $request->letter_perihal,
            'recipients' => json_encode($request->recipients), // Simpan sebagai JSON
            'content' => $request->content,
            'attachment' => $request->attachment,
            'notulis' => $request->notulis
        ]);

        // Mengarahkan pengguna ke halaman data surat dengan pesan sukses
        return redirect()->route('letter.data')->with('success', 'Berhasil Menambahkan Surat Baru!');

    }

    /**
     * Display the specified resource.
     */
    public function show(letter $letter, $id)
    {
        $gurus = Guru::all();
        $letters = Letter::find($id);
        return view('letter.print', compact('letters', 'gurus'));
    }
    public function detail($id)
    {
        $result = Result::where('letter_id', $id)->first();
        $gurus = Guru::get();
        $letters = Letter::find($id);
        return view('letter.detail', compact('letters', 'gurus', 'result'));
    }

    public function downloadPDf($id) {
        $letter = Letter::find($id); 
        if (!$letter) {
            return response()->json(['error' => 'Surat tidak ditemukan'], 404);
        }
        view()->share('letter', $letter); 
        $pdf = PDF::loadView('letter.downloadpdf', compact('letter')); 
        return $pdf->download('letter.pdf'); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Letter $letters, $id)
    {

        $letter = Letter::all();
        $surat = Letter::findOrFail($id);
        $guru = Guru::get(['id', 'name']);

        return view('letter.edit', compact('letter', 'surat', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Letter $letter, $id)
    {
        $recipients = $request->recipients ?? [];

        $arrayDistinct = array_count_values($recipients);
        $arrayAssoc = [];

     foreach ($arrayDistinct as $userId => $count) {
        $user = User::find($id);

        if ( $user) {
            $arrayItem = [
                "id" => $id, 
                "name" => $user->name,
            ];

            array_push($arrayAssoc, $arrayItem);
        }
     }

     $request['recipients'] = $arrayAssoc;

        $letter->where('id', $id)->update([
            'letter_type_id' => $request->letter_type_id,
            'letter_perihal' => $request->letter_perihal,
            'name_type' => $request->name_type,
            'recipients' => $request->recipients,
            'content' => $request->content,
            'attachment' => $request->attachment,
            'notulis' => $request->notulis,
        ]);

        return redirect()->route('letter.data')->with('success', 'Berhasil mengubah data surat');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Letter::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data surat');
    }
}
