<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Role;
use App\Advertisement;

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

}
