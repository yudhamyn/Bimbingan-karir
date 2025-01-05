<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokters = Dokter::all();
        $polis = Poli::all();
        return view('admin.dokter', compact('dokters', 'polis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(

            [
                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'id_poli' => 'required',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'no_hp.required' => 'No HP tidak boleh kosong',
                'id_poli.required' => 'Poli tidak boleh kosong',
            ]
        );

        $poli = Poli::find($request->id_poli);
        $dokter = Dokter::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $poli->id,
        ]);
        $dokter->poli()->associate($poli);
        $dokter->save();
        $user = User::create([
            'nama_pengguna' => $request->nama,
            'username' => $request->nama,
            'password' => bcrypt($request->alamat),
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => 'dokter',
            'id_dokter' => $dokter->id,
        ]);
        return redirect()->route('dokter')->with('success', 'Data Dokter Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(

            [
                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'id_poli' => 'required',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'no_hp.required' => 'No HP tidak boleh kosong',
                'id_poli.required' => 'Poli tidak boleh kosong',
            ]
        );

        $poli = Poli::find($request->id_poli);
        $dokter = Dokter::find($id);
        $dokter->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'id_poli' => $poli->id,
        ]);
        $user = User::where('id_dokter', $id)->first();
        $user->update([
            'nama_pengguna' => $request->nama,
            'username' => $request->nama,
            'password' => bcrypt($request->alamat),
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => 'dokter',
            'id_dokter' => $dokter->id,
        ]);

        return redirect()->route('dokter')->with('success', 'Data Dokter Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dokter::destroy($id);
        $user = User::where('id_dokter', $id)->delete();
        return redirect()->route('dokter')->with('success', 'Data Dokter Berhasil Dihapus');
    }
}
