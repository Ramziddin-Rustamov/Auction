<?php

namespace App\Http\Controllers\API\v1;

use App\Models\BiddingHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\BiddingHistoryRequest;
use App\Http\Resources\API\V1\BiddingHistoryResource;
use Exception;
use Illuminate\Http\Request;

class BiddingHistoryController extends Controller
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
        $biddingHistory = BiddingHistory::paginate(10);
        return BiddingHistoryResource::collection($biddingHistory);
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
    public function store(Request $request, BiddingHistoryRequest $biddingHistoryRequest)
    {
        $biddingHistory = BiddingHistory::create($biddingHistoryRequest->validated());
        return $biddingHistory;
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\BiddingHistory  $biddingHistory
     * @return \Illuminate\Http\Response
     */
    public function show($biddingHistory)
    {
        $bid = BiddingHistory::find($biddingHistory);
        if($bid){
            return new BiddingHistoryResource($bid);
        }
        return $this->error;
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BiddingHistory  $biddingHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(BiddingHistory $biddingHistory)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BiddingHistory  $biddingHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $biddingHistory, BiddingHistoryRequest $biddingHistoryRequest)
    {
        $update = BiddingHistory::find($biddingHistory);
        if($update){
           $updated =  $update->update($biddingHistoryRequest->validated());
           return new BiddingHistoryResource($updated);
        }
        return $this->error;
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BiddingHistory  $biddingHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy($biddingHistory)
    {
      try{
        $delete = BiddingHistory::find($biddingHistory);
        if($delete){
            $delete->delete();
        }
        return $this->error;
      }catch(Exception $e){
        return response()->json(
            [
                'message'=>'you can not delete this ! '
            ]
        );
      }
    }
}
