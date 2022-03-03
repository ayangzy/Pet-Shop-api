<?php

namespace Tests\Unit\Actions\Auth;

use Tests\TestCase;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Actions\Auth\RegisterUserAction;

class RegisterUserTest extends TestCase
{
    use WithFaker;

    private $newInstanceOfClass;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->newInstanceOfClass = new RegisterUserAction();
    }

    /**
     * Test if the execute method of CreateNewUserAction runs successfully
     *
     * @return void
     */
    public function testExecuteMethodForCreatingUserAccountShouldRun()
    {
        $data = $this->request();

        $this->assertIsObject($this->newInstanceOfClass->execute($data));
    }

    /**
     * @return RegisterUserRequest
     */
    private function request(): RegisterUserRequest
    {
        $request = new RegisterUserRequest();

        $request->merge([
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'userpassword',
            'address' => $this->faker->address(),
            'phone_number' => '+' . $this->faker->randomDigitNotZero() . $this->faker->numerify('###-###-####'),
            'is_marketing' => '0',
        ]);

        return $request;
    }
}
