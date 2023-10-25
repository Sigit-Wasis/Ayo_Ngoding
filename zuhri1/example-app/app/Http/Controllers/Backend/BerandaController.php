<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //    $countDitolakVendor = DB ::table('tr_pengajuan')->where('status_pengajuan_vendor',1)->count();
    //    $countDiterimaVendor = DB ::table('tr_pengajuan')->where('status_pengajuan_vendor',0)->count();
    //    $counttotalBarang = DB ::table ('detail_pengajuan')->where('id')->count();
       
        return view ('backend.home.index');
    }
    public function handleChart()
    {
        $pengajuanData = DB::table('tr_pengajuan')
        ->select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(created_at) as month"))
        ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('count');

        $months = DB::table('tr_pengajuan')
        ->select(DB::raw("MONTH(created_at) as month"))
        ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('month');

        // Buat array yang berisi data pengajuan dan bulan
        $chartData = [];
        foreach ($months as $month) {
            $chartData[] = [
                'month' => $month,
                'count' => $pengajuanData->shift(),
            ];
        }

        return response()->json($chartData);
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}