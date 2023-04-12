<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//return type View
use Illuminate\View\View;
use App\Models\Karyawan;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;

class KaryawanController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $karyawans = Karyawan::with('role')->latest()->paginate(5);

        //render view with posts
        return view('karyawans.index', compact('karyawans'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('karyawans.create', compact('roles'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nip'     => 'required',
            'nama'     => 'required',
            'alamat'   => 'required',
            'email'   => 'required',
        ]);
        
        //create post
        $save = Karyawan::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => hash('sha256', $request->password) ?? hash('sha256', '123456'), 
            'role_id' => $request->role_id ?? 2,
        ]);

        //redirect to index
        return redirect()->route('karyawans.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get post by ID
        $karyawan = Karyawan::findOrFail($id);

        //render view with post
        return view('karyawans.show', compact('karyawan'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(string $id): View
    {
        //get post by ID
        $karyawan = Karyawan::findOrFail($id);

        //render view with post
        return view('karyawans.edit', compact('karyawan'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nip'     => 'required',
            'nama'     => 'required',
        ]);

        //get post by ID
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update([
            'nip' => $request->nip ?? $karyawan->nip,
            'nama' => $request->nama ?? $karyawan->nama,
        ]);
        
        //redirect to index
        return redirect()->route('karyawans.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $karyawan = Karyawan::findOrFail($id);

        //delete post
        $karyawan->delete();

        //redirect to index
        return redirect()->route('karyawans.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
