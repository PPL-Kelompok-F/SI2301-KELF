<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssignmentRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_can_view_assignments_page(): void
    {
        $teacher = User::factory()->create(['role' => 'teacher']);

        $response = $this->actingAs($teacher)->get('/teacher/assignments');

        $response->assertOk();
        $response->assertViewIs('teacher.assignments.index');
    }

    public function test_student_can_view_assignments_page(): void
    {
        $student = User::factory()->create(['role' => 'student']);

        $response = $this->actingAs($student)->get('/student/assignments');

        $response->assertOk();
        $response->assertViewIs('student.assignments.index');
    }

    public function test_teacher_can_create_assignment(): void
    {
        $teacher = User::factory()->create(['role' => 'teacher']);

        $response = $this->actingAs($teacher)->post('/teacher/assignments', [
            'title' => 'Tugas Laravel',
            'description' => 'Kerjakan dengan baik',
            'deadline' => '2026-06-20 23:59:59',
        ]);

        $response->assertRedirect('/teacher/assignments');
        $this->assertDatabaseHas('assignments', [
            'title' => 'Tugas Laravel',
            'teacher_id' => $teacher->id,
        ]);
    }
}
