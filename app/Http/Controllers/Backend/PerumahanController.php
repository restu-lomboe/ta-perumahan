<?php

namespace App\Http\Controllers\Backend;

use App\Models\House;
use App\Models\HouseBlock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerumahanController extends Controller
{
    public function index(){

        $perumahan = House::orderBy('created_at', 'desc')->get();

        return view('backend.perumahan.index', compact('perumahan'));
    }

    public function form(Request $request, $type) {

        $perumahan = '';
        if ($type == 'update') {
            $perumahan = House::find($request->get('id'));
        }

        return view('backend.perumahan.form', compact('type', 'perumahan'));
    }

    public function store(Request $request){

        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string'
        ]);

        try {
            $perumahan = new House;
            $perumahan->name = $request->nama;
            $perumahan->address = $request->alamat;
            $perumahan->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.perumahan')->with('success', 'Penambahan rumah berhasil');
    }

    public function update(Request $request){

        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string'
        ]);

        try {
            $perumahan = House::find($request->get('id'));
            $perumahan->update([
                'name' => $request->nama,
                'address' => $request->alamat,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.perumahan')->with('success', 'Perubahan rumah berhasil');
    }

    public function delete(Request $request){

        $perumahan = House::find($request->get('id'))->delete();

        return redirect()->back()->with('success', 'Perumahan berhasil dihapus');
    }

    public function detail(Request $request){

        $perumahan = House::find($request->get('id'));

        $list_perumahan = HouseBlock::where('house_id', $perumahan->id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('backend.perumahan.detail', compact('perumahan', 'list_perumahan'));
    }

    public function storeBlock(Request $request){

        $request->validate([
            'blok' => 'required|alpha_num',
            'no_rumah' => 'required|numeric',
            'status' => 'required|integer'
        ]);

        $checkExistPerumahan = HouseBlock::where('house_id', $request->get('id'))
                                            ->where('name', $request->blok)
                                            ->where('no', $request->no_rumah)
                                            ->first();
        if ($checkExistPerumahan) {
            return redirect()->back()->with('error', 'Blok '. $request->blok .' dan No Rumah '. $request->no_rumah .' sudah tersedia di perumahan ini, silahkan ganti dengan Blok dan No Rumah yang berbeda');
        }

        try {
            $perumahan_blok = new HouseBlock;
            $perumahan_blok->house_id = $request->get('id');
            $perumahan_blok->name = $request->blok;
            $perumahan_blok->no = $request->no_rumah;
            $perumahan_blok->status = $request->status == 1 ? 'ready' : ($request->status == '2' ? 'booking' : 'deal');
            $perumahan_blok->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Penambahan blok perumahan berhasil');
    }

    public function getDetail(Request $request){

        $perumahan_blok = HouseBlock::find($request->get('id'));
        return json_encode($perumahan_blok);
    }

    public function updateBlok(Request $request){

        $request->validate([
            'blok' => 'required|alpha_num',
            'no_rumah' => 'required|numeric',
            'status' => 'required|integer'
        ]);

        try {

            $perumahan_blok = HouseBlock::find($request->get('id'));
            $perumahan_blok->update([
                'name' => $request->blok,
                'no' => $request->no_rumah,
                'status' => $request->status == '1' ? 'ready' : ($request->status == '2' ? 'booking' : 'deal'),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Perubahan blok perumahan berhasil');
    }

    public function detailJson(Request $request){

        $perumahan = House::find($request->get('id'));

        $list_perumahan = HouseBlock::whereDoesntHave('booking')
                                    ->where('house_id', $perumahan->id)
                                    ->where('status', 'ready')
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return json_encode($list_perumahan);
    }
}
