<?php

namespace App\Http\Controllers;

use App\Models\Tuntutan;
use App\Models\Member;
use Illuminate\Http\Request;

class TuntutanController extends Controller
{
    public function index()
    {
        $tuntutans = Tuntutan::paginate(10);
        return view('tuntutan.listing', compact('tuntutans'));
    }

    public function create()
    {
        $members = Member::all();
        return view('tuntutan.create', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ahli' => 'required|string|max:255',
            'nama_tuntutan' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'jumlah_dituntut' => 'required|numeric|min:0',
            'sijil_kematian' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Store the PDF file
        $filePath = $request->file('sijil_kematian')->store('sijil_kematian');

        // Create new Tuntutan record
        Tuntutan::create([
            'nama_ahli' => $request->nama_ahli,
            'nama_tuntutan' => $request->nama_tuntutan,
            'email' => $request->email,
            'phone' => $request->phone,
            'jumlah_dituntut' => $request->jumlah_dituntut,
            'sijil_kematian_path' => $filePath,
            'status' => 'dalam proses',
        ]);

        return redirect()->route('tuntutan.index')->with('success', 'Tuntutan berjaya didaftarkan.');
    }

    public function show(Tuntutan $tuntutan)
    {
        return view('tuntutan.view', compact('tuntutan'));
    }

    public function approve(Request $request, Tuntutan $tuntutan)
{
        $request->validate([
            'jumlah_diluluskan' => 'required|numeric|min:0',
        ]);

        $tuntutan->update([
            'status' => 'diluluskan',
            'jumlah_diluluskan' => $request->jumlah_diluluskan,
        ]);

        return redirect()->back()->with('success', 'Tuntutan telah diluluskan dengan jumlah RM ' . number_format($request->jumlah_diluluskan, 2));
    }

    public function reject(Tuntutan $tuntutan)
    {
        $tuntutan->update(['status' => 'ditolak']);
        return redirect()->back()->with('success', 'Tuntutan telah ditolak.');
    }
}
