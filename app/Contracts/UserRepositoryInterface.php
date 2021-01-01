<?php


namespace App\Contracts;


use App\Models\User;

interface UserRepositoryInterface
{

    /**
     * @param $userData
     * @return mixed
     */
    public function store($userData);

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function findBy($attribute,$value);

    /**
     * @param User $follower
     * @param $following_id
     * @return mixed
     */
    public function followUser(User $follower,$following_id);

    /**
     * @param $follower
     * @param $following_id
     * @return mixed
     */
    public function CheckIfTargetFollowerAlreadyFollowed($follower , $following_id);

    /**
     * @param User $user
     * @return mixed
     */
    public function getFollowerTweets(User $user);


}
