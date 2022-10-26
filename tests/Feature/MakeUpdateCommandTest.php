<?php

namespace Rockero\DatabaseUpdates\Tests\Feature;

use Rockero\DatabaseUpdates\Tests\TestCase;

class MakeUpdateCommandTest extends TestCase
{
    /** @test */
    public function create_update_file(): void
    {
        $updateName = 'split_user_full_name';
        $fileName = date('Y_m_d_His').'_'.$updateName.'.php';

        $this->artisan('make:update', ['name' => $updateName])
            ->expectsOutputToContain($fileName)
            ->assertExitCode(0);

        $this->assertFileExists(database_path('updates/'.$fileName));
    }
}
