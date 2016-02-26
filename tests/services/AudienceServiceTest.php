<?php

class AudienceServiceTest extends ServiceTestCase
{
    protected function service()
    {
        return 'AudienceService';
    }

    public function testCreateMethod()
    {
        $attributes = [
            'name' => 'auditory name',
            'building' => 1,
            'number' => 321
        ];

        $audience = $this->service->create($attributes);

        $this->seeInDatabase('audiences', ['id' => $audience->id]);
    }

    public function testSyncThemesMethod()
    {
        $audience_id = factory(App\Entities\Audience::class)->create()->id;
        $themes = factory(App\Entities\Theme::class, 3)->create();

        $changes = $this->service->syncThemes($audience_id, $themes);

        $this->assertTrue(count($changes['attached']) === 3);
    }
}
