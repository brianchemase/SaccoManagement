<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = DB::table('members')->get();

        $data = [
            'members' => $members,
            'pagetitle' => 'Members List',
        ];

        return view('dashboard.members.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_no' => 'required|unique:members',
            'id_number' => 'required|unique:members',
            'full_name' => 'required',
            'phone' => 'required',
            'date_joined' => 'required|date',
        ]);

        DB::table('members')->insert([
            'member_no' => $request->member_no,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'id_number' => $request->id_number,
            'date_joined' => $request->date_joined,
            'status' => $request->status ?? 'active',
            'created_at' => now(),
        ]);

        return back()->with('success', 'Member registered successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $member = DB::table('members')->where('id', $id)->first();
        if (!$member) {
            return redirect()->route('members.index')->with('error', 'Member not found.');
        }

        $data = [
            'member' => $member,
            'pagetitle' => 'Edit Member',
        ];

        return view('dashboard.members.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'member_no' => 'required|unique:members,member_no,' . $id,
            'full_name' => 'required',
            'phone' => 'required',
            'date_joined' => 'required|date',
        ]);

        DB::table('members')->where('id', $id)->update([
           // 'member_no' => $request->member_no,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'id_number' => $request->id_number,
            //'date_joined' => $request->date_joined,
            'status' => $request->status ?? 'active',
            //'updated_at' => now(),
        ]);
        return back()->with('success', 'Member updated successfully.');
        //return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
