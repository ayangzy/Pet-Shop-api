<?php

namespace Tests\Unit\Actions\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Actions\Auth\LoginAction;
use Illuminate\Foundation\Testing\WithFaker;

class LoginTest extends TestCase
{
    use WithFaker;

    private $newInstanceOfClass;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->newInstanceOfClass = new LoginAction($this->request());
    }

    /**
     * Execute method test for login Action
     *
     * @return void
     */
    public function testExecuteMethodForLoginShouldWork()
    {
        
        $this->assertIsArray($this->newInstanceOfClass->execute($this->request()));
    }

    /**
     * @return LoginRequest
     */
    private function request(): LoginRequest
    {
        $request = new LoginRequest();

        $email = User::factory()->create()->email;

        $request->merge([
            'email' =>  $email,
            'password' => 'password',
        ]);

        return $request;
    }
}
