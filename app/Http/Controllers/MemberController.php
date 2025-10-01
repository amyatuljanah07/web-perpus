<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $students = Member::all();
        return view('admin.members.index', compact('students'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        
        $member->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'class' => $request->class,
            'major' => $request->major,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.members.index')
            ->with('success', 'Data siswa berhasil diupdate');
    }


    // ...existing methods...
}