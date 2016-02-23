<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OccupationModelTest extends TestCase
{
    use DatabaseMigrations;
    use \App\Tests\RelationsTestHelpers;

    public function testModelCreation()
    {
        $occupation = factory(App\Entities\Occupation::class)->create();

        $this->seeInDatabase('occupations', ['id' => $occupation->id]);
    }

    public function testRelationsWithTeacher()
    {
        $this->checkBelongsToRelation(App\Entities\Occupation::class, App\Entities\Teacher::class, 'teacher');
    }

    public function testRelationsWithTroop()
    {
        $this->checkBelongsToRelation(App\Entities\Occupation::class, App\Entities\Troop::class, 'troop');
    }

    public function testRelationsWithTheme()
    {
        $this->checkBelongsToRelation(App\Entities\Occupation::class, App\Entities\Theme::class, 'theme');
    }

    public function testRelationsWithAudience()
    {
        $this->checkBelongsToRelation(App\Entities\Occupation::class, App\Entities\Audience::class, 'audience');
    }

    public function testRelationsWithDiscipline()
    {
        $this->checkBelongsToRelation(App\Entities\Occupation::class, App\Entities\Discipline::class, 'discipline');
    }
}
