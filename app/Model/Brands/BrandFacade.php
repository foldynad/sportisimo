<?php

declare(strict_types=1);

namespace App\Model\Brands;

use App\Model\Brands\Entities\Brand;
use App\Model\Brands\Repositories\BrandRepository;
use Doctrine\ORM\QueryBuilder;
use Nette\SmartObject;

final class BrandFacade
{
    use SmartObject;

    public function __construct(private BrandManager $brandManager, private BrandRepository $brandRepository)
    {
    }

    public function createBrand(string $name): ?Brand
    {
        return $this->brandManager->createBrand($name);
    }

    public function deleteBrand(Brand $brand): ?Brand
    {
        return $this->brandManager->deleteBrand($brand);
    }

    /**
     * @throws \Exception
     */
    public function saveBrand(Brand $brand): ?Brand
    {
        return $this->brandManager->saveBrand($brand);
    }

    public function findBrand(int $id): ?Brand
    {
        return $this->brandRepository->find($id);
    }

    public function getBrands(int $limit = null, int $offset = 0): QueryBuilder
    {
        $qb = $this->brandRepository->getBrands();

        if ($limit) {
            $qb->setFirstResult($offset)->setMaxResults($limit);
        }

        return $qb;
    }
}
