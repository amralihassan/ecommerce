<?php

namespace App\Http\Controllers\Admin\BackEnd;
use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use File;
use App\Models\BackEnd\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::orderBy('id','desc')->paginate(6);
        return view('layouts.backEnd.offers.index',['title'=>trans('admin.special_offers'),'offers' => $offers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.backEnd.offers.create',['title'=>trans('admin.add_offer')]);
    }
    private function attributes()
    {
        return [
            'title',
            'link',
            'start_offer',
            'status_display',
            'start_display',
            'end_display',
            'admin_id'
        ];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        $request->user()->offers()->create($request->only($this->attributes()) + ['image_offer_name'=>$this->uploadImageOffer()]);
        alert()->success(trans('msg.stored_successfully'), trans('admin.add_offer'));
        return redirect()->route('offers.index');
    }
    private function uploadImageOffer(Offer $offer = null)
    {
        $fileName = '';

        $offerImage = !empty($offer) ? $offer : '';

        if (request()->hasFile('image_offer_name'))
        {
            if (!empty($offerImage)) {
                $image_path = public_path("/images/offers/".$offerImage->image_offer_name);
                // return dd($image_path);
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            $image_offer_name = request('image_offer_name');
            $fileName = time().'-'.$image_offer_name->getClientOriginalName();

            $location = public_path('images/offers');

            $image_offer_name->move($location,$fileName);
            $data['image_offer_name'] = $fileName;
        }
        return empty($fileName) ? $offerImage->image_offer_name : $fileName ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        return view('layouts.backEnd.offers.edit',['title'=>trans('admin.edit_offer'),'offer'=>$offer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $offer->update($request->only($this->attributes())+ ['image_offer_name'=>$this->uploadImageOffer($offer)]);
        alert()->success(trans('msg.updated_successfully'), trans('admin.edit_offer'));
        return redirect()->route('offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offerImage = Offer::findOrFail($offer->id);
        $image_path = public_path("/images/offers/".$offerImage->image_offer_name);

        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        Offer::destroy($offer->id);
        alert()->success(trans('msg.delete_successfully'), trans('admin.special_offers'));
        return redirect()->route('offers.index');
    }
}
