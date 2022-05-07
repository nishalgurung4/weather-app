<?php

namespace Tests\Feature\database;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the table columns corresponding to the City model
     *
     * @return void
     */
    public function test_city_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('cities', [
                'id',
                'name',
                'longitude',
                'latitude',
                'created_at',
                'updated_at'
            ])
        );
    }

    public function test_city_has_many_weathers()
    {
        $city = City::factory()->create();
        $weather = Weather::factory()->create(['city_id' => $city->id]);
        // Method 1: the weather exists in the list of city weathers
        $this->assertTrue($city->weathers->contains($weather));
        // Method 2: The number of city weathers is indeed equal to 1 (the dataset provided in this method).
        $this->assertEquals(1, $city->weathers->count());
        // Method 3: The weathers are indeed related to the city and are indeed a collection.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $city->weathers);
        // Method 4: for help: the weathers are linked by the correct relation eloquent.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $city->weathers());
    }
}
