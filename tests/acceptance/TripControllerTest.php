<?php

namespace Tests\Acceptance;

use Tests\AcceptanceTestCase;
use App\Entities\Trip;

class TripControllerTest extends AcceptanceTestCase
{
    public function testView()
    {
        $this->visit('/')->see('<a class="mdl-navigation__link" href="'.$this->baseUrl.'/trip">');
    
        $this->visit('/trip')
            ->see('<i class="material-icons">filter_list</i>')
        ;
    }
    
    public function testCreate()
    {
        $this->visit('/trip')->see('<a href="'.$this->baseUrl.'/trip/create');
        
        $this->visit('/trip/create');
    
        $this->type('2016-01-01', 'pickup_date')
            ->type('2016-01-02', 'deliver_date')
            ->type('1200 First Av', 'pickup_place')
            ->type('345 63th St', 'deliver_place')
            ->type('320', 'begin_mileage')
            ->type('450', 'end_mileage')
            ->type('130', 'total_mileage')
            ->type('13.6', 'fuel_cost')
            ->type('5', 'fuel_amount')
            ->type('Descricao', 'description')
            ->press('Enviar')
            ->seePageIs('/trip')
        ;
    
        $this->seeInDatabase(
            'trips',
            [
                    'pickup_date' => '2016-01-01',
                    'deliver_date' => '2016-01-02',
                    'pickup_place' => '1200 First Av',
                    'deliver_place' => '345 63th St',
                    'begin_mileage' => 320,
                    'end_mileage' => 450,
                    'total_mileage' => 130,
                    'fuel_cost' => 13.6,
                    'fuel_amount' => 5,
                    'description' => 'Descricao',
            ]
        );
    }

    public function testUpdate()
    {
        $this->visit('/trip/'.Trip::all()->last()['id'].'/edit');
    
        $this->type('2016-02-01', 'pickup_date')
        ->type('2016-02-02', 'deliver_date')
        ->type('1220 First Av', 'pickup_place')
        ->type('342 63th St', 'deliver_place')
        ->type('322', 'begin_mileage')
        ->type('452', 'end_mileage')
        ->type('132', 'total_mileage')
        ->type('13.2', 'fuel_cost')
        ->type('2', 'fuel_amount')
        ->type('Descricao2', 'description')
        ->press('Enviar')
        ->seePageIs('/trip')
        ;
    
        $this->seeInDatabase(
            'trips',
            [
                'pickup_date' => '2016-02-01',
                'deliver_date' => '2016-02-02',
                'pickup_place' => '1220 First Av',
                'deliver_place' => '342 63th St',
                'begin_mileage' => 322,
                'end_mileage' => 452,
                'total_mileage' => 132,
                'fuel_cost' => 13.2,
                'fuel_amount' => 2,
                'description' => 'Descricao2',
            ]
        );
    }
    
    public function testDelete()
    {
        $idDelete = Trip::all()->last()['id'];
        $this->seeInDatabase('trips', ['id' => $idDelete]);
        $this->visit('/trip/destroy/'.$idDelete);
        $this->seeIsSoftDeletedInDatabase('trips', ['id' => $idDelete]);
    }
}