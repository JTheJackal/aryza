<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetBooksTest extends TestCase
{
    /** @test */
    public function books_can_be_found()
    {
        $response = $this->getJson(route('books.index'));

        $this->assertNotEquals(0, count($response->json()));
    }


    /** @test */
    public function books_can_be_found_by_isbn()
    {
        $response = $this->getJson(route('books.index'), ['isbn'=>'0596804848']);

        $response
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('isbn', '0596804848')
                 ->etc()
        );
    }

   
}
