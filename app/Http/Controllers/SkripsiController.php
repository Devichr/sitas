<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skripsi;
use App\Models\Schedule;
use App\Models\proposal;
use App\Models\User;
use App\Models\Notification;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class SkripsiController extends Controller
{

public function index()
{
    $dospemId = Auth::user()->dosen_pembimbing;
    $dospem = ModelsUser::where('id', $dospemId )->get();
    $skripsis = Skripsi::where('mahasiswa_id', auth()->id())->get();
    $proposals = proposal::where('mahasiswa_id', auth()->id())->get();
    $skripsiJudul = Skripsi::where('mahasiswa_id', auth()->id())->where('status','acc')->get();
    $schedule = Schedule::where('user_id', auth()->id())->get();
    return view('dashboard', compact('skripsis','skripsiJudul','dospem','schedule','proposals'));
}
public function show()
{
    $dospemId = Auth::user()->dosen_pembimbing;
    $dospem = ModelsUser::where('id', $dospemId )->get();
    $skripsis = Skripsi::where('mahasiswa_id', auth()->id())->get();
    $skripsiJudul = Skripsi::where('mahasiswa_id', auth()->id())->where('status','acc')->get();
    return view('dashboard', compact('skripsis','skripsiJudul','dospem'));
}

public function create()
{
    $proposal = proposal::where('mahasiswa_id', auth()->id())->first();

    if (!$proposal || $proposal->status != 'Disetujui') {
        return redirect()->route('dashboard')->with('error', 'Anda tidak dapat mengisi Skripsi sebelum proposal disetujui oleh Kaprodi.');
    }else{
        return view('skripsi.create');
    }
}
public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:20480',
            'keterangan' =>'required|string|max:255'
        ]);

        $filePath = $request->file('file')->store('public/skripsi');

        $skripsi = Skripsi::create([
            'mahasiswa_id' => auth()->id(),
            'judul' => $request->judul,
            'file' => $filePath,
            'keterangan' => $request->keterangan,
        ]);

        // Kirim notifikasi ke Kaprodi
            Notification::create([
                'user_id' => Auth::user()->id,
                'type' => 'skripsi',
                'reference_id' => $skripsi->id,
                'message' => 'Pengajuan skripsi baru oleh ' . auth()->user()->name,
            ]);

        return redirect()->route('dashboard')->with('success', 'Skripsi berhasil ditambahkan.');
    }

    public function edit(Skripsi $skripsi)
    {

        return view('skripsi.edit', compact('skripsi'));
    }
    public function update(Request $request, Skripsi $skripsi)
    {

        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            Storage::delete($skripsi->file);
            $filePath = $request->file('file')->store('public/skripsi');
            $skripsi->file = $filePath;
        }

        $skripsi->judul = $request->judul;
        $skripsi->save();

        return redirect()->route('dashboard')->with('success', 'Skripsi berhasil diupdate.');
    }

    public function destroy(Skripsi $skripsi)
    {

        Storage::delete($skripsi->file);
        $skripsi->delete();

        return redirect()->route('dashboard')->with('success', 'Skripsi berhasil dihapus.');
    }
}
