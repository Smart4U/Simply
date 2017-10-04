<?php

namespace Tests\Feature\Core\Table;

use PDO;
use Bundles\Blog\Entity\Post;
use Core\Table\PostTable;

use PHPUnit\Framework\TestCase;

class PostTableTest extends TestCase
{

    public function setUp(){

    }

    public function testFind() {
        $pdo = new \PDO('sqlite::memory', null ,null, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $postTable = new PostTable($pdo);

        $post = $postTable->find(1);
        $this->assertInstanceOf(Post::class, $post);
    }

}