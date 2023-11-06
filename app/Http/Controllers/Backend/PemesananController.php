<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\House;
use App\Models\Booking;
use App\Models\HouseBlock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PemesananController extends Controller
{
    public function index(){

        $perumahan = House::orderBy('created_at', 'desc')
                            ->get();

        $users = User::where('role_id', 3)
                        ->orderBy('created_at', 'desc')
                        ->get();

        if (auth()->user()->role_id != 3) {
            $bookings = Booking::orderBy('created_at', 'desc')->get();
        } else {
            $bookings = Booking::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        }

        return view('backend.pemesanan.index', compact('perumahan', 'bookings', 'users'));
    }

    public function store(Request $request){

        $request->validate([
            'perumahan_id' => 'required|integer',
            'blok_id' => 'required|integer',
            'pembayaran' => 'required|image|mimes:png,jpeg,jpg|max:2048',
            'sales' =>  $request->sales ? 'required|integer' : '',
        ]);

        $bookings = Booking::where('user_id', auth()->user()->role_id != 3 ? $request->sales : auth()->user()->id)
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
            $booking->user_id = auth()->user()->role_id != 3 ? $request->sales : auth()->user()->id ;
            $booking->house_id = $request->perumahan_id;
            $booking->house_block_id = $request->blok_id;
            $booking->payment = $imageName;
            $booking->save();

            HouseBlock::find($request->blok_id)->update([
                'status' => 'booking'
            ]);

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
            'pembayaran' => 'image|mimes:png,jpeg,jpg|max:2048',
            'sales' =>  $request->sales ? 'required|integer' : '',
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
            'user_id' => auth()->user()->role_id != 3 ? $request->sales : auth()->user()->id,
            'house_block_id' => $request->blok_id,
            'status' => $request->status,
            'akad_at' => $request->status == 6 ? date('Y-m-d H:i:s') : null,
            'payment' => $request->pembayaran ? $image : $booking->payment
        ]);

        HouseBlock::find($request->blok_id)->update([
            'status' => $request->status == 6 ? 'deal' : ($request->status == 7 ? 'ready' : 'booking')
        ]);

        return redirect()->back()->with('success', 'pemesanan berhasil diubah');
    }
}
