<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Center;
use App\Http\Requests\SaveCenterRequest;


class CenterController extends Controller{

    //mostro elenco centri
    public function show(){

        $centers = Center::with([
            'region:id,name',
            'province:id,name,code',
            'city:id,name'
        ])->orderBy('name')->get();
        
        return view('pages.where', compact('centers')); //passo i centri alla vista
    }


    public function create(){

        $regions = Region::orderBy('name')->get();
        $provinces = Province::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        return view('pages.admin.centers.createCenter', compact('regions','provinces','cities'));
    }

    public function store(SaveCenterRequest $request){

        $data = $request->validated();
        Center::create($data);

        return redirect()->route('where')->with('success','Centro creato correttamente');        
    }

    public function edit(Center $center){
        
        $regions = Region::orderBy('name')->get();
        $provinces = Province::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        return view('pages.admin.centers.editCenter', compact('center', 'regions','provinces','cities'));
    }

    public function update(SaveCenterRequest $request, Center $center){
        
        $data = $request->validated();
        $center->update($data);

        return redirect()->route('where')->with('success','Centro modificato');
    }


    public function deleteConfirm(Center $center){
        return view('pages.admin.centers.deleteCenter', compact('center'));
    }


    public function delete(Center $center): RedirectResponse
    {
        DB::transaction(function () use ($center) {

            $center->delete();
        });

        return redirect()->route('where')->with('success', 'Centro eliminato.');
    }
}