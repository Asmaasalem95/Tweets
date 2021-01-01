<?php


namespace App\Contracts;


interface UserRepositoryInterface
{

    public function store($userData);

    public function findBy($attribute,$value);
}
