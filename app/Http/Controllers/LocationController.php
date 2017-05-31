<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\BoundaryPoint;
use App\BoundarySegment;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     * Example rel: boundary_points.boundary_segments.beacon
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rels = [];
        if ($request->has('with')) {
            $rels = collect(explode(',', $request->input('with')))->map(function ($value) {
                return Str::camel($value);
            })->toArray();
        }

        return Location::with($rels)->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = new Location();
        $location->name = $request->input('name');
        $location->description = $request->input('description');
        $location->save();

        foreach ($request->input('boundary_points', []) as $point) {
            /** @var BoundaryPoint $bp */
            $bp = $location->boundaryPoints()->save(new BoundaryPoint($point));
            foreach (array_get($point, 'boundary_segments', []) as $segment) {
                $bs = new BoundarySegment($segment);
                $bs->beacon()->associate(Beacon::find($segment['beacon_id']));
                $bp->boundarySegments()->save($bs);
            }
        }

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
        return Location::with('boundaryPoints.boundarySegments.beacon')->findOrFail($id);
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
        /** @var \App\Location $location */
        $location = Location::findOrFail($id);
        $location->name = $request->input('name');
        $location->description = $request->input('description');

        foreach ($request->input('boundary_points', []) as $point) {
            /** @var BoundaryPoint $bp */
            $bp = $location->boundaryPoints()->save(BoundaryPoint::findOrNew($point['id'])->fill($point));
            foreach (array_get($point, 'boundary_segments', []) as $segment) {
                $bs = BoundarySegment::findOrNew($segment['id'])->fill($segment);
                $bs->beacon()->associate(Beacon::find($segment['beacon_id']));
                $bp->boundarySegments()->save($bs);
            }
        }

        $location->update();

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
        Location::destroy($id);

        return response()->json([
            'message' => 'Запись удалена'
        ]);
    }
}
