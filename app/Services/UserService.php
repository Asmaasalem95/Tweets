<?php


namespace App\Services;


use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Traits\CommonMethods;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    use CommonMethods;
    /**
     * @var UserRepositoryInterface
     */
    protected $repository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * @param $userData
     * @return mixed
     */
    public function create($userData)
    {
        // TODO: Implement create() method.
        return $this->repository->store($userData);

    }

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function find($attribute,$value)
    {
        return $this->repository->findBy($attribute,$value);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function follow($id)
    {
        // TODO: Implement follow() method.
        $follower = Auth::user();
        return  $this->repository->followUser($follower,$id);
    }


}
