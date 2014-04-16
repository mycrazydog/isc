<?php

# app/tests/controllers/PostsControllerTest.php

class PostControllerTest extends TestCase
{

  public function testIndex()
  {
        $response = $this->call('GET', '/');

        $this->assertViewHas('posts');

        // getData() returns all vars attached to the response.
        $posts = $response->original->getData()['posts'];

        $this->assertInstanceOf('Illuminate\Pagination\Paginator', $posts);

  }

}
