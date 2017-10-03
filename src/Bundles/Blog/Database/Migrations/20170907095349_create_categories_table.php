<?php


use Phinx\Migration\AbstractMigration;

class CreateCategoriesTable extends AbstractMigration
{
    public function change()
    {
        $this->table('categories')
            ->addColumn('title', 'string')
            ->addColumn('slug', 'string')
            ->addColumn('nav', 'boolean', ['default' => false])
            ->addColumn('position', 'integer', ['default' => 0, 'limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY])
            ->create();
    }
}
