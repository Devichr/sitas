<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skripsi;
use App\Models\Prodi;

class ProdiController extends Controller
{
    public function show()
    {
        $mahasiswaCount = User::where('role', 'mahasiswa')->count();
        $dosenCount = User::where('role', 'dosen')->count();
        $skripsiCount = Skripsi::count();
        $prodiCount = Prodi::count();

        return view('admin.index', compact('mahasiswaCount', 'dosenCount', 'skripsiCount', 'prodiCount'));
    }

    public function create()
    {
        $kaprodis = User::where('role', 'admin')->pluck('name', 'id');
        return view('admin.prodi.create', compact('kaprodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kaprodi_id' => 'required|exists:users,id'
        ]);

        Prodi::create($request->all());

        return redirect()->route('admin.index')->with('success', 'Prodi created successfully.');
    }

    public function edit(Prodi $prodi)
    {
        $kaprodis = User::where('role', 'admin')->pluck('name', 'id');
        return view('admin.prodi.edit', compact('prodi', 'kaprodis'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kaprodi_id' => 'required|exists:users,id'
        ]);

        $prodi->update($request->all());

        return redirect()->route('admin.index')->with('success', 'Prodi updated successfully.');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect()->route('admin.index')->with('success', 'Prodi deleted successfully.');
    }

}
