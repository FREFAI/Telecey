<?php
namespace App\Exports;

use App\Models\Admin\FeedBack;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FeedBackExport implements FromView
{
    public function view(): View
    {
        return view('exports.feedback', [
            'feedbacks' => FeedBack::with('user')->all()
        ]);
    }
}
