<?php


namespace App\Services;


use App\Contracts\TweetRepositoryInterface;
use App\Contracts\TweetServiceInterface;
use Illuminate\Support\Facades\Auth;

class TweetService implements TweetServiceInterface
{

    /**
     * @var TweetRepositoryInterface
     */
    protected $repository;

    /**
     * TweetService constructor.
     * @param TweetRepositoryInterface $tweetRepository
     */
    public function __construct(TweetRepositoryInterface $tweetRepository)
    {
        $this->repository = $tweetRepository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        // TODO: Implement create() method.
        $data['user_id'] = Auth::user()->getAuthIdentifier();
        return $this->repository->create($data);

    }


}
