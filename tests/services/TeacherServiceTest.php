<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeacherServiceTest extends ServiceTestCase
{

    protected function service()
    {
        return 'TeacherService';
    }

    public function testCreateMethod()
    {
        $attributes = [
            'name' => 'Name N.N.',
            'work_hours_limit' => 300,
            'military_rank' => 'MRank'
        ];

        $teacher = $this->service->create($attributes);

        $this->seeInDatabase('teachers', ['id' => $teacher->id]);
    }
}
