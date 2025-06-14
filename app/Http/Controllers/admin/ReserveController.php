<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Reserve;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gate;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('role', ['admin','diretor','coordenador','ti','professor']), 403);

        return view('admin.reserve.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($laboratoryId)
    {
        abort_unless(Gate::allows('role', ['admin','coordenador','diretor','ti','professor']), 403);

        $laboratory = Laboratory::with('softwares')->findOrFail($laboratoryId);

        return view('admin.reserve.create', compact('laboratory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(Reserve $reserve)
    {
        abort_unless(Gate::allows('role', ['admin','diretor','coordenador','ti']), 403);

        return view('admin.reserve.show', compact('reserve'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserve $reserve)
    {
        abort_unless(Gate::allows('role', ['admin','coordenador']), 403);

        return view('admin.reserve.edit', compact('reserve'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserve $reserve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserve $reserve)
    {
        //
    }

    public function approve()
    {
        abort_unless(Gate::allows('role', ['admin','diretor']), 403);

        return view('admin.reserve.approve');
    }
}
