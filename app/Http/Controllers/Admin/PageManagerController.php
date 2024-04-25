<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
use Alert;
// UNTUK KONEKSI MODEL
use App\Models\Admin;
use App\Models\WebSetting;
use App\Models\PageManager;

class PageManagerController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Halaman';
        $data['subdesc'] = 'Halaman untuk mengelola menu dan halaman';
        $data['web'] = WebSetting::all()->first();
        $data['page'] = PageManager::all();
        $data['mpage'] = PageManager::where('page_type', 0)->get();
        $data['spage'] = PageManager::where('page_type', 1)->get();

        return view('admin.pages.manage-page-index', $data);
    }

    public function store(Request $request){
        $request->validate([
            'page_role' => 'nullable|integer',
            'page_type' => 'required|integer',
            'page_id' => 'nullable|integer',
            'page_name' => 'required|string|max:255',
            'page_font' => 'nullable|string|max:255',
            'page_desc' => 'required|string|max:255',
            'page_link' => 'required|string|max:255',
        ]);

        $page = PageManager::create([
            'page_id' => $request->page_id,
            'page_role' => $request->page_role,
            'page_type' => $request->page_type,
            'page_name' => $request->page_name,
            'page_font' => $request->page_font,
            'page_desc' => $request->page_desc,
            'page_link' => $request->page_link,
        ]);

        $page->save();

        Alert::success('Success', 'Data berhasil ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        $request->validate([
            'page_role' => 'nullable|integer',
            'page_type' => 'required|integer',
            'page_id' => 'nullable|integer',
            'page_name' => 'required|string|max:255',
            'page_font' => 'nullable|string|max:255',
            'page_desc' => 'required|string|max:255',
            'page_link' => 'required|string|max:255',
        ]);

        $page = PageManager::findOrFail($id);
        $page->page_id = $request->page_id;
        $page->page_role = $request->page_role;
        $page->page_type = $request->page_type;
        $page->page_name = $request->page_name;
        $page->page_font = $request->page_font;
        $page->page_link = $request->page_link;
        $page->page_desc = $request->page_desc;
        $page->save();

        Alert::success('Success', 'Data berhasil diupdate');
        return back();
    }

    public function destroy($id){
        $page = PageManager::findOrFail($id);
        $page->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return back();
    }
}
