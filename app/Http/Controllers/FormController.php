<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;
use App\Models\User;

class FormController extends Controller
{
    public function index()
    {
        $user = Auth::user();
                    /** @var \App\Models\User $user **/
        $forms = $user->forms()->get();

        $formStatus = [
            'form_prasidang' => $forms->where('form_name', 'form_prasidang')->first(),
            'form_nilai_prasidang' => $forms->where('form_name', 'form_nilai_prasidang')->first(),
            'form_sidang' => $forms->where('form_name', 'form_sidang')->first(),
            'form_nilai_sidang' => $forms->where('form_name', 'form_nilai_sidang')->first()
        ];

        return view('forms.index', compact('formStatus'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'form_name' => 'required|string',
            'form_file' => 'required|mimes:pdf|max:2048'
        ]);

        $userId = Auth::id();
        $fileName = $request->form_name . "_$userId.pdf";
        $filePath = $request->file('form_file')->storeAs('public/forms', $fileName);

        Form::updateOrCreate(
            ['user_id' => $userId, 'form_name' => $request->form_name],
            ['file_path' => $filePath]
        );

        return redirect()->route('dokumen')->with('success', 'Form uploaded successfully.');
    }
    public function fetchDocuments()
    {
        $students = User::where('role','mahasiswa')->get();
        $students = $students->map(function ($student) {
            $forms = Form::where('user_id', $student->id)->get()->keyBy('form_name');
            $student->formStatus = [
                'form_prasidang' => $forms->has('form_prasidang'),
                'form_nilai_prasidang' => $forms->has('form_nilai_prasidang'),
                'form_sidang' => $forms->has('form_sidang'),
                'form_nilai_sidang' => $forms->has('form_nilai_sidang')
            ];
            return $student;
        });

        return view('forms.view', compact('students'));
    }
    public function fetchDocumentsDosen()
    {
        $students = User::where('role','mahasiswa')->where('dosen_pembimbing' , Auth::user()->id)->get();
        $students = $students->map(function ($student) {
            $forms = Form::where('user_id', $student->id)->get()->keyBy('form_name');
            $student->formStatus = [
                'form_prasidang' => $forms->has('form_prasidang'),
                'form_nilai_prasidang' => $forms->has('form_nilai_prasidang'),
                'form_sidang' => $forms->has('form_sidang'),
                'form_nilai_sidang' => $forms->has('form_nilai_sidang')
            ];
            return $student;
        });

        return view('forms.viewDosen', compact('students'));
    }
    public function showDocuments(User $student)
    {
        $forms = Form::where('user_id', $student->id)->get();
        $formStatus = [
            'form_prasidang' => $forms->where('form_name', 'form_prasidang')->first(),
            'form_nilai_prasidang' => $forms->where('form_name', 'form_nilai_prasidang')->first(),
            'form_sidang' => $forms->where('form_name', 'form_sidang')->first(),
            'form_nilai_sidang' => $forms->where('form_name', 'form_nilai_sidang')->first()
        ];

        return view('forms.documents', compact('student', 'formStatus'));
    }
}
