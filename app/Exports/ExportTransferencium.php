<?php

namespace App\Exports;

use App\Models\Transferencium;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTransferencium implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transferencium::all();
    }
}
