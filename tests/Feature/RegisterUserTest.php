<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class RegisterUserTest extends ApiAuthTestCase
{
    /**
     * @test
     */
    function user_can_not_register_without_email()
    {
        $response = $this->register([
            'name' => 'test name',
            'password' => '12345678',
            'image' => UploadedFile::fake()->image('avatar.jpg')

        ]);
        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(['status' => "Invalid inputs!"]);
    }

    /**
     * @test
     */
    function user_can_not_register_without_name()
    {
        $response = $this->register([
            'email' => 'email@test.com',
            'password' => '12345678',
            'image' => UploadedFile::fake()->image('avatar.jpg')

        ]);
        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(['status' => "Invalid inputs!"]);
    }

    /**
     * @test
     */
    function user_can_not_register_without_password()
    {
        $response = $this->register([
            'name' => 'test name',
            'email' => 'email@test.com',
            'image' => UploadedFile::fake()->image('avatar.jpg')
        ]);
        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(['status' => "Invalid inputs!"]);
    }


    /**
     * @test
     */
    function user_can_not_register_without_image()
    {
        $response = $this->register([
            'name' => 'test name',
            'email' => 'email@test.com',
        ]);
        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(['status' => "Invalid inputs!"]);
    }

    /**
     * @test
     */
    function can_register()
    {
        $response = $this->register([
            'name' => 'John',
            'email' => $this->validEmail,
            'password' => $this->validPassword,
            'image' => UploadedFile::fake()->image('avatar.jpg')]);
        $response->assertStatus(JsonResponse::HTTP_OK);
        $response->assertJson(['status' => "Success"]);
        $this->assertSame($this->validEmail, $response['response']['email']);
    }


    public function register($params)
    {
        return $this->json('POST', $this->registerRoute, $params);
    }


}
