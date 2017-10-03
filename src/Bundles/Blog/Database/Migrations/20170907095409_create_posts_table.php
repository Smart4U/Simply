<?php


use Phinx\Migration\AbstractMigration;

class CreatePostsTable extends AbstractMigration
{
    public function change()
    {
        $this->table('posts')
            ->addColumn('category_id', 'integer', [
                'null' => true
            ])
            ->addForeignKey('category_id', 'categories', 'id', [
                'delete' => 'SET_NULL',
                'update' => 'NO_ACTION'
            ])
            ->addColumn('author', 'string')
            ->addColumn('slug', 'string')
            ->addColumn('title', 'string')
            ->addColumn('subtitle', 'string')
            ->addColumn('content', 'text', ['limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_LONG])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addColumn('published_at', 'datetime')
            ->addColumn('online', 'integer', ['limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY])
            ->create();
    }
}
