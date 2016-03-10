<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeacherModelTest extends TestCase
{
    use \App\Tests\RelationsTestHelpers;

    public function testModelCreation()
    {
        $teacher = factory(App\Entities\Teacher::class)->create();

        $this->seeInDatabase('teachers', ['id' => $teacher->id]);
    }

    public function testRelationsWithTheme()
    {
        $this->checkBelongsToManyRelation(App\Entities\Teacher::class, App\Entities\Theme::class, 'themes');
    }

    public function testRelationsWithOccupation()
    {
        $this->checkBelongsToManyRelation(App\Entities\Teacher::class, App\Entities\Occupation::class, 'occupations');
    }
}
