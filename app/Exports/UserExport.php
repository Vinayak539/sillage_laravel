<?php

namespace App\Exports;

use App\Model\TxnOrder;
use App\Model\TxnUser;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use function compact;
use function view;

class UserExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $users = TxnUser::all();

        return view('backend.admin.users.export', compact('users'));
    }
}
