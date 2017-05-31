<?php

namespace App\Http\Controllers;

use App\BoundaryPoint;
use App\Location;
use Illuminate\Http\Request;

class BoundaryPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BoundaryPoint::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bp = new BoundaryPoint();
        $bp->x = $request->input('x');
        $bp->y = $request->input('y');
        $bp->save();

        $bp->location()->associate(Location::find(
            $request->input('location_id')
        ));

        return response()->json([
            'message' => 'Запись создана'
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
        return BoundaryPoint::findOrFail($id);
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
        $bp = BoundaryPoint::findOrFail($id);
        $bp->x = $request->input('x');
        $bp->y = $request->input('y');
        $bp->location()->associate(Location::find(
            $request->input('location_id')
        ));
        $bp->save();

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
        BoundaryPoint::destroy($id);

        return response()->json([
            'message' => 'Запись удалена'
        ]);
    }
}
