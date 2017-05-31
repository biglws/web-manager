<?php

namespace App\Http\Controllers;

use App\Beacon;
use Illuminate\Http\Request;

class BeaconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        sleep(1);
        return Beacon::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $beacon = Beacon::create($request->all());

        return response()->json([
            'message' => 'Запись создана',
            'data'    => collect(['id' => $beacon->id])->merge($request->all())
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Beacon::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Beacon $beacon */
        $beacon = Beacon::findOrFail($id);
        $beacon->fill($request->all())->save();

        return response()->json([
            'message' => 'Запись обновлена'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var Beacon $beacon */
        $beacon = Beacon::findOrFail($id);
        $beacon->delete();

        return response()->json([
            'message' => 'Запись удалена'
        ]);
    }
}
