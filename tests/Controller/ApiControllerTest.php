<?php
use App\Controller\ApiController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiControllerTest extends WebTestCase
{
    public function testDownloadData()
    {
        $client = static::createClient();
        $entityManager = $this->createMock(EntityManagerInterface::class);
        // Mock the necessary dependencies

        $client->request(
            'GET',
            '/api/data/download',
            [
                'search' => '1000',
                'start_datetime' => '2023-06-01',
                'end_datetime' => '2023-06-30',
            ]
        );

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('text/csv', $response->headers->get('Content-Type'));
        $this->assertEquals('attachment; filename="tradesman_data.csv"', $response->headers->get('Content-Disposition'));

        // Additional assertions for CSV content if needed
    }

    public function testDownloadTradesmanDataWeekly()
    {
        $client = static::createClient();
        $entityManager = $this->createMock(EntityManagerInterface::class);
        // Mock the necessary dependencies

        $client->request('GET', '/api/tradesman/1/data/2023-06-18/download');

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('text/csv', $response->headers->get('Content-Type'));
        $this->assertEquals('attachment; filename="tradesman_data.csv"', $response->headers->get('Content-Disposition'));

    }
}
