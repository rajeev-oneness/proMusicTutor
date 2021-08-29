<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GuitarSeries,Auth;
use App\Models\SaxSeries;
use App\Models\SaxLession;
use App\Models\Category,App\Models\GuitarLession;

class TutorController extends Controller
{
    /************************** Guitar Series *****************************/
    public function guitarSeriesView(Request $req)
    {
        $user = auth()->user();
        $guitarSeries = GuitarSeries::where('createdBy',$user->id)->get();
        return view('tutor.guitarSeries.index',compact('guitarSeries'));
    }

    public function guitarSeriesCreate(Request $req)
    {
        $category = Category::get();
        return view('tutor.guitarSeries.create',compact('category'));
    }

    public function guitarSeriesSave(Request $req)
    {
        $req->validate([
            'category' => 'required|min:1|numeric',
            'image' => 'required|image',
            'title' => 'required|string|max:200',
            'media_link' => 'required|url',
            'price' => 'required|numeric|min:1',
            'usd' => 'required|numeric|min:1',
            'euro' => 'required|numeric|min:1',
            'genre' => 'required|string',
            'seo_meta_description' => 'required|string',
            'seo_meta_keywords' => 'required|string',
            'related_series' => 'required|string',
            'difficulty' => 'required|string',
            'description' => 'required|string',
            'item_clean_url' => 'required|url',
        ]);
        // {{-- $table->string('difficulty');
        //     $table->string('seo_meta_description');
        //     $table->string('seo_meta_keywords')->nullable();
        //     $table->string('related_series');
        // }); --}}
        $newSeries = new GuitarSeries();
        $newSeries->categoryId = $req->category;
        $newSeries->title = $req->title;
        $newSeries->description = $req->description;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $newSeries->image = imageUpload($image);
        }
        $newSeries->video_url = $req->media_link;
        $newSeries->price = $req->price;
        $newSeries->gbp = $req->gbp;
        $newSeries->usd = $req->usd;
        $newSeries->euro = $req->euro;
        $newSeries->genre = $req->genre;
        $newSeries->difficulty = $req->difficulty;
        $newSeries->seo_meta_description = $req->seo_meta_description;
        $newSeries->seo_meta_keywords = $req->seo_meta_keywords;
        $newSeries->related_series = $req->related_series;
        $newSeries->item_clean_url = $req->item_clean_url;
        $newSeries->createdBy = auth()->user()->id;
        $newSeries->save();
        return redirect(route('tutor.guitar.series'))->with('Success','Guitar Series Added SuccessFully');
    }

    public function guitarSeriesEdit(Request $req,$seriesId)
    {
        $category = Category::get();$user = auth()->user();
        $guitarSeries = GuitarSeries::where('id',$seriesId)->where('createdBy',$user->id)->first();
        return view('tutor.guitarSeries.edit',compact('category','guitarSeries'));
    }

    public function guitarSeriesUpdate(Request $req,$seriesId)
    {
        $req->validate([
            'guitarSeriesId' => 'required|min:1|numeric|in:'.$seriesId,
            'category' => 'required|min:1|numeric',
            'image' => 'nullable|image',
            'title' => 'required|string|max:200',
            'media_link' => 'nullable|url',
            'price' => 'required|numeric|min:1',
            'usd' => 'required|numeric|min:1',
            'euro' => 'required|numeric|min:1',
            'genre' => 'required|string',
            'seo_meta_description' => 'required|string',
            'seo_meta_keywords' => 'required|string',
            'related_series' => 'required|string',
            'difficulty' => 'required|string',
            'description' => 'required|string',
            'item_clean_url' => 'required|url',
        ]);
        $updateSeries = GuitarSeries::where('id',$seriesId)->first();
        $updateSeries->categoryId = $req->category;
        $updateSeries->title = $req->title;
        $updateSeries->description = $req->description;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $updateSeries->image = imageUpload($image);
        }
        $updateSeries->video_url = $req->media_link;
        $updateSeries->price = $req->price;
        $updateSeries->gbp = $req->gbp;
        $updateSeries->usd = $req->usd;
        $updateSeries->euro = $req->euro;
        $updateSeries->genre = $req->genre;
        $updateSeries->difficulty = $req->difficulty;
        $updateSeries->seo_meta_keywords = $req->seo_meta_keywords;
        $updateSeries->seo_meta_description = $req->seo_meta_description;
        $updateSeries->related_series = $req->related_series;
        $updateSeries->item_clean_url = $req->item_clean_url;
        // {{-- $table->dropColumn('price');
        //     $table->dropColumn('gbp');
        //     $table->dropColumn('usd');
        //     $table->dropColumn('euro');
        //     $table->dropColumn('genre');
        //     $table->dropColumn('difficulty');
        //     $table->dropColumn('seo_meta_description');
        //     $table->dropColumn('seo_meta_keywords');
        //     $table->dropColumn('related_series'); --}}
        $updateSeries->save();
        return redirect(route('tutor.guitar.series'))->with('Success','Guitar Series Updated SuccessFully');
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

    /****************************** Guitar Series Lession *******************************/
    public function guitarSeriesLessionView(Request $req,$seriesId)
    {
        $user = auth()->user();
        $guitarSeries = GuitarSeries::where('id',$seriesId)->where('createdBy',$user->id)->first();
        return view('tutor.guitarSeries.lession.index',compact('guitarSeries'));
    }

    public function guitarSeriesLessionCreate(Request $req,$seriesId)
    {
        $user = auth()->user();
        $guitarSeries = GuitarSeries::where('id',$seriesId)->where('createdBy',$user->id)->first();
        return view('tutor.guitarSeries.lession.create',compact('guitarSeries'));
    }

    public function guitarSeriesLessionSave(Request $req,$seriesId)
    {
        $req->validate([
            'guitarSeriesId' => 'required|min:1|numeric|in:'.$seriesId,
            'title' => 'required|string|max:200',
            'price' => 'required|numeric|min:1',
            'description' => 'required|string',
            'image' => 'required|image',
            'media_link' => 'required|url',
            'usd' => 'required|numeric|min:1',
            'euro' => 'required|numeric|min:1',
            'keywords' => 'required|string',
            'genre' => 'required',
            'product_code' => 'required|string',
            'item_clean_url' => 'required|url',
            'status' => 'required',
        ]);
       
        $series = GuitarSeries::where('id',$seriesId)->first();
        $newLession = new GuitarLession();
            $newLession->categoryId = $series->categoryId;
            $newLession->guitarSeriesId = $series->id;
            $newLession->title = $req->title;
            if($req->hasFile('image')){
                $image = $req->file('image');
                $newLession->image = imageUpload($image,'guitar/lession');
            }
            $newLession->currencyId = 3;
            $newLession->price = $req->price;
            $newLession->video_url = $req->media_link;
            $newLession->gbp = $req->gbp;
            $newLession->usd = $req->usd;
            $newLession->euro = $req->euro;
            $newLession->keywords = $req->keywords;
            $newLession->genre = $req->genre;
            $newLession->product_code = $req->product_code;
            $newLession->status = $req->status;
            $newLession->description = $req->description;
            $newLession->item_clean_url = $req->item_clean_url;
            $newLession->createdBy = auth()->user()->id;
        $newLession->save();
        return redirect(route('tutor.guitar.series.lession',$seriesId))->with('Success','Guitar Lession Added SuccessFully');
    }

    public function guitarSeriesLessionEdit(Request $req,$seriesId,$lessionId)
    {
        $user = auth()->user();
        $guitarLession = GuitarLession::where('id',$lessionId)->where('guitarSeriesId',$seriesId)->where('createdBy',$user->id)->first();
        return view('tutor.guitarSeries.lession.edit',compact('guitarLession'));
    }

    public function guitarSeriesLessionUpdate(Request $req,$seriesId,$lessionId)
    {
        $req->validate([
            'guitarSeriesId' => 'required|min:1|numeric|in:'.$seriesId,
            'guitarLessionId' => 'required|min:1|numeric|in:'.$lessionId,
            'title' => 'required|string|max:200',
            'price' => 'required|numeric|min:1',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'media_link' => 'nullable|url',
            'gbp' => 'required|numeric|min:1',
            'usd' => 'required|numeric|min:1',
            'euro' => 'required|numeric|min:1',
            'keywords' => 'required',
            'genre' => 'required',
            'item_clean_url' => 'required|url',
            'status' => 'required',
        ]);
            
        $updateLession = GuitarLession::where('id',$lessionId)->where('guitarSeriesId',$seriesId)->first();
            $updateLession->title = $req->title;
            if($req->hasFile('image')){
                $image = $req->file('image');
                $updateLession->image = imageUpload($image,'guitar/lession');
            }
            $updateLession->price = $req->price;
            $updateLession->description = $req->description;
            $updateLession->video_url = $req->media_link;
            $updateLession->gbp = $req->gbp;
            $updateLession->usd = $req->usd;
            $updateLession->euro = $req->euro;
            $updateLession->keywords = $req->keywords;
            $updateLession->genre = $req->genre;
            $updateLession->product_code = $req->product_code;
            $updateLession->item_clean_url = $req->item_clean_url;
            $updateLession->status = $req->status;
        $updateLession->save();
        return redirect(route('tutor.guitar.series.lession',$seriesId))->with('Success','Guitar Lession Updated SuccessFully');
    }

    public function guitarSeriesLessionDelete(Request $req)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $lession = GuitarLession::find($req->id);
            if($lession){
                $lession->delete();
                return successResponse('Guitar Lession Deleted Success');
            }
            return errorResponse('Invalid Guitar Lession Id');
        }
        return errorResponse($validator->errors()->first());
    }

    /************************** Sax Series *****************************/
    public function saxSeriesView(Request $req)
    {
        $user = auth()->user();
        $saxSeries = SaxSeries::where('createdBy',$user->id)->get();
        return view('tutor.saxSeries.index',compact('saxSeries'));
    }

    public function saxSeriesCreate(Request $req)
    {
        $category = Category::get();
        return view('tutor.saxSeries.create',compact('category'));
    }

    public function saxSeriesSave(Request $req)
    {
        $req->validate([
            'category' => 'required|min:1|numeric',
            'image' => 'required|image',
            'title' => 'required|string|max:200',
            'media_link' => 'required|url',
            'price' => 'required|numeric|min:1',
            'usd' => 'required|numeric|min:1',
            'euro' => 'required|numeric|min:1',
            'genre' => 'required|string',
            'seo_meta_description' => 'required|string',
            'seo_meta_keywords' => 'required|string',
            'related_series' => 'required|string',
            'difficulty' => 'required|string',
            'description' => 'required|string',
            'item_clean_url' => 'required|url',
        ]);
        $newSeries = new SaxSeries();
        $newSeries->categoryId = $req->category;
        $newSeries->title = $req->title;
        $newSeries->description = $req->description;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $newSeries->image = imageUpload($image);
        }
        $newSeries->video_url = $req->media_link;
        $newSeries->price = $req->price;
        $newSeries->gbp = $req->gbp;
        $newSeries->usd = $req->usd;
        $newSeries->euro = $req->euro;
        $newSeries->genre = $req->genre;
        $newSeries->difficulty = $req->difficulty;
        $newSeries->seo_meta_description = $req->seo_meta_description;
        $newSeries->seo_meta_keywords = $req->seo_meta_keywords;
        $newSeries->related_series = $req->related_series;
        $newSeries->item_clean_url = $req->item_clean_url;
        $newSeries->createdBy = auth()->user()->id;
        $newSeries->save();
        return redirect(route('tutor.sax.series'))->with('Success','Sax Series Added SuccessFully');
    }

    public function saxSeriesEdit(Request $req,$seriesId)
    {
        $category = Category::get();$user = auth()->user();
        $saxSeries = SaxSeries::where('id',$seriesId)->where('createdBy',$user->id)->first();
        return view('tutor.saxSeries.edit',compact('category','saxSeries'));
    }

    public function saxSeriesUpdate(Request $req,$seriesId)
    {
        $req->validate([
            'saxSeriesId' => 'required|min:1|numeric|in:'.$seriesId,
            'category' => 'required|min:1|numeric',
            'image' => 'nullable|image',
            'title' => 'required|string|max:200',
            'media_link' => 'required|url',
            'description' => 'required|string',
            'item_clean_url' => 'required|url',
            'price' => 'required|numeric|min:1',
            'usd' => 'required|numeric|min:1',
            'euro' => 'required|numeric|min:1',
            'genre' => 'required|string',
            'seo_meta_description' => 'required|string',
            'seo_meta_keywords' => 'required|string',
            'related_series' => 'required|string',
            'difficulty' => 'required|string',
        ]);
        $updateSeries = SaxSeries::where('id',$seriesId)->first();
        $updateSeries->categoryId = $req->category;
        $updateSeries->title = $req->title;
        $updateSeries->description = $req->description;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $updateSeries->image = imageUpload($image);
        }
        $updateSeries->video_url = $req->media_link;
        $updateSeries->item_clean_url = $req->item_clean_url;
        $updateSeries->price = $req->price;
        $updateSeries->usd = $req->usd;
        $updateSeries->euro = $req->euro;
        $updateSeries->genre = $req->genre;
        $updateSeries->gbp = $req->gbp;
        $updateSeries->seo_meta_description = $req->seo_meta_description;
        $updateSeries->seo_meta_keywords = $req->seo_meta_keywords;
        $updateSeries->related_series = $req->related_series;
        $updateSeries->difficulty = $req->difficulty;
        $updateSeries->save();
        return redirect(route('tutor.sax.series'))->with('Success','Sax Series Updated SuccessFully');
    }

    public function saxSeriesDelete(Request $req)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $series = SaxSeries::find($req->id);
            if($series){
                $series->delete();
                return successResponse('SaxSeries Deleted Success');  
            }
            return errorResponse('Invalid SaxSeries Id');
        }
        return errorResponse($validator->errors()->first());
    }


     /****************************** Sax Series Lession *******************************/
     public function saxSeriesLessionView(Request $req,$seriesId)
     {
         
         $user = auth()->user();
         $saxSeries = SaxSeries::where('id',$seriesId)->where('createdBy',$user->id)->first();
        //  print_r($saxSeries);exit;
         return view('tutor.saxSeries.lession.index',compact('saxSeries'));
     }
 
     public function saxSeriesLessionCreate(Request $req,$seriesId)
     {
         $user = auth()->user();
         $saxSeries = SaxSeries::where('id',$seriesId)->where('createdBy',$user->id)->first();
         return view('tutor.saxSeries.lession.create',compact('saxSeries'));
     }
 
     public function saxSeriesLessionSave(Request $req,$seriesId)
     {
         $req->validate([
             'saxSeriesId' => 'required|min:1|numeric|in:'.$seriesId,
             'title' => 'required|string|max:200',
             'price' => 'required|numeric|min:1',
             'description' => 'required|string',
             'image' => 'required|image',
             'media_link' => 'required|url',
             'gbp' => 'required|numeric|min:1',
             'usd' => 'required|numeric|min:1',
             'euro' => 'required|numeric|min:1',
             'keywords' => 'required|string',
             'genre' => 'required',
             'product_code' => 'required|string',
             'item_clean_url' => 'required|url',
             'status' => 'required',
         ]);
        
         $series = SaxSeries::where('id',$seriesId)->first();
         $newLession = new SaxLession();
             $newLession->categoryId = $series->categoryId;
             $newLession->saxSeriesId = $series->id;
             $newLession->title = $req->title;
             if($req->hasFile('image')){
                 $image = $req->file('image');
                 $newLession->image = imageUpload($image,'sax/lession');
             }
             $newLession->currencyId = 3;
             $newLession->price = $req->price;
             $newLession->video_url = $req->media_link;
             $newLession->gbp = $req->gbp;
             $newLession->usd = $req->usd;
             $newLession->euro = $req->euro;
             $newLession->keywords = $req->keywords;
             $newLession->genre = $req->genre;
             $newLession->product_code = $req->product_code;
             $newLession->status = $req->status;
            $newLession->description = $req->description;
            $newLession->item_clean_url = $req->item_clean_url;
            $newLession->createdBy = auth()->user()->id;
        $newLession->save();
        return redirect(route('tutor.sax.series.lession',$seriesId))->with('Success','Sax Lession Added SuccessFully');
    }

    public function saxSeriesLessionEdit(Request $req,$seriesId,$lessionId)
    {
        $user = auth()->user();
        $saxLession = SaxLession::where('id',$lessionId)->where('saxSeriesId',$seriesId)->where('createdBy',$user->id)->first();
        return view('tutor.saxSeries.lession.edit',compact('saxLession'));
    }

    public function saxSeriesLessionUpdate(Request $req,$seriesId,$lessionId)
    {
        $req->validate([
            'saxSeriesId' => 'required|min:1|numeric|in:'.$seriesId,
            'saxLessionId' => 'required|min:1|numeric|in:'.$lessionId,
            'title' => 'required|string|max:200',
            'price' => 'required|numeric|min:1',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'media_link' => 'required|url',
            'gbp' => 'required|numeric|min:1',
            'usd' => 'required|numeric|min:1',
            'euro' => 'required|numeric|min:1',
            'keywords' => 'required',
            'item_clean_url' => 'required|url',
            'status' => 'required',
            'genre' => 'required',
        ]);
            
        $updateLession = SaxLession::where('id',$lessionId)->where('saxSeriesId',$seriesId)->first();
            $updateLession->title = $req->title;
            if($req->hasFile('image')){
                $image = $req->file('image');
                $updateLession->image = imageUpload($image,'sax/lession');
            }
            $updateLession->price = $req->price;
            $updateLession->description = $req->description;
            $updateLession->video_url = $req->media_link;
            $updateLession->gbp = $req->gbp;
            $updateLession->usd = $req->usd;
            $updateLession->euro = $req->euro;
            $updateLession->keywords = $req->keywords;
            $updateLession->genre = $req->genre;
            $updateLession->product_code = $req->product_code;
            $updateLession->item_clean_url = $req->item_clean_url;
            $updateLession->status = $req->status;
        $updateLession->save();
        return redirect(route('tutor.sax.series.lession',$seriesId))->with('Success','Sax Lession Updated SuccessFully');
    }

    public function saxSeriesLessionDelete(Request $req)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $lession = SaxLession::find($req->id);
            if($lession){
                $lession->delete();
                return successResponse('Sax Lession Deleted Success');
            }
            return errorResponse('Invalid Sax Lession Id');
        }
        return errorResponse($validator->errors()->first());
    }

}
