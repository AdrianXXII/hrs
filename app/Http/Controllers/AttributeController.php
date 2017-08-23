<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Http\Requests\StoreAttributePostRequest;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $attributes = Attribute::where('active',true)->get();
        return view('backend.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $attribute = null;
        return view('backend.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttributePostRequest $request)
    {
        //
        $attribute = new Attribute();
        $attribute->description = $request->get('description');
        $attribute->hotel_atr = ($request->get('hotel_atr')!=null) ? $request->get('hotel_atr') : 0 ;
        $attribute->active = 1;
        $attribute->save();
        return redirect(route('attributes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
        if(!$attribute->active){
            return redirect(route('attributes.index'));
        }

        return $attribute;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        if(!$attribute->active){
            return redirect(route('attributes.index'));
        }

        return view('backend.attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAttributePostRequest $request, $id)
    {
        //
        $attribute = Attribute::find($id);
        $attribute->description = $request->get('description');
        $attribute->hotel_atr = ($request->get('hotel_atr')!=null) ? $request->get('hotel_atr') : 0 ;
        $attribute->save();
        return redirect(route('attributes.index'));
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
        $attribute = Attribute::find($id);
        $attribute->inactivate();
        return redirect(route('attributes.index'));

    }
}
