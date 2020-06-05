<?php
namespace Tests\Library;

use App\Category;
use App\Topic;
use App\User;
use Tests\TestCase;

class TestFactory extends TestCase
{
    public $topic, $topics;
    public $category, $categories;
    public $user, $users;

    public function signIn($system)
    {
        $system->actingAs($this->user);

        return $this;
    }

    public function createUser($total = 1, $attr =[])
    {
        if($total == 1) {
            $this->user = factory(User::class)->create($attr);

            $this->createInstance('user', $this->user);
        } else {
            $this->users = factory(User::class,$total)->create($attr);

            $this->createInstance('users', $this->users);
        }

        return $this;
    }

    public function createTopic($total = 1, $attr = [])
    {
        if ($total == 1) {
            $this->topic = factory(Topic::class)->create($attr);

            $this->createInstance('topics', $this->topics);
        } else {
            $this->topics = factory(Topic::class, $total)->create($attr);

            $this->createInstance('topics', $this->topics);
        }

        return $this;
    }

    public function createCategory($total = 1, $attr = [])
    {
        if ($total == 1) {
            $this->category = factory(Category::class)->create($attr);

            $this->createInstance('category', $this->category);
        } else {
            $this->categories = factory(Category::class, $total)->create($attr);

            $this->createInstance('categories', $this->categories);
        }

        return $this;
    }

    /**
     * @param $key
     * @param $instance
     *
     * @todo Change this to something accessible with object accessor (->) as well
     */
    public function createInstance($key, $instance)
    {
        $this->instances[$key] = $instance;
    }
}
