<?php

namespace Tests\Browser;

use Baucells\Items\Models\Item;
use Faker\Factory;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ItemsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function create_url_show_a_form()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/items_per_borrar/create')
                ->assertSee('Create Item')
                ->assertVisible('input#name')
                ->assertVisible('textarea#description')
                ->assertInputValue('input#name', '')
                ->assertInputValue('textarea#description', '');
        });
    }

    /**
     * @group caca
     * @test
     */
    public function edit_url_show_a_form_with_correct_values()
    {
        $item = factory(Item::class)->create();

        $this->browse(function (Browser $browser) use ($item) {
//            $item = factory(Item::class)->create();

            $browser->visit('/items_per_borrar/edit/' . $item->id)
                ->pause(5000)
                ->assertSee('Edit Item')
                ->assertVisible('input#name')
                ->assertVisible('textarea#description')
                ->assertInputValue('input#name', $item->name)
                ->assertInputValue('textarea#description', $item->description);
        });
    }

    /**
     * @test
     */
    public function an_user_can_create_an_item()
    {
        $faker = Factory::create();
        $this->browse(function (Browser $browser) use ($faker) {
            $browser->visit('/items_per_borrar/create')
                ->type('name', $faker->sentence)
                ->type('description', $faker->paragraph)
                ->press('Create')
                ->assertSee('Created ok');
        });
    }

    /**
     * @group caca
     * @test
     */
    public function an_user_can_edit_an_item()
    {
        $item = factory(Item::class)->create();
        $faker = Factory::create();
        $this->browse(function (Browser $browser) use ($faker, $item) {
            $browser->visit('/items_per_borrar/edit/' . $item->id)
                ->type('name', $faker->sentence)
                ->type('description', $faker->paragraph)
                ->press('Update')
                ->assertSee('Edited ok');
        });
    }
}
