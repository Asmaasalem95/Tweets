<?php


namespace App\Repositories;
use App\Contracts\TweetRepositoryInterface;
use App\Models\Tweet;

class TweetRepository implements TweetRepositoryInterface
{

    /**
     * @var Tweet
     */
    protected $model;

    /**
     * TweetRepository constructor.
     * @param Tweet $tweet
     */
    public function __construct(Tweet $tweet)
    {
        $this->model = $tweet;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        // TODO: Implement create() method.
      return $this->model->create($data);

    }

}
