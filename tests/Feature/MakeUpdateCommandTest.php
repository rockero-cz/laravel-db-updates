<?php

it('creates_db_update_file', function () {
    $updateName = 'split_user_full_name';
    $fileName = date('Y_m_d_His').'_'.$updateName.'.php';

    $this->artisan('make:update', ['name' => $updateName])
        ->expectsOutputToContain($fileName)
        ->assertExitCode(0);

    $this->assertFileExists(database_path('updates/'.$fileName));
});
