<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Tests\Feature\ApiAuthTestCase;

class LoginUserTest extends ApiAuthTestCase
{
    /**
     * @test
     */
    function user_can_not_login_without_email()
    {
        $response = $this->attemptLogin([
            'password' => $this->validPassword
        ]);
        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(['status' => "Invalid inputs!"]);
        $this->assertGuest();
    }

    /**
     * @test
     */
    function user_can_not_login_without_password()
    {
        $response = $this->attemptLogin([
            'email' => $this->validEmail,
        ]);
        $response->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(['status' => "Invalid inputs!"]);
        $this->assertGuest();
    }

    /**
     * @test
     */
    function user_can_not_login_with_invalid_email()
    {
        $response = $this->attemptLogin([
            'email' => $this->invalidEmail,
            'password' => $this->validPassword,
        ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(['status' => "Failed"]);
        $response->assertJson(['response' => "Failed! email not found"]);
        $this->assertGuest();
    }

    /**
     * @test
     */
    function user_can_not_login_with_invalid_password()
    {
        $user = $this->createUser();
        $response = $this->attemptLogin([
            'email' => $this->validEmail,
            'password' => $this->invalidPassword,
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['status' => "Failed"]);
        $response->assertJson(['response' => "Whoops! invalid password"]);
        $this->assertGuest();
    }

    /**
     * @test
     */
    function response_contain_token_when_user_login_successfully()
    {
        $this->enableCsrfProtection();
        $user = $this->createUser();
        $response = $this->attemptLogin([
            'email' => $this->validEmail,
            'password' => $this->validPassword
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['status' => "Success"]);
        $this->assertAuthenticatedAs($user);

    }


    public function attemptLogin($params)
    {
        return $this->json('POST', $this->loginRoute, $params);
    }
}
