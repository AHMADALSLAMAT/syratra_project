<?php

namespace App\Http\Controllers\Back_End;

use App\Models\Airport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AirportController extends Controller
{
    public function airports_index(){
        $airports = Airport::get();
        return view('Back_End.pages.flights.airports.airports_index',compact('airports'));
    }
    public function airports_add(){
        return view('Back_End.pages.flights.airports.airports_add');
    }
    public function airports_add_post(Request $request){
        $data = $request->all();
        //save single image
        $validation = Validator::make(
            $data,
            [
                'airport_name' => 'required',
            ]
        );
        if ($validation->fails()) {
            session()->flash('errors', $validation);
            return back();
        }
        $airport = new airport();
        $airport->airport_name = $data['airport_name'];
        $airport->airport_code = $data['number_of_chairs'];
        $airport->airport_country = $data['airport_country'];
        $airport->airport_type = $data['airport_type'];
        $airport->status = $data['status'];
        if ($airport->save()) {
            session()->flash('success', 'Your airport has been added successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Sorry your airport data has error !!!!!');
            return back();
        }
    }

    public function airports_edit($id){
        $airport = Airport::find($id);
        return view('Back_End.pages.flights.airports.airports_edit',compact('airport'));

    }

    public function airports_update_Airport(Request $request,$id){

        $data = $request->all();
        //save single image
        $validation = Validator::make(
            $data,
            [
                'airport_name' => 'required',

            ]
        );

        if ($validation->fails()) {
            session()->flash('errors', $validation);
            return back();
        }

       Airport::where('id', $id)->update([
            'airport_name' => $data['airport_name'],
            'airport_code' => $data['airport_code'],
            'airport_country' => $data['airport_country'],
            'airport_type' => $data['airport_type'],
            'status' => $data['status'],
        ]);
        session()->flash('success', 'Your airport has been added successfully !!!!!');
        return back();
    }

    public function airports_delete($id)
    {
        $airport = Airport::find($id);
        if ($airport) {
            Airport::where('id', $id)->delete();
            session()->flash('success', 'Your Airport has been deleted successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Your Airport is not found');
            return back();
        }
    }
}
