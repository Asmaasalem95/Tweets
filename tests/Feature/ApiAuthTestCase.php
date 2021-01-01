<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiAuthTestCase extends TestCase
{
    use RefreshDatabase;

    protected $invalidEmail = 'invalid@example.com';

    protected $invalidPassword = 'invalid';

    protected $loginRoute;

    protected $registerRoute;

    protected $resendVerificationEmailRoute;

    protected $validEmail = 'john@example.com';

    protected $validPassword = 'password123456';

    protected function enableCsrfProtection()
    {
        // csrf is disabled when running tests, but we want to turn it on
        // so our token actually gets verified
        // just needs to be something other than 'testing'
        $this->app['env'] = 'development';
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->loginRoute = route('login');
        $this->registerRoute = route('register');
    }

    protected function createUser()
    {
        return user::factory()->create([
            'email' => $this->validEmail,
            'password' => Hash::make($this->validPassword),
        ]);
    }
}
