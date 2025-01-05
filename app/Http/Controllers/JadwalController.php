<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwals = Jadwal::where("id_dokter", auth()->user()->id_dokter)->get();
        $dokters = Dokter::where("id", auth()->user()->id_dokter)->get();
        return view('dokter.jadwal-periksa', compact('jadwals', 'dokters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'aktif' => 'required',
        ], [
            'id_dokter.required' => 'Dokter tidak boleh kosong',
            'hari.required' => 'Hari tidak boleh kosong',
            'jam_mulai.required' => 'Jam Mulai tidak boleh kosong',
            'jam_selesai.required' => 'Jam Selesai tidak boleh kosong',
            'aktif.required' => 'Status aktif tidak boleh kosong',
        ]);

        // Cek apakah dokter sudah memiliki jadwal di hari yang sama
        $existingSchedule = Jadwal::where('id_dokter', $request->id_dokter)
            ->where('hari', $request->hari)
            ->first();

        if ($existingSchedule) {
            return redirect()->route('jadwalperiksa')->with('error', 'Dokter sudah memiliki jadwal pada hari ini.');
        }

        // Jika jadwal baru diaktifkan, nonaktifkan jadwal aktif lainnya hanya untuk dokter terkait
        if ($request->aktif === 'aktif') {
            Jadwal::where('id_dokter', $request->id_dokter)
                ->where('aktif', 'Y')
                ->update(['aktif' => 'N']);
        }

        $aktifValue = ($request->aktif == 'aktif') ? 'Y' : 'N';

        $dokter = Dokter::find($request->id_dokter);
        $jadwal = Jadwal::create([
            'id_dokter' => $dokter->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'aktif' => $aktifValue,
        ]);

        return redirect()->route('jadwalperiksa')->with('success', 'Jadwal berhasil ditambahkan');
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
        $request->validate([
            'id_dokter' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'aktif' => 'required',
        ], [
            'id_dokter.required' => 'Dokter tidak boleh kosong',
            'hari.required' => 'Hari tidak boleh kosong',
            'jam_mulai.required' => 'Jam Mulai tidak boleh kosong',
            'jam_selesai.required' => 'Jam Selesai tidak boleh kosong',
            'aktif.required' => 'Status aktif tidak boleh kosong',
        ]);

        // Validasi apakah dokter sudah memiliki jadwal di hari yang sama (selain jadwal yang sedang diupdate)
        $existingSchedule = Jadwal::where('id_dokter', $request->id_dokter)
            ->where('hari', $request->hari)
            ->where('id', '!=', $id)
            ->first();

        if ($existingSchedule) {
            return redirect()->route('jadwalperiksa')->with('error', 'Dokter sudah memiliki jadwal pada hari ini.');
        }

        // Jika jadwal yang diupdate diaktifkan, nonaktifkan jadwal aktif lainnya hanya untuk dokter terkait
        if ($request->aktif === 'aktif') {
            Jadwal::where('id_dokter', $request->id_dokter)
                ->where('aktif', 'Y')
                ->where('id', '!=', $id)
                ->update(['aktif' => 'N']);
        }

        $aktifValue = ($request->aktif == 'aktif') ? 'Y' : 'N';

        $dokter = Dokter::find($request->id_dokter);
        $jadwal = Jadwal::find($id);
        $jadwal->update([
            'id_dokter' => $dokter->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'aktif' => $aktifValue,
        ]);

        return redirect()->route('jadwalperiksa')->with('success', 'Jadwal berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jadwal::destroy($id);
        return redirect()->route('jadwalperiksa')->with('success', 'Jadwal berhasil dihapus');
    }
}
