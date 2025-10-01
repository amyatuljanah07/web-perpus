<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $students = Member::orderBy('created_at', 'desc')->get();
        return view('admin.members.index', compact('students'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:members',
            'name' => 'required',
            'class' => 'required',
            'major' => 'required',
            'email' => 'required|email|unique:members'
        ]);

        Member::create($validated);

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);
        
        $validated = $request->validate([
            'nis' => 'required|unique:members,nis,'.$id,
            'name' => 'required',
            'class' => 'required',
            'major' => 'required',
            'email' => 'required|email|unique:members,email,'.$id
        ]);

        $member->update($validated);

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Siswa berhasil diperbarui');
    }
    public function destroy($id)
{
    $member = Member::findOrFail($id);
    $member->delete();

    return redirect()->route('admin.members.index')->with('success', 'Data siswa berhasil dihapus');
}

}
