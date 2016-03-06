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
            'purpose' => 'auditory name',
            'location' => 1
        ];

        $audience = $this->service->create($attributes);

        $this->seeInDatabase('audiences', ['id' => $audience->id]);
    }

    public function testSyncThemesMethod()
    {
        $this->syncTest(\App\Entities\Audience::class, \App\Entities\Theme::class, 'syncThemes');
    }
}
