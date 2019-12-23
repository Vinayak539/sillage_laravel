<?php

namespace App\Exports;

use App\Model\TxnOrder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrderExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $orders = TxnOrder::with('details', 'user', 'transaction')->orderBy('id', 'ASC')->get();

        return view('backend.admin.orders.export', compact('orders'));
    }
}
