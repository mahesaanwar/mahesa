<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Latihan;
use Illuminate\Support\Facades\Storage;

class LatihanController extends Controller
{
    public function index(): View
    {
        $latihans = Latihan::latest()->paginate(10);
        return view('latihan.index', compact('latihans'));
    }

    public function create(): View
    {
        return view('latihan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'content'   => 'required|min:10'
        ]);

        $image = $request->file('image');
        $image->storeAs('public/latihan', $image->hashName());

        Latihan::create([
            'image'    => $image->hashName(),
            'title'    => $request->title,
            'content'  => $request->content
        ]);

        return redirect()->route('latihan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $latihan = Latihan::findOrFail($id);

        return view('latihan.show', compact('latihan'));
    }

    public function edit(string $id): View
    {
        $latihan = Latihan::findOrFail($id);

        return view('latihan,edit', compact('latihan'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $this->validate($request, [
            'image'     =>'image|mimes:jpeg,jpg,png|max:2048',
            'title'     =>'required|min:5',
            'content'   =>'required|min:10'
        ]);

        $latihan = Latihan::findOrFail($id);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image->storeAs('public/latohans/'.$latihan->hashName());

            Storage::delete('public/latihans/'.$latihan->image);

            $latihan->update([
                'image'=>$image->hashName(),
                'title'=>$request->title,
                'content'=>$request->content
            ]);

        }else {
            $latihan->update([
                'title'=>$request->title,
                'content'=>$request->content
            ]);
        }

        return redirect()->route('latihan.index')->with(['success'=> 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id): RedirectResponse
    {

        $latihan = Latihan::findOrFail($id);
        Storage::delete('public/latihan/'. $latihan->image);
        $latihan->delete();

        return redirect()->route('latihan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
