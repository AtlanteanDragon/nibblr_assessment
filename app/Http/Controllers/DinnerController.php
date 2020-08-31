<?php

namespace App\Http\Controllers;
use App\Dinner;
use App\UserDinner;
use Illuminate\Http\Request;

class DinnerController extends Controller
{
    public function list(Request $request){
        $dinners = Dinner::get();
        error_log("loaded dinners");
        $currentDate = date("Y-m-d H:i:s");
        $response = [];
        foreach ($dinners as $key => $dinner) {
            if($dinner->start_date > $currentDate){
                array_push($response, $dinner);
                error_log("dinner pushed");
            } else {
                error_log("dinner too old");
            }
        }
        return response($response,200);
    }
    public function get (Request $request){
        $dinner = Dinner::where('id', $request['id'])->first();
        $guests = UserDinner::where('dinner_id', $request['id'] );

        return response(['dinner' => $dinner, 'guests' => $guests], 200);
    }
    public  function create (Request $request) {

        Dinner::create([
            'user_data_id' => $request->User()->id,
            'max_guests' => $request['max_guests'],
            'start_date' => date("Y-m-d H:i:s", $request['start_date']),
            'duration' => $request['duration'],
            'title' => $request['title'],
            'description' => $request['description'] 
        ]);
        return response(['status' => "success"], 200);
    }
    public function join (Request $request){
        UserDinner::create([
            'user_data_id' => $request->User()->id, 
            'dinner_id'=>$request['dinner_id']
        ]);
        return response(['status' => "success"], 200);
    }
}
