<?php

namespace Tests\Unit;

use App\Models\Tasks;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testGetTasks()
    {
        $tasks = Tasks::factory()->create(['title' => 'Test task 1']);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Test task 1');
    }

    public function testStoreTask()
    {
        $response = $this->post('/tasks', ['title' => 'New Task']);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertCount(1, Tasks::all());
    }

    public function testDeleteTask()
    {
        $task = Tasks::factory()->create(['title' => 'Test task 1']);

        $response = $this->delete('/tasks/'.$task->id);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertCount(0, Tasks::all());
    }
}


