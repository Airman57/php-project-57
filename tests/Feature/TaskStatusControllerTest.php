<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\Task;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_open_create_taskstatus_page(): void
    {
        $response = $this->get(route('task_statuses.create'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_open_create_taskstatus_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
        ->get(route('task_statuses.create'));

        $response->assertOk(); // = 200
    }

    public function test_authenticated_user_can_create_task_status(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('task_statuses.store'), [
             'name' => 'new_status',
         ]);

         $response->assertRedirect(route('task_statuses.index'));

         $this->assertDatabaseHas('task_statuses', [
             'name' => 'new_status',
        ]);
    }

    public function test_task_status_name_is_required(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('task_statuses.store'), [
              'name' => '',
        ]);

        $response->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('task_statuses', [
             'name' => '',
        ]);
    }
    public function test_authenticated_user_can_delete_task_status(): void
    {
        $user = User::factory()->create();

         $status = TaskStatus::factory()->create([
            'name' => 'to_delete',
        ]);

        $response = $this->actingAs($user)
            ->delete(route('task_statuses.destroy', $status));

        $response->assertRedirect(route('task_statuses.index'));

         $this->assertDatabaseMissing('task_statuses', [
            'id' => $status->id,
        ]);
    }

    public function test_authenticated_user_can_update_task_status(): void
    {
        $user = User::factory()->create();

         $status = TaskStatus::factory()->create([
            'name' => 'old_name',
        ]);

         $response = $this->actingAs($user)
            ->put(route('task_statuses.update', $status), [
                'name' => 'updated_name',
        ]);

        $response->assertRedirect(route('task_statuses.index'));

         $this->assertDatabaseHas('task_statuses', [
             'id' => $status->id,
             'name' => 'updated_name',
        ]);
    }

    public function test_cannot_delete_task_status_with_associated_tasks(): void
    {
        $user = User::factory()->create();

        $status = TaskStatus::factory()->create([
            'name' => 'status_with_tasks',
        ]);

        // Create a task associated with the status
        Task::factory()->create([
            'status_id' => $status->id,
            'created_by_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
            ->delete(route('task_statuses.destroy', $status));

        $response->assertRedirect(route('task_statuses.index'));
        $response->assertSessionHas('error', __('task_statuses.delete_failed'));

        // Ensure the status still exists in the database
        $this->assertDatabaseHas('task_statuses', [
            'id' => $status->id,
            'name' => 'status_with_tasks',
        ]);
    }
}
