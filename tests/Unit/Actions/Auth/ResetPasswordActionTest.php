<?php

namespace Tests\Unit\Actions\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Actions\Auth\ResetPasswordAction;

class ResetPasswordActionTest extends TestCase
{
    use WithFaker;

    private $newInstanceOfClass;

    public function setUp(): void
    {
        parent::setUp();
        $this->newInstanceOfClass = new ResetPasswordAction($this->request());
    }

    /**
     * Execute method test.
     *
     * @return void
     */
    public function testExecute()
    {
        $this->assertIsObject($this->newInstanceOfClass->execute($this->request()));
    }

    /**
     * @return ResetPasswordRequest
     */
    private function request(): ResetPasswordRequest
    {
        $request = new ResetPasswordRequest();

        $reset = $this->createToken();

        $request->merge([
            'token' =>  $reset['token'],
            'email' =>  $reset['email'],
        ]);

        return $request;
    }

    /**
     * @return array
     */
    private function createToken(): array
    {
        $token = strtoupper(Str::random(8));
        $email = User::factory()->create()->email;

        PasswordReset::create([
            'email' => $email,
            'token' => $token,
        ]);

        $data = ['email' => $email, 'token' => $token];

        return $data;
    }
}
