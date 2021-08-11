<?php

namespace App\Exports;

use App\Bill;
use Maatwebsite\Excel\Concerns\FromCollection;


class BillExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(int $id) {
    	$this->id = $id;
    }

    public function collection()
    {
         return Bill::findOrFail($this->id);
    }
}
