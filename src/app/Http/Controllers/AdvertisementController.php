<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdsFormRequest;
use App\Http\Requests\AdsFormUpdateRequest;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Advertisement::where('user_id', auth()->user()->id)->get();
        return view('ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsFormRequest $request)
    {
        $data = $request->all();
        $featureImage = $request->file('feature_image')->store('public/ads');
        $firstImage = $request->file('first_image')->store('public/ads');
        $secondImage = $request->file('second_image')->store('public/ads');
        $data['feature_image'] = $featureImage;
        $data['first_image'] = $firstImage;
        $data['second_image'] = $secondImage;
        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = auth()->user()->id;

        Advertisement::create($data);

        return redirect()->route('ads.index')->with('message', 'Your ad is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = Advertisement::find($id);
        return view('ads.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdsFormUpdateRequest $request, $id)
    {
        $ad = Advertisement::find($id);
        $feartureImage = $ad->feature_image;
        $firstImage = $ad->first_image;
        $secondImage = $ad->second_image;
        $data = $request->all();
        if ($request->hasFile('feature_image')) {
            $feartureImage = $request->file('feature_image')->store('public/ads');
        }
        if ($request->hasFile('first_image')) {
            $firstImage = $request->file('first_image')->store('public/ads');
        }
        if ($request->hasFile('second_image')) {
            $secondImage = $request->file('second_image')->store('public/ads');
        }
        $data['feature_image'] = $feartureImage;
        $data['first_image'] = $firstImage;
        $data['second_image'] = $secondImage;

        $ad->update($data);

        return redirect()->route('ads.index')->with('message', 'Your ad is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
