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
                   'status' => __('messages.success'),
                   'response' =>  __('messages.user_followed'),
               ])->setStatusCode(Response::HTTP_OK);
           }
           else {
               return response()->json([
                   'status' => __('messages.failed'),
                   'response' => __('messages.user_already_followed'),
               ])->setStatusCode(Response::HTTP_OK);
           }

        } catch (\Exception $exception) {
            return response()->json([
                'status' => __('messages.failed'),
                'response' => $exception->getMessage(),
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }

    public function getTimeline()
    {
        try {
            $tweets = $this->service->getUserTimeLine();
            return response()->json([
                'status' => __('messages.success'),
                'response' => $tweets,
            ])->setStatusCode(Response::HTTP_OK);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => __('messages.failed'),
                'response' => $exception->getMessage(),
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }
}
