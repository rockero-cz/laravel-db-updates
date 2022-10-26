<?php

use Illuminate\Support\Facades\DB;

return new class
{
    public function __invoke()
    {
        DB::table('names')->get()->each(function($item) {
            [$firstName, $lastName] = explode(' ', $item->full_name);

            DB::table('names')->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
            ]);
        });
    }
};
