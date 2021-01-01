<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\UserServiceInterface;
use App\Http\Requests\login_request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * @var UserServiceInterface
     */
    protected $userService;

    /**
     * LoginController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param login_request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function login(login_request $request) {

        $user = $this->userService->find('email',$request->email);

        if(!$user) {
            return response()->json([
                'status' => __('messages.failed'),
                'response'=> __('messages.email_not_found'),
            ])->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user        =       Auth::user();
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status' =>  __('messages.success'),
                'response'=> ['user'=>$user,'token'=>$tokenResult],
            ])->setStatusCode(Response::HTTP_OK);
        }
        else {
            return response()->json([
                'status' => __('messages.failed'),
                'response'=> __('messages.invalid_password'),
            ])->setStatusCode(Response::HTTP_OK);
        }
    }
}
