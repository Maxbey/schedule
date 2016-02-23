<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DisciplineModelTest extends TestCase
{
    use DatabaseMigrations;
    use \App\Tests\RelationsTestHelpers;

    public function testModelCreation()
    {
        $discipline = factory(App\Entities\Discipline::class)->create();

        $this->seeInDatabase('disciplines', ['id' => $discipline->id]);
    }

    public function testRelationsWithTheme()
    {
        $this->checkHasManyRelation(App\Entities\Discipline::class, App\Entities\Theme::class, 'themes');
    }

    public function testRelationsWithSpecialty()
    {
        $this->checkBelongsToManyRelation(App\Entities\Discipline::class, App\Entities\Specialty::class, 'specialties');
    }

    public function testRelationsWithOccupation()
    {
        $this->checkHasManyRelation(App\Entities\Discipline::class, App\Entities\Occupation::class, 'occupations');
    }
}
