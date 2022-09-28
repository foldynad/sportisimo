<?php

declare(strict_types=1);

namespace App\Model\Brands;

use App\Model\Brands\Entities\Brand;
use App\Model\EntityManager;
use Nette\SmartObject;

final class BrandManager
{
    use SmartObject;

    public function __construct(private EntityManager $em)
    {
    }

    public function createBrand(string $name): ?Brand
    {
        $brand = new Brand($name);

        $this->saveBrand($brand);

        return $brand;
    }

    public function deleteBrand(Brand $brand)
    {
        $this->em->remove($brand);
        $this->em->flush();
    }

    /**
     * @param Brand $brand
     * @return Brand|null
     *
     * @throws \Exception
     */
    public function saveBrand(Brand $brand): ?Brand
    {
        $this->em->persist($brand);
        $this->em->flush();

        return $brand;
    }
}
