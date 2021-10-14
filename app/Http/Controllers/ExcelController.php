<?php

namespace App\Http\Controllers;

use App\Models\ExcelModel;
use App\Imports\ExcelImport;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;

class excelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $excel = ExcelModel::all();
       $data = count(ExcelModel::all());

       return view('admin.dashboard.index', compact('excel' , 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // $excelData = ExcelModel::all();
      // $duplicated = DB::table('excel')
      //               ->select('no_hp', DB::raw('count(`no_hp`) as occurences'))
      //               ->groupBy('no_hp')
      //               ->having('occurences', '>', 1)
      //               ->get();

      // // $excelDuplicate = [];

      // foreach ($duplicated as $duplicate) {
      //    $excel[] = ExcelModel::where('no_hp' , $duplicate->no_hp)->orderBy('njkb', 'asc')->take(5)->get();
      //    $excelDuplicate[] = $duplicate->no_hp;
      // }

      // $excelNotDuplicate = ExcelModel::whereNotIn('no_hp' , $excelDuplicate)->get();

      // foreach ($excel as $excel1) {
      //    foreach ($excel1 as $excel2) {
      //       $excelMentah[] = $excel2;
      //    }
      // }

      // foreach ($excelNotDuplicate as $end) {
      //       $excelMentah[] = $end;
      // }
      
      // dd($excelMentah);

      return Excel::download(new ExcelExport, 'Generate-Excel-Duplicate.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Excel::import(new ExcelImport, $request->file('file'));

         return redirect()->route('excel.index')->with('toast_success', 'Data Berhasil diupload!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Excel  $excel
     * @return \Illuminate\Http\Response
     */
    public function show(Excel $excel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Excel  $excel
     * @return \Illuminate\Http\Response
     */
    public function edit(Excel $excel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Excel  $excel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Excel $excel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Excel  $excel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Excel $excel)
    {
        ExcelModel::truncate();

        return redirect()->route('excel.index')->with('toast_success', 'Data Berhasil dibersihkan!');
    }
}
