<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Car;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;

    public function testCustomerDashboard()
    {
        $customeruser = User::create(['name'=>'Test User 2', 'email'=>'test2@gmail.com', 'password'=>'1234','role'=>'customer']);
        $this->actingAs($customeruser);
        $response = $this->get(route('customer_dashboard'));
        $response->assertStatus(200);
    }

    public function testCustomerBookings()
    {
        $customeruser = User::create(['name'=>'Test User 2', 'email'=>'test2@gmail.com', 'password'=>'1234','role'=>'customer']);
        $this->actingAs($customeruser);
        $response = $this->get(route('customer_bookings'));
        $response->assertStatus(200);
    }

    public function testCustomerBookCar()
    {
        $customeruser = User::create(['name'=>'Test User 2', 'email'=>'test2@gmail.com', 'password'=>'1234','role'=>'customer']);
        $this->actingAs($customeruser);
        $car = Car::create([
            'vehicletype'=>'Private Car 2',
            'carname'=>'Toyota Corolla 2012',
            'carno'=>'546698',
            'seat'=>'4',
            'mobile'=>'0135458755'
        ]);
        $response = $this->post(route('customer_bookcar'), array(
            'carid'=>'1',
            'cid'=>'1',
            'bookdate'=>'2022-01-12',
            'pickup'=>'Uttara',
            'destination'=>'Gazipur',
            'starttime'=>'15:00',
            'endtime'=>'18:00',
            'mobile'=>'012345678'
        ));
        $response->assertStatus(302);
    }

    public function testCustomerAcceptFare()
    {
        $customeruser = User::create(['name'=>'Test User 2', 'email'=>'test2@gmail.com', 'password'=>'1234','role'=>'customer']);
        $this->actingAs($customeruser);
        $response = $this->post(route('customer_acceptfare'), array(
            'bookid'=>'1'
        ));
        $response->assertSessionHas('success');
    }

    public function testCustomerDeleteBooking()
    {
        $customeruser = User::create(['name'=>'Test User 2', 'email'=>'test2@gmail.com', 'password'=>'1234','role'=>'customer']);
        $this->actingAs($customeruser);
        $response = $this->post(route('customer_deletebooking'), array(
            'bookid'=>'1'
        ));
        $response->assertSessionHas('success');
    }
}
