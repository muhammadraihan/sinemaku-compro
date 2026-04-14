<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Phyk;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;

use Auth;
use DataTables;
use URL;

class PhykController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Phyk::selectRaw("
                        name, email, created_at, DATE(created_at) as created_date, TIME(created_at) as created_time,
                        CONCAT(
                        TIMESTAMPDIFF(MONTH, created_at, NOW()), ' bulan ',
                        DATEDIFF(
                            CURDATE(),
                            DATE(DATE_ADD(
                            created_at,
                            INTERVAL TIMESTAMPDIFF(MONTH, DATE(created_at), CURDATE()) MONTH
                            ))
                        ), ' hari'
                        ) AS durasi
                    ")
                    ->orderBy('created_at', 'DESC')
                    ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //     return '
                //             <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('phyk.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                //             <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('phyk.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>';
                // })
                ->removeColumn('id')
                ->removeColumn('uuid')
                // ->rawColumns(['action','photo', 'poster'])
                ->make(true);
        }

        return view('phyk.index');
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

    public function export(Request $request)
    {
        // $q = Membership::query();

        // // opsional: terapkan pencarian global dari DataTables
        // if ($search = $request->input('search.value')) {
        //     $q->where(function ($x) use ($search) {
        //         $x->where('first_name', 'like', "%{$search}%")
        //         ->orWhere('last_name', 'like', "%{$search}%")
        //         ->orWhere('email', 'like', "%{$search}%")
        //         ->orWhere('city', 'like', "%{$search}%")
        //         ->orWhere('phone_number', 'like', "%{$search}%");
        //     });
        // }

        // $rows = $q->orderBy('first_name')->get(['first_name','last_name','email','city','phone_number']);

        $rows = Phyk::selectRaw("
                        name, email, created_at, DATE(created_at) as created_date, TIME(created_at) as created_time,
                        CONCAT(
                        TIMESTAMPDIFF(MONTH, created_at, NOW()), ' bulan ',
                        DATEDIFF(
                            CURDATE(),
                            DATE(DATE_ADD(
                            created_at,
                            INTERVAL TIMESTAMPDIFF(MONTH, DATE(created_at), CURDATE()) MONTH
                            ))
                        ), ' hari'
                        ) AS durasi
                    ");
                    if(!empty($request['tgl_mulai']) && !empty($request['tgl_akhir'])){
                        $rows = $rows->whereBetween(DB::raw('DATE(created_at)'), [$request->tgl_mulai, $request->tgl_akhir]);
                    }
                    $rows = $rows->orderBy('created_at', 'DESC')
                    ->get();

        $data = $rows->values()->map(function ($r, $i) {
            return [
                'No'            => $i + 1,
                'Created Date'  => $r->created_date,
                'Created Time'  => $r->created_time,
                'Duration'      => $r->durasi,
                'First Name'    => $r->name,
                'Email'         => $r->email,
            ];
        });

        return (new FastExcel($data))->download('list_user_PHYK.xlsx');
    }

    public function listData(Request $request) {
        // dd($request->all());

        // Ambil semua data dengan relasi yang dibutuhkan
        $query = Phyk::selectRaw("
                        name, email, created_at
                    ");
    
        if (!empty($request->tgl_mulai) && !empty($request->tgl_akhir)) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$request->tgl_mulai, $request->tgl_akhir]);
        }
        $data = $query->orderBy('created_at', 'DESC')
                    ->get();

        // dd($data);
    
        // Kirim data ke Datatables
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function($row){
                return \Carbon\Carbon::parse($row->created_at)->format('d-m-Y'); // Format hh:mm
            })
            ->addColumn('waktu', function($row){
                return \Carbon\Carbon::parse($row->created_at)->format('H:i'); // Format hh:mm
            })
            ->addColumn('durasi', function ($row) {
                if (!$row->created_at) return '-';

                $start = \Carbon\Carbon::parse($row->created_at)->startOfDay(); // abaikan jam
                $today = \Carbon\Carbon::today();

                // bulan penuh dulu
                $months = $start->diffInMonths($today);

                // sisa hari setelah tambah 'bulan penuh'
                $days = $start->copy()->addMonths($months)->diffInDays($today);

                // format sederhana (selalu tampilkan kedua komponen)
                // return "{$months} bulan {$days} hari";

                // Jika mau sembunyikan komponen yang 0, ganti dengan:
                $parts = [];
                if ($months > 0) $parts[] = "{$months} bulan";
                if ($days > 0)   $parts[] = "{$days} hari";
                return $parts ? implode(' ', $parts) : '0 hari';
            })
            ->removeColumn('id')
            ->removeColumn('uuid')
            ->make(true);
    }
}
