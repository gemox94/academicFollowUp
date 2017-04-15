<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Advertisement;

class TeacherController extends Controller
{
    /*
     * Get advertisements for teachers
     */
    public function getAdvertisements($teacher_id, Request $request){
        try{
            $status_code    = 200;
            $advertisements = Advertisement::where('role_id', 1)->get();
            $response       = $advertisements;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }
}
