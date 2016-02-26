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
            'term' => 2
        ];

        $discipline = factory(App\Entities\Discipline::class)->create();
        $theme = $this->service->create($discipline, $attributes);

        $this->seeInDatabase('themes', ['id' => $theme->id]);
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
