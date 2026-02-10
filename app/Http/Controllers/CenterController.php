<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Models\Center;

class CenterController extends Controller{

    //mostro elenco centri
    public function show(){

        $user = request()->user();
        $role = $user?->role;
        $isAdmin = ($role === 'admin');
    

        $centers = Center::with([
                                                'region:id,name',
                                                'province:id,name,code',
                                                'city:id,name'
                                            ])->orderBy('name')->get();
        
        return view('pages.where', compact('centers', 'isAdmin')); //passo i centri e isAdmin alla vista
    }


    public function create(){

        $regions = Region::orderBy('name')->get();
        $provinces = Province::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        return view('pages.admin.centers.createCenter', compact('regions','provinces','cities'));
    }

    public function store(Request $request){

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => [
                    'required',
                    'regex:/^\+?[0-9]{8,15}$/',
                    Rule::unique('centers', 'phone'),
                ],
            'email' => ['required','email','max:255','unique:centers,email'],
            'region_id' => ['required', 'exists:regions,id'],
            'province_id' => [
                'required',
                Rule::exists('provinces','id')->where(fn($q) => $q->where('region_id', $request->region_id)),
            ],
            'city_id' => [
                'required',
                Rule::exists('cities','id')->where(fn($q) => $q->where('province_id', $request->province_id)),
            ],

            'street' => 'required|string|max:160',
            'civic' => 'nullable|string|max:20',
            ]);;

        Center::create($data);

        return redirect()->route('where')->with('success','Centro creato');        
    }

    public function edit(Center $center){
        
        $regions = Region::orderBy('name')->get();
        $provinces = Province::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        return view('pages.admin.centers.editCenter', compact('center', 'regions','provinces','cities'));
    }

    public function update(Request $request, Center $center){
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'phone' => [
                    'required',
                    'regex:/^\+?[0-9]{8,15}$/',
                    Rule::unique('centers', 'phone')->ignore($center->id),
                ],
            'email' => [
            'required','email','max:255',
                Rule::unique('centers', 'email')->ignore($center->id),
            ],

            'region_id' => ['required', 'exists:regions,id'],
            'province_id' => [
                'required',
                Rule::exists('provinces','id')->where(fn($q) => $q->where('region_id', $request->region_id)),
            ],
            'city_id' => [
                'required',
                Rule::exists('cities','id')->where(fn($q) => $q->where('province_id', $request->province_id)),
            ],

            'street' => 'required|string|max:160',
            'civic' => 'nullable|string|max:20',
            ]);

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