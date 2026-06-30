<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_name' => 'required|string|max:255',
            'ic_number' => 'nullable|string|max:20',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'waris_name' => 'required|string|max:255',
            'waris_ic' => 'nullable|string|max:20',
            // Other fields can be stored as JSON in an additional column if needed
        ]);

        // Create the main member record
        $member = Member::create([
            'member_name' => $validated['member_name'],
            'waris_name' => $validated['waris_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'additional_info' => json_encode([
                'ic_number' => $validated['ic_number'] ?? null,
                'waris_ic' => $validated['waris_ic'] ?? null,
                'children' => array_map(null, $request->children_name ?? [], $request->children_ic ?? []),
                'mother_name' => $request->mother_name,
                'mother_ic' => $request->mother_ic,
                'father_name' => $request->father_name,
                'father_ic' => $request->father_ic,
                'mother_in_law_name' => $request->mother_in_law_name,
                'mother_in_law_ic' => $request->mother_in_law_ic,
                'father_in_law_name' => $request->father_in_law_name,
                'father_in_law_ic' => $request->father_in_law_ic,
            ])
        ]);

        return redirect()->route('members.create')
            ->with('success', 'Pendaftaran ahli berjaya! Status pengesahan akan dihantar kepada pihak atasan.');
    }

    public function index()
    {
        $members = Member::orderBy('created_at', 'desc')->paginate(10);
        return view('members.listing', compact('members'));
    }

    public function show(Member $member)
    {
        return view('members.view', compact('member'));
    }

    public function verify(Member $member)
    {
        $member->update(['verification_status' => 1]);

        return redirect()->route('members.show', $member->id)
            ->with('success', 'Keahlian telah berjaya disahkan!');
    }
}
