<?php

namespace Tests\Feature;

use App\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Library\TestFactory;
use Tests\TestCase;

class TopicTest extends TestCase
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
    public function test_retrievied_topic_test()
    {
        $this->factory
            ->createTopic();

        $attributes = [
            'paginate' => 10,
            'page' => 1
        ];

        $response = $this->get('api/topic?' . http_build_query($attributes));

        $response->assertOk();

        $this->assertCount(1, $response->getOriginalContent() ['data']['topics']);
    }

    public function test_logon_user_can_view_his_post_test()
    {
        $this->factory
            ->createUser()
            ->signIn($this)
            ->createTopic(2)
            ->createCategory(1);

        $attributes = [
            'paginate' => 10,
            'page' => 1
        ];

        $response = $this->get('api/user-post?' . http_build_query($attributes));

        $response->assertOk();
    }

    public function test_logon_user_can_add_topic_test()
    {
        $this->factory
            ->createUser()
            ->signIn($this)
            ->createTopic();

        $attributes = [
            'user_id' => $this->factory->user->id,
            'category_id' => 1,
            'title' => 'title',
            'description' => 'description',
            'status' => 1
        ];

        $response = $this->post('api/topic', $attributes);

        $response->assertStatus(200);

        $this->assertEquals($attributes['title'], $response->getOriginalContent()['data']['topic']['title'] );
    }

    public function test_logon_user_can_update_topic_test()
    {
        $this->factory
            ->createUser()
            ->signIn($this)
            ->createTopic();

        $attributes = [
            'category_id' => 1,
            'title' => 'title',
            'description' => 'description',
            'status' => 1
        ];

        $response = $this->patch('api/topic/' . $this->factory->user->id, $attributes);

        $response->assertStatus(200);

        $this->assertEquals($attributes['title'], $response->getOriginalContent()['data']['topic']['title'] );
    }

    public function test_logon_user_can_delete_topic_test()
    {
        $this->factory
            ->createUser()
            ->signIn($this)
            ->createTopic();

        $this->delete('api/topic/' . $this->factory->topic->id);

        $this->assertTrue(Topic::where('id', $this->factory->topic->id)->count() == 0 );
    }
}
