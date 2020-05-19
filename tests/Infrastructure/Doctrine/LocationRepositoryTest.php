<?php


namespace App\Tests\Infrastructure\Doctrine;

use App\Entity\Location;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LocationRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /** @test */
    public function it_should_save_a_location(): void
    {
        $newLocation = new Location('newLocationTest');
        $this->entityManager->persist($newLocation);
        $this->entityManager->flush();

        $dbLocation = $this->entityManager
            ->getRepository(Location::class)
            ->findOneBy(['name' => 'newLocationTest']);

        $this->assertEquals($newLocation, $dbLocation);

        $this->entityManager->remove($dbLocation);
        $this->entityManager->flush();
    }

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }
}
