<?php

namespace App\Exports;

use App\Models\ExcelModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Http\Request;
use DB;

class ExcelExport implements FromView , ShouldAutoSize , WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
   //  public function collection()
   //  {
   //      return Excel::all();
   //  }

   public function view(): View
   { 
      $excelData = ExcelModel::all();
      $duplicated = DB::table('excel')
                    ->select('no_hp', DB::raw('count(`no_hp`) as occurences'))
                    ->groupBy('no_hp')
                    ->having('occurences', '>', 1)
                    ->get();

      // $excelDuplicate = [];

      foreach ($duplicated as $duplicate) {
         $excel[] = ExcelModel::where('no_hp' , $duplicate->no_hp)->orderBy('njkb', 'desc')->take(5)->get();
         $excelDuplicate[] = $duplicate->no_hp;
      }

      $excelNotDuplicate = ExcelModel::whereNotIn('no_hp' , $excelDuplicate)->get();

      foreach ($excel as $excel1) {
         foreach ($excel1 as $excel2) {
            $excelFix[] = $excel2;
         }
      }

      foreach ($excelNotDuplicate as $end) {
            $excelFix[] = $end;
      }
      
      // dd($excelMentah);
      return view('admin.dashboard.excel', compact('excelFix'));
   }

   public function styles(Worksheet $sheet)
   {
      $sheet->getStyle('A1:H1')->getFont()->setBold(true);
   }
}
