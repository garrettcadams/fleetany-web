<?php

namespace Tests\Acceptance;

use Tests\AcceptanceTestCase;
use App\Entities\Part;
use App\Entities\Type;

class TireSensorControllerTest extends AcceptanceTestCase
{
    public function testFilters()
    {
        $idPart = Part::select('parts.id')
            ->join('types', 'types.id', '=', 'parts.part_type_id')
            ->where('types.entity_key', 'part')
            ->where('types.name', 'sensor')
            ->first()['id'];
        
        $tireSensor = factory(\App\Entities\TireSensor::class)->create([
            'part_id' => $idPart,
        ]);
        
        $this->visit('/part/'.$idPart.'/edit?id=&temperature=1&pressure=1&latitude=&longitude=&number=1&sort=temperature-asc')
            ->see('mode_edit</i>');
    }
    
    public function testSort()
    {
        
        $idPart = Part::select('parts.id')
            ->join('types', 'types.id', '=', 'parts.part_type_id')
            ->where('types.entity_key', 'part')
            ->where('types.name', 'sensor')
            ->first()['id'];
        
        $tireSensor = factory(\App\Entities\TireSensor::class)->create([
            'part_id' => $idPart,
        ]);
        
        $this->visit('/part/'.$idPart.'/edit?id=&temperature=&pressure=&latitude=&longitude=&number=&sort=temperature-asc')
            ->see('mode_edit</i>');
        
        $this->visit('/part/'.$idPart.'/edit?id=&temperature=&pressure=&latitude=&longitude=&number=&sort=id-asc')
            ->see('mode_edit</i>');

        $this->visit('/part/'.$idPart.'/edit?id=&temperature=&pressure=&latitude=&longitude=&number=&sort=vehicle-desc')
            ->see('mode_edit</i>');
            
        $this->visit('/part/'.$idPart.'/edit?id=&temperature=&pressure=&latitude=&longitude=&number=&sort=vehicle-asc')
            ->see('mode_edit</i>');

        $this->visit('/part/'.$idPart.'/edit?id=&temperature=&pressure=&latitude=&longitude=&number=&sort=part-type-desc')
            ->see('mode_edit</i>');
            
        $this->visit('/part/'.$idPart.'/edit?id=&temperature=&pressure=&latitude=&longitude=&number=&sort=part-type-asc')
            ->see('mode_edit</i>');

        $this->visit('/part/'.$idPart.'/edit?id=&temperature=&pressure=&latitude=&longitude=&number=&sort=cost-desc')
            ->see('mode_edit</i>');
            
        $this->visit('/part/'.$idPart.'/edit?id=&temperature=&pressure=&latitude=&longitude=&number=&sort=cost-asc')
            ->see('mode_edit</i>');
            
    }
}
