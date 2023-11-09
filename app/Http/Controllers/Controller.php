<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\HouseBlock;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // Share data to all views
        Booking::where('created_at', '<=', Carbon::now()->subMonths(3))->update([
            'status' => 7
        ]);

        $bookings = Booking::where('status', 7)->get();

        foreach ($bookings as $key => $booking) {
            HouseBlock::find($booking->house_block_id)->update([
                'status' => 'ready'
            ]);
        }
    }
}
