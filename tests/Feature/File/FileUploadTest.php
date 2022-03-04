<?php

namespace Tests\Feature\File;

use Tests\TestCase;
use App\Models\File;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\AssertableJson;

class FileUploadTest extends TestCase
{
    use WithFaker;
    /**
     * Testing for file uploads.
     *
     * @return void
     */
    public function test_user_can_not_upload_files_without_login()
    {
        Storage::disk('pet_shop');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->postJson('/api/v1/file/upload', [$file]);
        $response->assertStatus(401);
    }

    /** 
     * User can upload file 
     * 
     * @return void
     */
    public function test_user_can_upload_files()
    {
        Storage::disk('pet_shop');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $uploadFile = File::factory()->create()->toArray();
        $uploadFile['file'] = $file;
        $response =  $this->actingAsAdmin()->postJson(
            '/api/v1/file/upload', $uploadFile);

        $response->assertStatus(200);
    }

    /** 
     * User can upload file , without valiudation
     * 
     * @return void
     */

    public function test_user_can_not_upload_file_without_selecting_file()
    {
        Storage::disk('pet_shop');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->asAuthorisedUser()->postJson(
            '/api/v1/file/upload', [])
        ->assertStatus(422)
        ->assertJson(function (AssertableJson $json) {
            $json->has('validationErrors')
                ->has('validationErrors.file')->etc();
        });
    }

    
}
