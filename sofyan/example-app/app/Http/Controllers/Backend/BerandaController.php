<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countDitolakVendor = DB::table('_t_r__pengajuan')->where('status_pengajuan_vendor', 2)->count();
        $countDiterimaVendor = DB::table('_t_r__pengajuan')->where('status_pengajuan_vendor', 1)->count();
        $counttotalBarang = DB::table('_detail__pengajuan')->get('id')->count();
        $counttotaluser = DB::table('users')->get('id')->count();
        $countDitolakPengajuan = DB::table('_t_r__pengajuan')->where('status_pengajuan_ap', 2)->count();
        $countDiterimaPengajuan = DB::table('_t_r__pengajuan')->where('status_pengajuan_ap', 1)->count();

        return view('backend.home.index', compact('countDitolakVendor', 'countDiterimaVendor', 'countDitolakPengajuan', 'countDiterimaPengajuan', 'counttotalBarang', 'counttotaluser'));
    }

    public function handleChart()
    {
        $pengajuanData = DB::table('_t_r__pengajuan')
            ->select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('count');

        $months = DB::table('_t_r__pengajuan')
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

    public function vendorChartData()
    {
        $allVendor = DB::table('vendors')->select('id', 'nama')->get();

        $simpananDoi = [];
        $totalAll = DB::table('_detail__pengajuan')->count();

        foreach ($allVendor as $key => $value) {
            $totalPerVendor = DB::table('_detail__pengajuan')
                ->join('_m_s_t__barang', '_m_s_t__barang.id', '_detail__pengajuan.id_barang')
                ->where('Id_vendor', $value->id)
                ->count();

            array_push($simpananDoi, (object)[
                'nama_vendor' => $value->nama,
                'persentase_pemesanan' => $totalPerVendor / $totalAll * 100
            ]);
        }

        return response()->json($simpananDoi);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
