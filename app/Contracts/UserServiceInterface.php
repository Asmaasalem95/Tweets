<?php


namespace App\Contracts;


interface UserServiceInterface
{
    public function create($userData);

    public function find($attribute,$value);

    public function follow($id);

}
