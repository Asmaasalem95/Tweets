<?php


namespace App\Repositories;


use App\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    protected $model;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
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
        return $this->model->where($attribute,$value)->first();
    }

}
