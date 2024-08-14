<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\proposal;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ProposalController extends Controller
{

public function create()
{
    return view('proposal.create');
}
public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:20480',
        ]);

        $filePath = $request->file('file')->store('public/proposals');

        proposal::create([
            'mahasiswa_id' => auth()->id(),
            'judul' => $request->judul,
            'file' => $filePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'proposal berhasil ditambahkan.');
    }

    public function edit(proposal $proposal)
    {

        return view('proposal.edit', compact('proposal'));
    }
    public function update(Request $request, proposal $proposal)
    {

        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            Storage::delete($proposal->file);
            $filePath = $request->file('file')->store('public/proposals');
            $proposal->file = $filePath;
        }

        $proposal->judul = $request->judul;
        $proposal->save();

        return redirect()->route('dashboard')->with('success', 'proposal berhasil diupdate.');
    }

    public function destroy(proposal $proposal)
    {

        Storage::delete($proposal->file);
        $proposal->delete();

        return redirect()->route('dashboard')->with('success', 'proposal berhasil dihapus.');
    }
}
