<?php

namespace Tests\Unit\File;

use Tests\TestCase;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileDonwloadTest extends TestCase
{

    /**
     * User can download an existin file
     *
     * @return void
     */
    public function test_user_can_download_file()
    {
        Storage::disk('pet_shop');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $uploadFile = File::factory()->create()->toArray();
        $uploadFile['file'] = $file;
        $upload = $this->actingAsAdmin()->postJson(
            '/api/v1/file/upload',
            $uploadFile
        );

        $uuid = $upload['data']['uuid'];

        $response =  $this->getJson('/api/v1/file/' . $uuid);

        $response->assertStatus(200);
    }
}
