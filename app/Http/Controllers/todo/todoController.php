<?php

namespace App\Http\Controllers\todo;

use App\Http\Controllers\Controller;
use App\Models\todo;
use Illuminate\Http\Request;

class todoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    if(request('search')) {
        $daata = todo::where('task','like','%'.request('search').'%')->get();
    }else {
        $data = todo::OrderBy('task','asc')->get();
    }
        return view('todo.app', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()    //untuk menampilkan form
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //untuk penyimpanan data
    {
        $request->validate([
            'task' => 'required | min:5|max:20'
        ],[
            'task.required' => 'Isian task wajib diisi',
            'task.min' => 'Minimal isian untuk task  5 karakter',
            'task.max' => 'Maximal isian untuk task  20 karakter',
        ]);

        $data = [
            "task" => $request->input('task')
        ];
        todo::create($data);
        return redirect()->route('todo')->with('success','Berhasil simpan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required | min:5|max:20'
        ],[
            'task.required' => 'Isian task wajib diisi',
            'task.min' => 'Minimal isian untuk task  5 karakter',
            'task.max' => 'Maximal isian untuk task  20 karakter',
        ]);

        $data = [
            "task" => $request->input('task'),
            "is_done" => $request->input('is_done')
        ];

        todo::where('id',$id)->update($data);
        return redirect()->route('todo')->with('success', 'Berhasil menyimpan data perbaikan data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        todo::where('id',$id)->delete();
        return redirect()->route('todo')->with('success', 'Berhasil menghapus data');
    }
}
