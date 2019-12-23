<?php

namespace App\Exports;

use App\Model\TxnOrderDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderReportExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TxnOrderDetail::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Product Name',
            'Product Id',
            'Order ID',
            'Quantity',
            'Mrp',
            'total',
            'Created At',
            'Updated At',
        ];
    }
}
