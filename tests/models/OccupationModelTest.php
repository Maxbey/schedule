<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OccupationModelTest extends TestCase
{
    use \App\Tests\RelationsTestHelpers;

    public function testModelCreation()
    {
        $occupation = factory(App\Entities\Occupation::class)->create();

        $this->seeInDatabase('occupations', ['id' => $occupation->id]);
    }

    public function testRelationsWithTeachers()
    {
        $this->checkBelongsToManyRelation(App\Entities\Occupation::class, App\Entities\Teacher::class, 'teachers');
    }

    public function testRelationsWithTroop()
    {
        $this->checkBelongsToRelation(App\Entities\Occupation::class, App\Entities\Troop::class, 'troop');
    }

    public function testRelationsWithTheme()
    {
        $this->checkBelongsToRelation(App\Entities\Occupation::class, App\Entities\Theme::class, 'theme');
    }

    public function testRelationsWithAudiences()
    {
        $this->checkBelongsToManyRelation(App\Entities\Occupation::class, App\Entities\Audience::class, 'audiences');
    }
}
