<?php


namespace App\Contracts;


interface UserServiceInterface
{
    /**
     * @param $userData
     * @return mixed
     */
    public function create($userData);

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function find($attribute,$value);

    /**
     * @param $id
     * @return mixed
     */
    public function follow($id);

    /**
     * @return mixed
     */
    public function getUserTimeLine();


}
