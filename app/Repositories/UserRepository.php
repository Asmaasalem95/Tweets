<?php


namespace App\Repositories;


use App\Contracts\UserRepositoryInterface;
use App\Models\Tweet;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected $model;

    protected $tweetModel;

    /**
     * UserRepository constructor.
     * @param User $user
     * @param Tweet $tweet
     */
    public function __construct(User $user , Tweet $tweet)
    {
        $this->model = $user;
        $this->tweetModel = $tweet;
    }

    /**
     * @param $userData
     * @return mixed
     */
    public function store($userData)
    {
        // TODO: Implement store() method.
        return $this->model->create($userData);
    }

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findBy($attribute, $value)
    {
        // TODO: Implement findBy() method.
        return $this->model->where($attribute, $value)->first();
    }

    /**
     * @param User $follower
     * @param $following_id
     * @return bool
     */
    public function followUser(User $follower, $following_id)
    {
        // TODO: Implement followUser() method.

        //check if already followed
        $isFollowed = $this->CheckIfTargetFollowerAlreadyFollowed($follower, $following_id);
        if ($isFollowed) {
            $follower->followers()->attach($follower->id, ['user_id' => $following_id, 'follower_id' => $follower->id]);
            return true;
        } else return false;

    }

    /**
     * @param $follower
     * @param $following_id
     * @return bool
     */
    public function CheckIfTargetFollowerAlreadyFollowed($follower, $following_id)
    {
        $following = $follower->with(['following' => function ($query) use ($following_id) {
            $query->where('user_id', $following_id);
        }])->first();

        if ($following->following->count() > 0) {
            return false;
        } else return true;

    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getFollowerTweets(User $user)
    {
       $followingsIds = $user->following->pluck('id');
      return  $this->tweetModel->whereIn('user_id',$followingsIds)->orderBy('created_at', 'desc')->simplePaginate();
    }

}
