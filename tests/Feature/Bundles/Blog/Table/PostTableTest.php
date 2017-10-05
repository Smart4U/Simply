<?php


namespace Tests\Feature\Core\Table;


use Bundles\Blog\Entity\Post;
use Bundles\Blog\Table\PostTable;
use Tests\Feature\Core\Database\DatabaseTestCase;

class PostTableTest extends DatabaseTestCase
{

    /**
     * @var PostTable
     */
    private $postTable;

    public function setUp() {
        parent::setUp();
        $this->postTable = new PostTable($this->pdo);
        //$this->pdo->beginTransaction(); // un comment for conserve data while Test On MYSQL
    }

    // un comment for conserve data while Test On MYSQL
    /*public function tearDown()
    {
        $this->pdo->rollBack();
    }
    */

    public function testFind() {
        $this->seedDatabase();
        $post = $this->postTable->find(1);
        $this->assertInstanceOf(Post::class, $post);
    }

    public function testNotFoundRecord() {
        $post = $this->postTable->find(9999999999);
        $this->assertNull($post);
    }

    public function testUpdate() {
        $this->seedDatabase();
        $this->postTable->update(1, ['title' => 'titre', 'slug' => 'le-slug']);
        $post = $this->postTable->find(1);
        $this->assertEquals('titre', $post->title);
        $this->assertEquals('le-slug', $post->slug);
    }

    public function testInsert() {
        $this->postTable->insert(['title' => 'titre', 'slug' => 'le-slug']);
        $post = $this->postTable->find(1);
        $this->assertEquals('titre', $post->title);
        $this->assertEquals('le-slug', $post->slug);
    }

    public function testDelete()
    {
        $this->postTable->insert(['title' => 'Salut', 'slug' => 'demo']);
        $this->postTable->insert(['title' => 'Salut', 'slug' => 'demo']);
        $count = $this->pdo->query('SELECT COUNT(id) FROM posts')->fetchColumn();
        $this->assertEquals(2, (int) $count);
        $this->postTable->delete($this->pdo->lastInsertId());
        $count = $this->pdo->query('SELECT COUNT(id) FROM posts')->fetchColumn();
        $this->assertEquals(1, (int)$count);
    }




}