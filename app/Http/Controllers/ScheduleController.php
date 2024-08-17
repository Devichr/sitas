<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'mahasiswa')->get();
        $schedules = Schedule::whereIn('user_id',$students->pluck('id'))->get();
        return view('dosen.schedules', compact('students','schedules'));
    }

    public function all()
    {
        $students = User::where('role', 'mahasiswa')->where('dosen_pembimbing', auth()->user()->id)->get();
        $schedules = Schedule::whereIn('user_id',$students->pluck('id'))->get();
        return view('admin.schedules', compact('students','schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'schedule_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        Schedule::create($request->all());

        return redirect()->route('dosen.schedules.index')->with('success', 'Schedule created successfully.');
    }
}
