<?php

namespace App\Http\Controllers\Backend;

use App\Models\House;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PemesananController extends Controller
{
    public function index(){

        $perumahan = House::orderBy('created_at', 'desc')
                            ->get();

        $bookings = Booking::orderBy('created_at', 'desc')->get();

        return view('backend.pemesanan.index', compact('perumahan', 'bookings'));
    }

    public function store(Request $request){

        $request->validate([
            'perumahan_id' => 'required|integer',
            'blok_id' => 'required|integer',
            'pembayaran' => 'required|image|mimes:png,jpeg,jpg|max:2048'
        ]);

        $bookings = Booking::where('user_id', auth()->user()->id)
                                ->where('house_id', $request->perumahan_id)
                                ->where('house_block_id', $request->blok_id)
                                ->first();

        if ($bookings) {
            return redirect()->back()->with('error', 'Perumahan '. $bookings->perumahan->name.' Blok '. $bookings->perumahanBlok->name .' dan No Rumah '. $bookings->perumahanBlok->name .' sedang dalam pemesanan, silahkan ganti dengan Blok dan No Rumah yang berbeda');
        }
        try {

            // Get the uploaded file
            $image = $request->file('pembayaran');
            // Generate a unique name for the file
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Move the uploaded file to the public/uploads directory
            $image->move(public_path('uploads'), $imageName);

            $booking = new Booking;
            $booking->user_id = auth()->user()->id;
            $booking->house_id = $request->perumahan_id;
            $booking->house_block_id = $request->blok_id;
            $booking->payment = $imageName;
            $booking->save();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'pemesanan berhasil disimpan');

    }

    public function detailJson(Request $request){

        $booking = Booking::with('perumahanBlok')->where('id', $request->get('id'))->first();

        return json_encode($booking);
    }

    public function update(Request $request){

        $request->validate([
            'perumahan_id' => 'required|integer',
            'blok_id' => 'required|integer',
            'pembayaran' => 'image|mimes:png,jpeg,jpg|max:2048'
        ]);

        $booking = Booking::where('id', $request->get('id'))->first();

        if ($request->pembayaran) {
            # code...
            if (File::exists(public_path($booking->payment))) {
                // Delete the file
                File::delete(public_path($filePath));
            }

            // Get the uploaded file
            $image = $request->file('pembayaran');
            // Generate a unique name for the file
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Move the uploaded file to the public/uploads directory
            $image->move(public_path('uploads'), $imageName);
        }

        $booking->update([
            'house_id' => $request->perumahan_id,
            'house_block_id' => $request->blok_id,
            'status' => $request->status,
            'payment' => $request->pembayaran ? $image : $booking->payment
        ]);

        return redirect()->back()->with('success', 'pemesanan berhasil diubah');
    }
}
