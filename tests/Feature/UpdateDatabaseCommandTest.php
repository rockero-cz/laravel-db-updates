<?php

namespace Rockero\DatabaseUpdates\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Rockero\DatabaseUpdates\Tests\TestCase;

class UpdateDatabaseCommandTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Schema::create('names', function ($table) {
            $table->temporary();
            $table->string('full_name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
        });

        DB::table('names')->insert([
            'full_name' => 'John Doe',
        ]);
    }

    /** @test */
    public function run_update(): void
    {
        $this->runUpdates();

        $this->assertDatabaseHas('names', [
            'full_name' => 'John Doe',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }

    /** @test */
    public function update_can_run_only_once(): void
    {
        $this->runUpdates();
        $this->runUpdates();
        $this->assertDatabaseCount('database_updates', 1);
    }
}
