<?php

namespace Tests\Feature;

use App\Category;
use Tests\Library\TestFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
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
    public function test_admin_user_can_add_category_test()
    {
        $this->factory
            ->createCategory()
            ->createUser()
            ->signIn($this);

        $attribute = [
            'name' => 'Test Category'
        ];

        $response = $this->post('api/category', $attribute);

        $response->assertOk();

        $this->assertEquals('Test Category', $response->getOriginalContent()['data']['category']['name']);
    }

    public function test_admin_user_can_update_category_test()
    {
        $this->factory
            ->createCategory()
            ->createUser()
            ->signIn($this);

        $attribute = [
            'name' => 'Update Category'
        ];

        $response = $this->patch('api/category/' . $this->factory->category->id, $attribute);

        $response->assertOk();

        $this->assertEquals('Update Category', $response->getOriginalContent()['data']['category']['name']);
    }

    public function test_logon_admin_user_can_delete_category_test()
    {
        $this->factory
            ->createCategory()
            ->createUser()
            ->signIn($this);

        $response = $this->delete('api/category/' . $this->factory->category->id);

        $response->assertOk();

        $this->assertTrue( Category::where('id', $this->factory->category->id)->count() == 0);
    }
}
