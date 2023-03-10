<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Laravel\Sanctum\PersonalAccessToken;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $status = 200)
    {
    	$response = [
            'success' => true,
            //'data'    => $result,
            'message' => $message,
        ];

        isset($response['data']) ? array_push($response, $result) : $response['data'] = $result;


        return response()->json($response, $status);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $status = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            array_push($response, $errorMessages); //$response['data'] = $errorMessages;
        }


        return response()->json($response, $status);
    }

    public function userToToken(string $key = null) :string|null
    {
        $return = null;
        
        if($token = getallheaders()['Authorization']){
            [$id, $token] = explode('|', $token, 2);
            $token = PersonalAccessToken::findToken($token);
            $return = $key ? $token->tokenable->{$key} : $token->tokenable;
        }

        return $return;

    }
}
