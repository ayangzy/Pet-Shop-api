<?php

namespace Tests\Unit\Actions\User;

use Tests\TestCase;
use App\Models\User;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Actions\User\EditProfileAction;
use Illuminate\Foundation\Testing\WithFaker;

class EditProfileTest extends TestCase
{
    use WithFaker;

    private $newInstanceOfClass;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user =  User::factory()->create();
        $this->newInstanceOfClass = new EditProfileAction($this->request(), $this->user);
    }

    /**
     * Execute method test
     *
     * @return void
     */
    public function testExecuteMethodOfEditProfileActionShouldReturntrue()
    {
        $data = $this->request();
        
        $this->assertTrue($this->newInstanceOfClass->execute($data, $this->user));
    }

    /**
     * @return EditProfileRequest
     */
    private function request(): EditProfileRequest
    {
        $request = new EditProfileRequest();

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
