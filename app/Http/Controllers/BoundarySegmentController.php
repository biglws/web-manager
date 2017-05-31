<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\BoundaryPoint;
use App\BoundarySegment;
use App\Location;
use Illuminate\Http\Request;

class BoundarySegmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BoundarySegment::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bs = new BoundarySegment();
        $bs->segment_no = $request->input('segment_no');
        $bs->distance   = $request->input('distance');
        $bs->from_side  = $request->input('from_side');
        $bs->save();

        $bs->beacon()->associate(Beacon::find(
            $request->input('beacon_id')
        ));

        $bs->boundaryPoint()->associate(BoundaryPoint::find(
            $request->input('boundary_point_id')
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
        return BoundarySegment::findOrFail($id);
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
        $bs = BoundarySegment::findOrFail($id);
        $bs->segment_no = $request->input('segment_no');
        $bs->distance   = $request->input('distance');
        $bs->from_side  = $request->input('from_side');

        $bs->beacon()->associate(Beacon::find(
            $request->input('beacon_id')
        ));

        $bs->boundaryPoint()->associate(BoundaryPoint::find(
            $request->input('boundary_point_id')
        ));

        $bs->save();

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
        BoundarySegment::destroy($id);

        return response()->json([
            'message' => 'Запись удалена'
        ]);
    }
}
