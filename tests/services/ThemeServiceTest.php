<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThemeServiceTest extends ServiceTestCase
{
    protected function service()
    {
        return 'ThemeService';
    }

    public function testCreateMethod()
    {
        $attributes = [
            'name' => 'Name of theme',
            'number' => '1/1',
            'audiences_count' => 1,
            'teachers_count' => 2,
            'duration' => 2,
            'term' => 2
        ];

        $discipline = factory(App\Entities\Discipline::class)->create();
        $theme = $this->service->create($discipline, $attributes);

        $this->seeInDatabase('themes', ['id' => $theme->id]);
    }

    public function testUpdateMethod()
    {
        $discipline = factory(App\Entities\Discipline::class)->create();
        $theme = factory(App\Entities\Theme::class)->create();

        $this->service->update($theme->id, $discipline, []);

        $this->seeInDatabase('themes', ['discipline_id' => $discipline->id]);
    }

    public function testSyncTeachersMethod()
    {
        $this->syncTest(App\Entities\Theme::class, App\Entities\Teacher::class, 'syncTeachers');
    }

    public function testSyncAudiencesMethod()
    {
        $this->syncTest(App\Entities\Theme::class, App\Entities\Audience::class, 'syncAudiences');
    }
}
