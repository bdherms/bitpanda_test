<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Country;

class UsersControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function test_delete_success()
    {   
        $user = new User;
        $user->email = 'email@test.com';
        $user->active = 1;
        $user->save();
        $response = $this->delete('/users/' . $user->id);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return void
     */
    public function test_delete_not_found()
    {
        $response = $this->delete('/users/invalid_id');
        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * @return void
     */
    public function test_delete_user_details()
    {
        $user = new User;
        $user->email = 'email@test.com';
        $user->active = 1;
        $user->save();

        $userDetail = new UserDetail;
        $userDetail->user_id = $user->id;
        $userDetail->citizenship_country_id = Country::find(1)->id;
        $userDetail->first_name = '';
        $userDetail->last_name = '';
        $userDetail->phone_number = '';
        $userDetail->save();

        $response = $this->delete('/users/' . $user->id);
        $this->assertEquals(500, $response->getStatusCode());
    }
}
