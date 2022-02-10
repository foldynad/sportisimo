<?php

declare(strict_types=1);

namespace App\AdminModule\Components;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use Nette\Application\UI\Control;
use Nette\SmartObject;
use Nette\Utils\Paginator;

abstract class BaseList extends Control implements IBaseList
{
    use SmartObject;

    protected Paginator $paginator;

    private QueryBuilder $queryBuilder;

    /** @persistent */
    public int $itemsPerPage = 20;

    /** @persistent */
    public int $page;

    /** @persistent */
    public string $order = 'asc';

    public function __construct()
    {
        $this->paginator = new Paginator();
    }

    public function render()
    {
        $this->queryBuilder = $this->prepareData();

        $paginator = new DoctrinePaginator($this->queryBuilder);

        if ($this->paginator->getItemsPerPage() == 1) {
            $this->paginator->setItemsPerPage($this->itemsPerPage);
        }

        $this->paginator->setItemCount($paginator->count());

        $this->template->paginator = $this->paginator;
        $this->template->order = $this->order;
    }

    abstract public function prepareData(): QueryBuilder;

    protected function getData()
    {
        return $this->queryBuilder
            ->setFirstResult($this->paginator->getOffset())
            ->setMaxResults($this->getItemsPerPage())
            ->getQuery()
            ->getResult();
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function setItemsPerPage(int $itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;
        $this->paginator->setItemsPerPage($itemsPerPage);
    }

    protected function setPage(int $page)
    {
        $this->page = $page;
        $this->paginator->setPage($page);
    }

    protected function setOrder(string $order)
    {
        $this->order = $order;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function handlePage(int $page)
    {
        $this->setPage($page);

        $this->redrawControl();
    }

    public function handleItemsPerPage(int $itemsPerPage)
    {
        $this->setItemsPerPage($itemsPerPage);

        $this->redrawControl();
    }

    public function handleOrder(string $order)
    {
        $this->setOrder($order);

        $this->redrawControl();
    }
}
