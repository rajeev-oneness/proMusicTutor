<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GuitarSeries,Auth;

class TutorController extends Controller
{
    public function guitarSeriesView(Request $req)
    {
        $user = auth()->user();
        $guitarSeries = GuitarSeries::where('createdBy',$user->id)->get();
        return view('tutor.guitarSeries.index',compact('guitarSeries'));
    }

    public function guitarSeriesCreate(Request $req)
    {
        
    }

    public function guitarSeriesSave(Request $req)
    {
        dd($req->all());
    }

    public function guitarSeriesEdit(Request $req,$seriesId)
    {

    }

    public function guitarSeriesUpdate(Request $req,$seriesId)
    {
        dd($req->all());
    }

    public function guitarSeriesDelete(Request $req)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $series = GuitarSeries::find($req->id);
            if($series){
                $series->delete();
                return successResponse('GuitarSeries Deleted Success');  
            }
            return errorResponse('Invalid GuitarSeries Id');
        }
        return errorResponse($validator->errors()->first());
    }

    public function guitarSeriesLessionView(Request $req,$seriesId)
    {
        $user = auth()->user();
        $guitarSeries = GuitarSeries::where('id',$seriesId)->where('createdBy',$user->id)->get();
        return view('tutor.guitarSeries.lession.index',compact('guitarSeries'));
    }
}
