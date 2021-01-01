<?php

namespace App\Http\Controllers\Api;

use App\Contracts\TweetServiceInterface;
use App\Http\Requests\create_tweet_request;
use App\Traits\CommonMethods;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class TweetController extends Controller
{


    use CommonMethods;

    /**
     * @var TweetServiceInterface
     */
    protected $service;

    /**
     * TweetController constructor.
     * @param TweetServiceInterface $tweetService
     */
    public function __construct(TweetServiceInterface $tweetService)
    {
        $this->service = $tweetService;
    }

    /**
     * @param create_tweet_request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(create_tweet_request $request)
    {
        $data = $request->all();

        try {
            if (isset($data['file'])) {
                $data['file'] = $this->uploadFile($data['file'], 'tweets');
            }

            $tweet = $this->service->create($data);
            return response()->json([
                'status' => 'Success',
                'response' => $tweet,
            ])->setStatusCode(Response::HTTP_OK);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'Failed',
                'response' => $exception->getMessage(),
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

    }
}
