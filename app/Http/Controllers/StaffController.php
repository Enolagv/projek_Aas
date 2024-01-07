<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $staffs = Staff::all();
       return view('user.staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staffs = Staff::all();
        return view('user.staff.create', compact('staffs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
            'role' => 'required',
        ]);

        $emailPrefix = substr($request->email, 0, 3);
        $namePrefix = substr($request->name, 0, 3);
        $password = $emailPrefix . $namePrefix;
        

        Staff::create([
            'name' => $request->name, 
            'email' => $request->email,
            'role' => $request->role,
            'password' => $password,
        ]);
        
        
        return redirect()->route('staff.data')->with('success', 'Berhasil menambahkan data Staff!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $staff = Staff::find($id);
        return view('user.staff.edit', compact('staff'));
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

        $staffData = [
            'name' => $request->name,
            'email' => $request->email,
          
        ];

        if ($request->filled('password')) {
            $staffData['password'] = bcrypt($request->password);
        }

        Staff::where('id', $id)->update($staffData);

        return redirect()->route('staff.data')->with('success', 'Berhasil mengubah data staff!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Staff::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
