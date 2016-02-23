<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AudienceModelTest extends TestCase
{
    use DatabaseMigrations;
    use \App\Tests\RelationsTestHelpers;

    public function testModelCreation()
    {
        $audience = factory(App\Entities\Audience::class)->create();

        $this->seeInDatabase('audiences', ['id' => $audience->id]);
    }

    public function testRelationsWithTheme()
    {
        $this->checkBelongsToManyRelation(App\Entities\Audience::class, App\Entities\Theme::class, 'themes');
    }

    public function testRelationsWith()
    {
        $this->checkHasManyRelation(App\Entities\Audience::class, App\Entities\Occupation::class, 'occupations');
    }
}
