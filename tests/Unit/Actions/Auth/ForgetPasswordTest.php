<?php

namespace Tests\Unit\Actions\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Actions\Auth\ForgotPasswordAction;


class ForgetPasswordTest extends TestCase
{
    use WithFaker;

    private $newInstanceOfClass;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->newInstanceOfClass = new ForgotPasswordAction($this->request());
    }

    /**
     * Execute method test for forget password action
     *
     * @return void
     */
    public function testExecuteMethodOfPasswordResetActionShouldWork()
    {
        $this->assertIsObject($this->newInstanceOfClass->execute($this->request()));
    }

    /**
     * @return ForgotPasswordRequest
     */
    private function request(): ForgotPasswordRequest
    {
        $request = new ForgotPasswordRequest();

        $email = User::factory()->create()->email;

        $request->merge([
            'email' =>  $email,
        ]);

        return $request;
    }
}
