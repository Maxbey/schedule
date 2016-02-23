<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThemeModelTest extends TestCase
{
    use DatabaseMigrations;
    use \App\Tests\RelationsTestHelpers;

    public function testModelCreation()
    {
        $theme = factory(App\Entities\Theme::class)->create();

        $this->seeInDatabase('themes', ['id' => $theme->id]);
    }

    public function testRelationsWithDiscipline()
    {
        $this->checkBelongsToRelation(App\Entities\Theme::class, App\Entities\Discipline::class, 'discipline');
    }

    public function testRelationsWithOccupation()
    {
        $this->checkHasManyRelation(App\Entities\Theme::class, App\Entities\Occupation::class, 'occupations');
    }

    public function testRelationsWithTeacher()
    {
        $this->checkBelongsToManyRelation(App\Entities\Theme::class, App\Entities\Teacher::class, 'teachers');
    }

    public function testRelationsWithAudience()
    {
        $this->checkBelongsToManyRelation(App\Entities\Theme::class, App\Entities\Audience::class, 'audiences');
    }
}
