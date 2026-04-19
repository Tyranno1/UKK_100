<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $query = Pengaduan::with(['kategori'])
            ->where('user_id', $userId)
            ->latest();

        // Filter status dari card
        $statusFilter = $request->status ?? 'semua';
        if ($statusFilter !== 'semua') {
            $query->where('status', $statusFilter);
        }

        $pengaduans = $query->get();

        // Statistik — selalu global per user, tidak terpengaruh filter
        $total    = Pengaduan::where('user_id', $userId)->count();
        $menunggu = Pengaduan::where('user_id', $userId)->where('status', '0')->count();
        $diproses = Pengaduan::where('user_id', $userId)->where('status', '1')->count();
        $selesai  = Pengaduan::where('user_id', $userId)->where('status', '2')->count();
        $ditolak  = Pengaduan::where('user_id', $userId)->where('status', '3')->count();

        // Progress bar
        $selesaiCount     = Pengaduan::where('user_id', $userId)->where('status', '2')->count();
        $persenDitanggapi = $total > 0 ? round(($selesaiCount / $total) * 100) : 0;
        $ditanggapi       = $selesaiCount;
        $belumDitanggapi  = $total - $selesaiCount;

        return view('siswa.dashboard', compact(
            'pengaduans', 'total', 'menunggu', 'diproses', 'selesai', 'ditolak',
            'ditanggapi', 'belumDitanggapi', 'persenDitanggapi', 'statusFilter'
        ));
    }
}