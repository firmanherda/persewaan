<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SPKController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();

        return view('user.spk.index', compact('kriterias'));
    }

    public function hitung(Request $request)
    {
        $bobots = $request->bobots;
        $kriterias = Kriteria::all();

        // 1. Penilaian Alternatif untuk Kriteria
        $penilaians = Penilaian::with(['alternatif', 'kriteria'])
            ->get()
            ->groupBy('alternatif.id')
            ->sortKeys();
        //dipakai untuk  hitung jumlah nilai berdasarkan kriteria id
        $totals = DB::table('penilaians')
            ->groupBy('kriteria_id')
            ->selectRaw('SUM(nilai) as total, kriteria_id')
            ->get();

        //collect untuk helper untuk mudah untuk manipulasi array sama object
        //clone untuk variabel lama tidak tergnti nilainya soalnya memakai 1 method
        $step1 = collect([
            'penilaians' => clone $penilaians,
            'totals' => $totals
        ]);
        // 2. Normalisasi Matriks
        //map adalah array diubah
        //tmp adalah untuk penampung
        //step 2 nilai kriteria per alternatif
        $step2 = clone $step1['penilaians']->map(function ($penilaian1) use ($totals) {
            $ps1 = clone $penilaian1;
            return $ps1->map(function ($p, $i) use ($totals) {
                $tmp2 = clone $p;
                $tmp2->nilai = bcdiv(($tmp2->nilai / $totals[$i]->total), 1,2);

                return $tmp2;
            });
        });
        // 3. Normalisasi Matriks terbobot (Xij * Wj)
        $step3 = $step2->map(function ($s2) use ($bobots) {
            return $s2->map(function ($hasil2, $i) use ($bobots) {
                $tmp3 = clone $hasil2;
                $tmp3->nilai = bcdiv(($tmp3->nilai * $bobots[$i]), 1,2);

                return $tmp3;
            });
        });
        // 4. Menghitung nilai maksimal dan minimal Indeks
        $jenis = $step3->map(function ($s3) {
            $tmpJenis = clone $s3;
            return $tmpJenis->groupBy('kriteria.jenis');
        });

        $step4 = $jenis->map(function ($j) {
            return $j->map(function ($hasilJenis) {
                $tmp4 = clone $hasilJenis;
                return [
                    'nilai_indeks' => bcdiv($tmp4->sum('nilai'),1,2),
                    'penilaians' => $tmp4
                ];
            });
        });

        // 5. Hitung bobot relatif
        $step51 = [];
        $step51 = clone $step4->map(function ($s4) {
            return [
                'Cost' => ['nilai' => bcdiv(1 / $s4['Cost']['nilai_indeks'], 1,2)],
                'Benefit' => ['nilai' => $s4['Benefit']['nilai_indeks']]
            ];
        });

        $step51['sum_cost'] = $step51->sum('Cost.nilai');
        $step51['sum_benefit'] = $step51->sum('Benefit.nilai');

        $step52 = clone $step4->map(function ($s51) use ($step51) {
            return ['nilai' => bcdiv($s51['Cost']['nilai_indeks'] * $step51['sum_cost'], 1,2)];
        });

        $step53 = clone $step52->map(function ($s53) use ($step4) {
            $totalS4 = $step4->sum('Cost.nilai_indeks');
            return ['nilai' => bcdiv($totalS4 / $s53['nilai'], 1,2)];
        });

        $step54 = clone $step53->map(function ($s54, $i) use ($step51) {
            return ['nilai' => bcdiv(($step51[$i]['Benefit']['nilai'] + $s54['nilai']), 1,2)];
        });
        $max = $step54->max('nilai');

        $step55 = clone $step54->map(function ($s55) use ($max) {
            return ['nilai' => bcdiv($s55['nilai'] / $max * 100, 1,2)];
        });

        $step5 = ['step51' => $step51, 'step52' => $step52, 'step53' => $step53, 'step54' => $step54, 'step55' => $step55];
        // dd($step5);

        return view('user.spk.index', compact('penilaians', 'kriterias', 'step1', 'step2', 'step3', 'step4', 'step5', 'max'));
    }
}
