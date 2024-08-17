<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Skripsi;
use App\Models\Prodi;
use App\Models\Notification;
use App\Models\proposal;

class AdminController extends Controller
{

    public function index()
    {


        $mahasiswaCount = User::where('role', 'mahasiswa')->count();
        $dosenCount = User::where('role', 'dosen')->count();
        $skripsiCount = Skripsi::count();
        $accCount = Skripsi::where('status', 'acc')->count();
        $rejectCount = Skripsi::where('status', 'ditolak')->count();
        $requestCount = Skripsi::where('status', 'pengajuan')->count();
        $prodiCount = Prodi::count();
        $dataPengajuan = DB::table('skripsi')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->get();

        $dataAcc = DB::table('skripsi')
            ->where('status', 'acc')
            ->select(DB::raw('DATE(updated_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->get();

        $dataDitolak = DB::table('skripsi')
            ->where('status', 'ditolak')
            ->select(DB::raw('DATE(updated_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->get();

        $data = [
            'pengajuan' => $requestCount,
            'acc' => $accCount,
            'ditolak' => $rejectCount,
            'total' => $skripsiCount,
        ];
        $persentase = [
            'pengajuan' => 0,
            'acc' => 0,
            'ditolak' => 0,
        ];

        if ($skripsiCount > 0) {
            $persentase = [
                'pengajuan' => ($requestCount / $skripsiCount) * 100,
                'acc' => ($accCount / $skripsiCount) * 100,
                'ditolak' => ($rejectCount / $skripsiCount) * 100,
            ];
        }
        $user = auth()->user();
        $notifications = Notification::orderBy('created_at', 'desc')->get();
        $unreadNotifications = $notifications->where('is_read', false)->count();

        return view('admin.index', compact(
        'mahasiswaCount',
        'dosenCount',
        'skripsiCount',
        'prodiCount',
        'data',
        'persentase',
        'dataPengajuan',
        'dataDitolak',
        'dataAcc',
        'notifications',
        'unreadNotifications'));
    }

    public function markAllAsRead()
    {

        Notification::where('is_read', false)->update(['is_read' => true]);

        Notification::where('is_read', true)->delete();

        return redirect()->back();
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,admin,dosen,mahasiswa',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|in:admin,admin,dosen,mahasiswa',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function users(Request $request)
    {
        $role = $request->query('role');
        if ($role) {
            $users = User::where('role', $role)->get();
        } else {
            $users = User::all();
        }
        return view('admin.users', compact('users'));
    }

    public function pengajuanSkripsi()
    {
        $pengajuanSkripsi = Skripsi::where('status', 'pengajuan')->get();
        return view('admin.pengajuanSkripsi', compact('pengajuanSkripsi'));
    }

    public function semuaSkripsi()
    {
        $semuaSkripsi = Skripsi::all();
        return view('admin.semuaSkripsi', compact('semuaSkripsi'));
    }

    public function prodi()
    {
        $prodi = Prodi::all();
        return view('admin.prodi', compact('prodi'));
    }

    public function monitoringSkripsi()
    {
        $skripsi = Skripsi::all();
        return view('admin.monitoringSkripsi', compact('skripsi'));
    }
    public function proposal()
    {
        $proposal = proposal::all();
        return view('admin.proposal', compact('proposal'));
    }
    public function approveProposal($id)
    {
        $proposal = proposal::findOrFail($id);
        $proposal->status = 'Disetujui';
        $proposal->save();

        return redirect()->route('admin.index')->with('success', 'Proposal disetujui.');
    }

    public function rejectProposal($id)
    {
        $proposal = proposal::findOrFail($id);
        $proposal->status = 'Revisi';
        $proposal->save();

        return redirect()->route('admin.index')->with('error', 'Proposal ditolak.');
    }

    public function dosen()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        return view('admin.dosen', compact('mahasiswa'));
    }

    public function editPembimbing($id)
    {
        $mahasiswa = User::findOrFail($id);
        $dosens = User::where('role', 'dosen')->get();

        return view('admin.editdosen', compact('mahasiswa', 'dosens'));
    }

    // Update dosen pembimbing mahasiswa
    public function updatePembimbing(Request $request, $id)
    {
        $mahasiswa = User::findOrFail($id);

        $request->validate([
            'dosen_pembimbing' => 'nullable|exists:users,id',
        ]);

        $mahasiswa->dosen_pembimbing = $request->dosen_pembimbing;
        $mahasiswa->update();

        return redirect()->route('admin.index')->with('success', 'Dosen pembimbing berhasil diperbarui.');
    }

    public function skripsi()
    {
        $skripsi = Skripsi::where('status', 'pengajuan')->get();
        return view('admin.skripsi.index', compact('skripsi'));
    }

    public function approve($id)
    {
        $skripsi = Skripsi::findOrFail($id);
        $skripsi->status = 'acc';
        $skripsi->save();

        return redirect()->route('admin.index')->with('success', 'Skripsi disetujui.');
    }

    public function reject($id)
    {
        $skripsi = Skripsi::findOrFail($id);
        $skripsi->status = 'ditolak';
        $skripsi->save();

        return redirect()->route('admin.index')->with('error', 'Skripsi ditolak.');
    }

    public function download($id)
    {
        $skripsi = Skripsi::findOrFail($id);
        $filePath = storage_path('app/' . $skripsi->file);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
