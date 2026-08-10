<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_guest_cannot_open_create_task_page(): void
    {
        $response = $this->get(route('tasks.create'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_open_create_task_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
        ->get(route('tasks.create'));

        $response->assertOk(); // = 200
    }

    public function test_authenticated_user_can_create_task(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('tasks.store'), [
             'name' => 'new_task',
             'description' => 'new_description',
             'status_id' => $taskStatus->id,
         ]);

         $response->assertRedirect(route('tasks.index'));

         $this->assertDatabaseHas('tasks', [
             'name' => 'new_task',
             'description' => 'new_description',
             'status_id' => $taskStatus->id,
        ]);
    }

    public function test_task_name_is_required(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('tasks.store'), [
              'name' => '',
              'description' => 'new_description',
              'status_id' => $taskStatus->id,
        ]);

        $response->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('tasks', [
            'description' => 'new_description',
            'status_id' => $taskStatus->id,
       ]);
    }

    public function test_authenticated_user_can_update_task(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $task = Task::factory()->create([
            'name' => 'old_task',
            'description' => 'old_description',
            'status_id' => $taskStatus->id,
        ]);

        $response = $this->actingAs($user)
            ->put(route('tasks.update', $task), [
                'name' => 'updated_task',
                'description' => 'updated_description',
                'status_id' => $taskStatus->id,
            ]);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'updated_task',
            'description' => 'updated_description',
            'status_id' => $taskStatus->id,
        ]);
    }

    public function test_authenticated_user_can_delete_task(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $task = Task::factory()->create([
            'name' => 'to_delete',
            'description' => 'to_delete_description',
            'status_id' => $taskStatus->id,
        ]);

        $response = $this->actingAs($user)
            ->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));

         $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_only_creator_can_delete_task(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $task = Task::factory()->create([
            'name' => 'to_delete',
            'description' => 'to_delete_description',
            'status_id' => $taskStatus->id,
            'created_by_id' => $user1->id,
        ]);

        $response = $this->actingAs($user2)
            ->delete(route('tasks.destroy', $task));

        $response->assertStatus(403); // Forbidden

         $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
        ]);
    }
}
