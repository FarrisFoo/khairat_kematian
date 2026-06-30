<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notifikasi::paginate(10);
        return view('notifikasi.index', compact('notifications'));
    }

    public function create()
    {
        return view('notifikasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subjek' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
        ]);

        Notifikasi::create([
            'subjek' => $request->subjek,
            'penerima' => $request->penerima,
            'status' => 'dihantar'
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notifikasi berjaya dihantar.');
    }

    public function show(Notifikasi $notification)
    {
        return view('notifikasi.view', compact('notification'));
    }
}
