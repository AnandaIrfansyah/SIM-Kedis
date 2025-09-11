<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asn;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataAsnController extends Controller
{
    public function index(Request $request)
    {
        $query = Asn::with('user')->where('status', 'aktif');

        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        $asn = $query->get();

        return view('pages.admin.asn.index', compact('asn'));
    }

    public function inactive(Request $request)
    {
        $query = Asn::with('user')->where('status', '!=', 'aktif');

        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        $asn = $query->get();

        return view('pages.admin.asn.inactive', compact('asn'));
    }

    public function create()
    {
        return view('pages.admin.asn.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:asns,nip',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'jabatan' => 'nullable|string',
            'unit_kerja' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('pegawai');

        Asn::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'unit_kerja' => $request->unit_kerja,
            'no_hp' => $request->no_hp,
            'status' => 'aktif',
        ]);

        return redirect()->route('asn.index')->with('success', 'Pegawai berhasil ditambahkan. Password default: password');
    }


    public function edit($id)
    {
        $asn = Asn::with('user')->findOrFail($id);
        return view('pages.admin.asn.edit', compact('asn'));
    }

    public function update(Request $request, $id)
    {
        $asn = Asn::findOrFail($id);
        $user = $asn->user;

        $request->validate([
            'nip' => 'required|unique:asns,nip,' . $asn->id,
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'jabatan' => 'nullable|string',
            'unit_kerja' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);

        $emailChanged = $request->email !== $user->email;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $emailChanged ? Hash::make('password') : $user->password,
        ]);

        $asn->update([
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'unit_kerja' => $request->unit_kerja,
            'no_hp' => $request->no_hp,
            'status' => $request->status ?? 'aktif',
        ]);

        return redirect()->route('asn.index')->with(
            'success',
            $emailChanged
                ? 'Pegawai berhasil diupdate. Password direset ke: password'
                : 'Pegawai berhasil diupdate.'
        );
    }


    public function destroy($id)
    {
        $asn = Asn::findOrFail($id);
        $asn->user()->delete();
        $asn->delete();

        return redirect()->route('asn.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
