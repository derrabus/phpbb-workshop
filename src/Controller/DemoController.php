<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class DemoController
{
    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Connection $connection, Environment $twig)
    {
        $this->connection = $connection;
        $this->twig = $twig;
    }

    public function __invoke(): Response
    {
        $result = $this->connection->fetchAssoc(
            'SELECT COUNT(*) AS topics, SUM(topic_views) AS view_count FROM topics;'
        );

        return new Response(
            $this->twig->render('demo.html.twig', $result)
        );
    }
}
