<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpecialtyModelTest extends TestCase
{
    use \App\Tests\RelationsTestHelpers;

    public function testModelCreation()
    {
        $specialty = factory(App\Entities\Specialty::class)->create();

        $this->seeInDatabase('specialties', ['id' => $specialty->id]);
    }

    public function testRelationsWithTroop()
    {
        $this->checkHasManyRelation(App\Entities\Specialty::class, App\Entities\Troop::class, 'troops');
    }

    public function testRelationsWithDiscipline()
    {
        $this->checkBelongsToManyRelation(App\Entities\Specialty::class, App\Entities\Discipline::class, 'disciplines');
    }


}
