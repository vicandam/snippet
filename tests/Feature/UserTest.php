<?php

namespace Tests\Feature;

use App\User;
use Tests\Library\TestFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->factory = new TestFactory();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_logon_user_can_retrieved_users_test()
    {
        $this->factory
            ->createUser()
            ->signIn($this);

        $attribute = [
            'page' => 1,
            'pagination' => 1
        ];

        $response = $this->get('api/user?' . http_build_query($attribute));

        $response->assertOk();
    }

    public function test_logon_user_can_update_own_account_test()
    {
        $this->factory
            ->createUser()
            ->signIn($this);

        $attribute = [
            'name'       => 'John Doe',
            'email'      => 'johndoe@example.com',
            'password'   => bcrypt('password')
        ];

        $response = $this->patch('api/user/' . $this->factory->user->id, $attribute);

        $response->assertOk();

        $this->assertEquals('johndoe@example.com', $response->getOriginalContent()['data']['user']['email']);
    }

    public function test_logon_user_can_delete_user_test()
    {
        $this->factory
            ->createUser()
            ->signIn($this);

        $response = $this->delete('api/user/' . $this->factory->user->id);

        $response->assertOk();

        $this->assertTrue( User::where('id', $this->factory->user->id)->count() == 0);
    }
}
