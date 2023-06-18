<?php

namespace App\Http\Controllers\API\v1;

use App\Models\CurrentBid;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CurrentBidRequest;
use App\Http\Resources\API\V1\CurrentBidResource;
use Exception;
use Illuminate\Http\Request;

class CurrentBidController extends Controller
{
    public $error = [
        'message'=>'Not Found',
        'status'=>'error',
        'status_code'=>404
    ];
    
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentBid = CurrentBid::all();
        return CurrentBidResource::collection($currentBid);
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CurrentBidRequest $currentBidRequest)
    {
        $bid = CurrentBid::create($currentBidRequest->validated());
        return new CurrentBidResource($bid);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\CurrentBid  $CurrentBid
     * @return \Illuminate\Http\Response
     */
    public function show($CurrentBid)
    {
        $CurrentBid = CurrentBid::find($CurrentBid);
        if($CurrentBid){
            return new CurrentBidResource($CurrentBid);
        }
        return $this->error;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CurrentBid  $CurrentBid
     * @return \Illuminate\Http\Response
     */
    public function edit(CurrentBid $CurrentBid)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CurrentBid  $CurrentBid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $CurrentBid , CurrentBidRequest $currentBidRequest)
    {
        $currentBid = CurrentBid::find($CurrentBid);
        if($currentBid){
            $currentBid->update($currentBidRequest->validated());
            return new CurrentBidResource($currentBid);
        }
        return $this->error;
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CurrentBid  $CurrentBid
     * @return \Illuminate\Http\Response
     */
    public function destroy($CurrentBid)
    {
        try{
            $currentBid = CurrentBid::find($CurrentBid);
            if($currentBid){
                $currentBid->delete();
                return response()->json([
                    'message'=>'Deleted successfully !',
                     'status'=>200
                ]);
            }
            return $this->error;
            }catch(Exception $e){
                return response()->json([
                    'message'=>'You can\'nt delete this ! '
                ]);
            }
    }
}
