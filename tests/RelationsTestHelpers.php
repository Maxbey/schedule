<?php

namespace App\Tests;


trait RelationsTestHelpers
{
    public function checkHasManyRelation($entityName, $withName, $method)
    {
        $entity = factory($entityName)->create();

        factory($withName, 3)->create()->each(function($item) use ($entity, $method){
            $entity->$method()->save($item);
        });

        $entity->save();

        $entity->$method->each(function($item) use($withName){
            $this->assertInstanceOf($withName, $item);
        });
    }

    public function checkBelongsToManyRelation($entityName, $withName, $method)
    {
        $entity = factory($entityName)->create();

        factory($withName, 3)->create()->each(function($item) use ($entity, $method){
            $entity->$method()->attach($item);
        });

        $entity->save();

        $entity->$method->each(function($item) use($withName){
            $this->assertInstanceOf($withName, $item);
        });
    }

    public function checkBelongsToRelation($entityName, $withName, $method)
    {
        $entity = factory($entityName)->create();

        $this->assertInstanceOf($withName, $entity->$method);
    }
}