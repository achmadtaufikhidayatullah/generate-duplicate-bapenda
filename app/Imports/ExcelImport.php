<?php

namespace App\Imports;

use App\Models\ExcelModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExcelImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   //  public function model(array $row)
   //  {
   //      return new Excel([
   //          //
   //      ]);
   //  }

   public function collection(Collection $rows)
    {
       //   dd(gettype($row[2]));
       foreach ($rows as $key => $row) 
       {
          if ($key >= 1) {
              ExcelModel::create([
               'no_polisi' => $row[0],
               'no_hp' => $row[1],
               'tgl_akhir_pkb' => $row[2],
               'njkb' => $row[3],
            ]);
           }
            
        }
    }
}
