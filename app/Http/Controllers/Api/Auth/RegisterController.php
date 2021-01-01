<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\UserServiceInterface;
use App\Http\Requests\create_user_request;
use App\Traits\CommonMethods;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    use CommonMethods;
    /**
     * @var UserServiceInterface
     */
    protected $userService;

    /**
     * RegisterController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param create_user_request $request
     * @return JsonResponse|object
     */
    public function register(create_user_request $request)
    {
        try {
            $data = $request->all();
            $data["password"] = Hash::make($request->password);
            $data['image'] = $this->uploadFile($data['image'],'users');

            $user = $this->userService->create($data);
            return response()->json([
                'status' => __('messages.success'),
                'response' => $user,
            ])->setStatusCode(Response::HTTP_OK);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => __('messages.failed'),
                'response' => $exception->getMessage(),
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }


    }
}
