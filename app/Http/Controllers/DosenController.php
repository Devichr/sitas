<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skripsi;
use App\Models\proposal;
use App\Models\Prodi;

class DosenController extends Controller
{

    public function index()
{
    $mahasiswa = User::where('dosen_pembimbing', auth()->user()->id)->get();
    $mahasiswaCount = User::where('role', 'mahasiswa')->where('dosen_pembimbing', auth()->user()->id)->count();
    $skripsiCount = Skripsi::whereIn('mahasiswa_id', $mahasiswa->pluck('id'))->count();
    $accCount = Skripsi::where('status', 'acc')->whereIn('mahasiswa_id', $mahasiswa->pluck('id'))->count();

    return view('dosen.index', compact('mahasiswa','mahasiswaCount','skripsiCount','accCount'));
}
    public function bimbingan()
{
    $mahasiswa = User::where('dosen_pembimbing', auth()->user()->id)->get();
    return view('dosen.bimbingan', compact('mahasiswa'));
}
    public function monitor()
{
    $mahasiswa = User::where('dosen_pembimbing', auth()->user()->id)->get();
    $skripsi = Skripsi::whereIn('mahasiswa_id', $mahasiswa->pluck('id'))->get();
    return view('dosen.monitor', compact('skripsi'));
}
    public function proposal()
{
    $mahasiswa = User::where('dosen_pembimbing', auth()->user()->id)->get();
    $proposal = proposal::whereIn('mahasiswa_id', $mahasiswa->pluck('id'))->get();
    return view('dosen.proposal', compact('proposal'));
}
}
