<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Tradesman;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
     #[Route('/api/tradesman/{id}/data/{week}/download', name: 'api_download_tradesman_data_weekly', methods: ['GET'])]

    public function downloadTradesmanDataWeekly(
        Tradesman $tradesman,
        string $week,
        EntityManagerInterface $entityManager
     ): Response
    {
        // Fetch the data for the specified tradesman and week
        $data = $this->getDataForTradesmanAndWeek($tradesman, $week, $entityManager);

        // Generate the CSV content
        $csvContent = $this->generateCSVContent($data);

        // Create the response object with CSV content
        $response = new Response($csvContent);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="tradesman_data.csv"');

        return $response;
    }

    private function getDataForTradesmanAndWeek(Tradesman $tradesman, string $week, $entityManager): array
    {
        $query = $entityManager->createQueryBuilder()
            ->select('t')
            ->from('App\Entity\Transaction', 't')
            ->where('WEEK(t.date) = WEEK(:date)')
            ->setParameter('date', $week)
            ->getQuery();

        $results = $query->getResult();
        $data = [];
        foreach ($results as $key => $result) {
            $data[$key]['amount'] = $result->getAmount();
            $data[$key]['amount'] = $result->getTradesman()->getName();
            $data[$key]['amount'] = $result->getDate()->format('Y-m-d H:i:s');
        }
    return $data;
    }

    private function generateCSVContent(array $data): string
    {
        // Create a CSV string from the data array
        $csvContent = '';
        foreach ($data as $row) {
            $csvContent .= implode(',', $row) . "\n";
        }

        return $csvContent;
    }
}
