<?php

namespace App\Http\Controllers\Back_End;

use App\Helpers\Helper;
use App\Models\Airline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AirlineFlightController extends Controller
{
    public function airlines_index(){
        $airlines = Airline::with('flights')->get();

        return view('Back_End.pages.flights.airlines.airlines_index',compact('airlines'));
    }
    public function airlines_add(){

        return view('Back_End.pages.flights.airlines.airlines_add');
    }
    public function airlines_add_post(Request $request){

        $data = $request->all();
        //save single image
        $validation = Validator::make(
            $data,
            [
                'airline_name' => 'required',

            ]
        );
        if ($validation->fails()) {
            session()->flash('errors', $validation);
            return back();
        }
        $airline_logo = Helper::SaveSingleImage('airline_logo', $data['airline_logo']);
        $airline = new Airline();
        $airline->airline_name = $data['airline_name'];
        $airline->number_of_chairs = $data['number_of_chairs'];
        $airline->airline_logo = $airline_logo;
        $airline->airline_status = $data['airline_status'];
        if ($airline->save()) {
            session()->flash('success', 'Your Airline has been added successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Sorry your Airline data has error !!!!!');
            return back();
        }
    }

    public function airlines_edit($id){
        $airline = Airline::find($id);
        return view('Back_End.pages.flights.airlines.airlines_edit',compact('airline'));

    }

    public function airlines_update_package(Request $request,$id){

        $data = $request->all();
        //save single image
        $validation = Validator::make(
            $data,
            [
                'airline_name' => 'required',

            ]
        );

        if ($validation->fails()) {
            session()->flash('errors', $validation);
            return back();
        }
          // cover image updates
          if (empty($data['airline_logo']) || $data['airline_logo'] == null) {
            $airline_logo = $data['old_airline_logo'];
        } else {
            $airline_logo = Helper::SaveSingleImage('airline_logo', $data['airline_logo']);
        }
       Airline::where('id', $id)->update([
            'airline_name' => $data['airline_name'],
            'number_of_chairs' => $data['number_of_chairs'],
            'airline_logo' => $airline_logo,
            'airline_status' => $data['airline_status'],
        ]);
        session()->flash('success', 'Your Airline has been added successfully !!!!!');
        return back();
    }

    public function airlines_delete($id)
    {
        $airline = Airline::find($id);
        if ($airline) {
            Airline::where('id', $id)->delete();
            session()->flash('success', 'Your package has been deleted successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Your package is not found');
            return back();
        }
    }

}
