<?php


namespace App\Services;


use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Traits\CommonMethods;

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
        $userData['image'] = $this->uploadFile($userData['image'],'users');
        $user = $this->repository->store($userData);
        return $userData;

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


}
