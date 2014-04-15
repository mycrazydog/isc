<?php

# app/tests/controllers/PostsControllerTest.php

class BlogControllerTest extends TestCase
{
    public function setUp()
    {
      parent::setUp();

      $this->mock = $this->mock('Cribbb\Storage\User\UserRepository');
    }

    public function mock($class)
    {
      $mock = Mockery::mock($class);

      $this->app->instance($class, $mock);

      return $mock;
    }

  public function testIndex()
  {
      $this->call('GET', '/');
      $this->assertTrue($this->client->getResponse()->isOk());
      $this->assertViewHas('posts');
  }

  public function testPosts()
  {
        $response = $this->call('GET', '/');
        $this->assertViewHas('posts');

        // getData() returns all vars attached to the response.
        $posts = $response->original->getData()['posts'];
        $this->assertInstanceOf('Illuminate\Pagination\Paginator', $posts);

  }

}
