<?php

namespace Core\Table;

use Bundles\Blog\Entity\Post;
use Core\Database\PaginatedQuery;
use Pagerfanta\Pagerfanta;

class PostTable
{

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return Pagerfanta
     */
    public function findForPaginate(int $perPage, int $currentPage): Pagerfanta
    {
        $query = new PaginatedQuery(
            $this->pdo,
            "SELECT * FROM posts",
            "SELECT COUNT(id) FROM posts"
        );
        return (new Pagerfanta($query))
            ->setMaxPerPage($perPage)
            ->setCurrentPage($currentPage);
    }


    /**
     * @param int $id
     * @return Post
     */
    public function find(int $id) : Post
    {
        $query = $this->pdo->prepare("SELECT * FROM posts WHERE id = ?");
        $query->execute([$id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        return $query->fetch();
    }
}
