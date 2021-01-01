<?php


namespace App\Contracts;


use App\Models\User;

interface UserRepositoryInterface
{

    public function store($userData);

    public function findBy($attribute,$value);

    public function followUser(User $follower,$following_id);

    public function CheckIfTargetFollowerAlreadyFollowed($follower , $following_id);

}
