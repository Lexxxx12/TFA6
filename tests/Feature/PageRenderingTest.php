<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PageRenderingTest extends TestCase
{
    use LazilyRefreshDatabase;

    #[DataProvider('pageProvider')]
    public function test_each_required_page_renders_successfully(string $routeName, string $heading): void
    {
        $response = $this->get(route($routeName));

        $response->assertOk();
        $response->assertSee($heading);
        $response->assertSee('SariPOS');
    }

    public function test_customer_page_renders_every_seeded_customer_record(): void
    {
        $this->seed();

        $response = $this->get(route('customers.index'));

        $response->assertOk();
        $response->assertSeeTextInOrder([
            'Maya Santos',
            'Carlo Reyes',
            'Alyssa Lim',
            'Nathan Cruz',
            'Bianca Flores',
            'Luis Mendoza',
        ]);
    }

    public function test_user_page_renders_every_seeded_user_record(): void
    {
        $this->seed();

        $response = $this->get(route('users.index'));

        $response->assertOk();
        $response->assertSeeTextInOrder([
            'Mia Villanueva',
            'Jules Navarro',
            'Ren Garcia',
            'Sam Dela Cruz',
            'Toni Aquino',
            'Lei Ramos',
        ]);
    }

    public static function pageProvider(): array
    {
        return [
            'landing page' => ['home', 'Your store organized in one place.'],
            'about page' => ['about', 'A Laravel foundation for a clearer checkout workspace.'],
            'customer accounts page' => ['customers.index', 'Customer Accounts'],
            'user accounts page' => ['users.index', 'User Accounts'],
        ];
    }
}
