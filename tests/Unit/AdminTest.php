<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class AdminTest extends TestCase
{
    use DatabaseMigrations;

    public function testAdminDashboard()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->get(route('admin_dashboard'));
        $response->assertStatus(200);
    }

    public function testAdminAddCar()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->get(route('admin_addcar'));
        $response->assertStatus(200);
    }

    public function testAdminSaveCar()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->post(route('admin_savecar'), array(
            'vehicletype'=>'Private Car',
            'carname'=>'Toyota Corolla 2012',
            'carno'=>'546698',
            'seat'=>'4',
            'mobile'=>'0135458755'
        ));
        $response->assertSessionHas('success');
    }

    public function testAdminEditCar()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->post(route('admin_savecar'), array(
            'vehicletype'=>'Private Car Edited',
            'carname'=>'Toyota Corolla 2012',
            'carno'=>'546698',
            'seat'=>'4',
            'mobile'=>'0135458755'
        ));
        $response->assertSessionHas('success');
    }

    public function testAdminBookingDetails()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->get(route('admin_details'));
        $response->assertStatus(200);
    }

    public function testAdminOfferFare()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->post(route('admin_offerfare'), array(
            'bookid'=>'1',
            'offer'=>'2000'
        ));
        $response->assertSessionHas('success');
    }

    public function testAdminRejectBooking()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->post(route('admin_notavailable'), array(
            'bookid'=>'1'
        ));
        $response->assertSessionHas('success');
    }

    public function testAdminDeleteCar()
    {
        $adminuser = User::create(['name'=>'Test User', 'email'=>'test@gmail.com', 'password'=>'1234','role'=>'admin']);
        $this->actingAs($adminuser);
        $response = $this->post(route('admin_deletecar'), array(
            'carid'=>'1',
        ));
        $response->assertSessionHas('success');
    }

}
