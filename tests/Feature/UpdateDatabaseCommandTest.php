<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    Schema::create('names', function ($table) {
        $table->temporary();
        $table->string('full_name');
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
    });

    DB::table('names')->insert([
        'full_name' => 'John Doe',
    ]);
});

it('runs_update', function () {
    runUpdates();

    $this->assertDatabaseHas('names', [
        'full_name' => 'John Doe',
        'first_name' => 'John',
        'last_name' => 'Doe',
    ]);
});

it('update_can_run_only_once', function () {
    runUpdates();
    runUpdates();
    $this->assertDatabaseCount('database_updates', 1);
});
