<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class DatabaseDirectoryTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_customer_directory_displays_current_database_values_and_nullable_phone(): void
    {
        $customer = Customer::factory()->create([
            'full_name' => 'Database Customer',
            'email' => 'database.customer@example.com',
            'phone' => null,
        ]);

        $this->get(route('customers.index'))
            ->assertOk()
            ->assertSeeText('Database Customer')
            ->assertSeeText('database.customer@example.com')
            ->assertSeeText('—')
            ->assertSeeText('1 records')
            ->assertDontSeeText('Maya Santos');

        $customer->update(['full_name' => 'Updated Customer']);

        $this->get(route('customers.index'))
            ->assertOk()
            ->assertSeeText('Updated Customer')
            ->assertDontSeeText('Database Customer');
    }

    public function test_user_directory_displays_current_database_values(): void
    {
        $user = User::factory()->create([
            'username' => 'database.staff',
            'full_name' => 'Database Staff',
        ]);

        $this->get(route('users.index'))
            ->assertOk()
            ->assertSeeText('database.staff')
            ->assertSeeText('Database Staff')
            ->assertSeeText('1 records')
            ->assertDontSeeText('admin.mia');

        $user->update(['full_name' => 'Updated Staff']);

        $this->get(route('users.index'))
            ->assertOk()
            ->assertSeeText('Updated Staff')
            ->assertDontSeeText('Database Staff');
    }

    public function test_empty_directories_render_without_errors(): void
    {
        $this->get(route('customers.index'))->assertOk()->assertSeeText('No customers records yet.');
        $this->get(route('users.index'))->assertOk()->assertSeeText('No users records yet.');
    }

    public function test_homepage_counts_follow_the_database(): void
    {
        Customer::factory()->count(2)->create();
        User::factory()->count(3)->create();

        $this->get(route('home'))
            ->assertOk()
            ->assertViewHas('customerCount', 2)
            ->assertViewHas('userCount', 3);
    }

    public function test_seeder_is_repeatable_and_preserves_existing_records_and_creation_dates(): void
    {
        $this->freezeTime();
        $this->seed();

        $customer = Customer::query()->where('email', 'maya.santos@example.com')->firstOrFail();
        $user = User::query()->where('username', 'admin.mia')->firstOrFail();
        $customerCreatedAt = $customer->created_at->toDateTimeString();
        $userCreatedAt = $user->created_at->toDateTimeString();
        $customer->update(['phone' => null]);
        $user->update(['full_name' => 'Edited Staff Name']);

        $this->travel(1)->days();
        $this->seed();

        $this->assertDatabaseCount('customers', 6);
        $this->assertDatabaseCount('users', 6);
        $this->assertNull($customer->fresh()->phone);
        $this->assertSame('Edited Staff Name', $user->fresh()->full_name);
        $this->assertSame($customerCreatedAt, $customer->fresh()->created_at->toDateTimeString());
        $this->assertSame($userCreatedAt, $user->fresh()->created_at->toDateTimeString());
    }

    public function test_duplicate_usernames_are_rejected_by_the_database(): void
    {
        User::factory()->create(['username' => 'same.username']);

        $this->expectException(UniqueConstraintViolationException::class);

        User::factory()->create(['username' => 'same.username']);
    }
}
