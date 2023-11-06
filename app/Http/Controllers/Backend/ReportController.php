<?php

namespace App\Http\Controllers\Backend;

use App\Models\House;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(){

        $perumahan = House::orderBy('created_at', 'desc')
                            ->get();

        $bookings = Booking::where(function($query){
                                $query->where('status', 0)
                                        ->orWhere('status', 6);
                            })
                            ->orderBy('created_at', 'desc')->get();

        return view('backend.report.index', compact('bookings', 'perumahan'));
    }

    public function download(Request $request){

        $bookings = Booking::where('house_id', $request->perumahan)
                                ->whereMonth('created_at', explode('-',  $request->month)[1])
                                ->whereYear('created_at', explode('-',  $request->month)[0])
                                ->get();
        $month = $request->month;
        if ($bookings->isEmpty()) {
            return redirect()->back()->with('error', 'data tidak ditemukan');
        }

        return view('backend.report.download', compact('bookings', 'month'));
    }
}
