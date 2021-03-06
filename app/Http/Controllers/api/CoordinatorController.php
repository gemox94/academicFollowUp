<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Role;
use App\Subject;
use App\Advertisement;
use App\Period;

class CoordinatorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function create(Request $request){
        try{
            $status_code = 200;
            /*
             * Set this user as coordinator
             * 1) Update password
             * 2) Update role
             */
            $role           = Role::find(1);
            $user           = User::find($request->id);
            $user->password = bcrypt($request->password);
            $user->role()->associate($role);
            $user->save();

            $response = $user;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }


    /*
     * Save advertisement for profesors
     */
    public function getAdvertisements($coordinator_id, Request $request){
        try{
            /*
             * Prepare data
             */
            $status_code    = 200;
            $advertisements = Advertisement::where('role_id', 1)->get();

            /*
             * Response
             */
            $response = $advertisements;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }


    /*
     * Save advertisement for profesors
     */
    public function createAdvertisement($coordinator_id, Request $request){
        try{
            /*
             * Prepare data
             */
            $status_code = 200;

            /*
             * Create advertisement
             * Role 1 - Coordinator
             */
            $advertisement          = new Advertisement;
            $advertisement->title   = $request->advertisement['title'];
            $advertisement->message = $request->advertisement['message'];
            $advertisement->role_id = 1;
            $advertisement->save();

            /*
             * Response
             */
            $response = $advertisement;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }



    /*
     * Edit advertisement
     */
    public function editAdvertisement(Request $request){
        try{
            /*
             * Prepare data
             */
            $status_code = 200;

            /*
             * Create advertisement
             * and associate it with this subject
             */
            $advertisement          = Advertisement::find($request->advertisement['id']);
            $advertisement->title   = $request->advertisement['title'];
            $advertisement->message = $request->advertisement['message'];
            $advertisement->save();

            /*
             * Response
             */
            $response = $advertisement;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }


    /*
     * Delete an advertisement
     */
    public function deleteAdvertisement($coordinator_id, $advertisement_id, Request $request){
        try{
            /*
             * Prepare data
             */
            $status_code   = 200;
            $advertisement = Advertisement::find($advertisement_id);

            /*
             * Delete this advertisement
             */
            $advertisement->delete();

            /*
             * Response
             */
            $response = "ok";

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }


    /**
     * Function to create/add a new Period
     * @return json object
     */

    public function createPeriod(Request $request){
        $status_code = 200;
        $response = [];

        try {

            $coordinator = User::find($request->input('coordinator_id'));

            $current_period = Period::where('status', 'active')->first();

            /**
             * If there is an existent active period, it needs to be inactive
             */
            if($current_period){
                $current_period->status = 'inactive';
                $current_period->save();
            }

            $period = new Period;
            $period->period = $request->input('period');
            $period->status = 'active';
            $period->coordinator()->associate($coordinator);
            $period->save();

            $response['status_code'] = $status_code;
            $response['period'] = $period;

        } catch (\Exception $e) {
            $status_code = 500;
            $response['status_code'] = $status_code;
            $response['error'] = $e;
        }

        return response()->json($response);

    }


    /*
     * Function to get all periods
     * @return json object
     */
    public function getPeriods(){
        $status_code = 200;
        $response    = [];

        try {
            /*
             * Ordering the periods by created_at descendantly (desc)
             */
            $periods                 = Period::orderBy('created_at','desc')->get();
            $response['status_code'] = $status_code;
            $response['periods']     = $periods;

        } catch (\Exception $e) {
            $status_code            = 500;
            $reponse['status_code'] = $status_code;
        }

        return response()->json($response);
    }


    /*
     * Function to get all periods
     * @return json object
     */
    public function getSubjects(){
        $status_code = 200;
        $response    = [];

        try{
            $subjects = Subject::with('period')->get();

            $response = $subjects;

        } catch (\Exception $e) {
            $status_code            = 500;
            $reponse['status_code'] = $status_code;
        }

        return response()->json($response);
    }

}
