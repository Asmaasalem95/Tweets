<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    protected $service;

    /**
     * UserController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->service = $userService;
    }

    /**
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function followUser($user_id)
    {
        try {
           $userFollowed =  $this->service->follow($user_id);
           if ($userFollowed)
           {
               return response()->json([
                   'status' => 'Success',
                   'response' => 'User Followed Successfully',
               ])->setStatusCode(Response::HTTP_OK);
           }
           else {
               return response()->json([
                   'status' => 'Failed',
                   'response' => 'User already Followed',
               ])->setStatusCode(Response::HTTP_OK);
           }

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'Failed',
                'response' => $exception->getMessage(),
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }
}
