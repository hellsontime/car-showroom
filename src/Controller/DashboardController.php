<?php

namespace App\Controller;

use App\Service\DashboardService;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends BaseController
{
    private DashboardService $_dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->_dashboardService = $dashboardService;
    }

    public function __invoke(): Response
    {
        return $this->render('pages/home/cars-showroom-dashboard.html.twig');
    }

    public function renderSoldLastYear(): Response
    {
        return $this->render('pages/data/sold-last-year.html.twig');
    }

    public function renderUnsoldCars(): Response
    {
        return $this->render('pages/data/unsold-cars.html.twig');
    }

    public function renderCurrentlyOnSale(): Response
    {
        return $this->render('pages/data/currently-on-sale.html.twig');
    }

    public function avgToday(): Response
    {
        $res = $this->_dashboardService->avgToday();

        $avgToday = $res['avgPrice'];
        $orders = $res['orders'];

        return $this->render(
            'dashboard/card/avg-today.html.twig',
            ['avgToday' => $avgToday, 'orders' => $orders]
        );
    }

    public function avgWeek(): Response
    {
        $res = $this->_dashboardService->avgInRange(7);

        $avgWeek = $res['avgPrice'];
        $orders = $res['orders'];

        return $this->render(
            'dashboard/card/avg-week.html.twig',
            ['avgWeek' => $avgWeek, 'orders' => $orders]
        );
    }

    public function avgMonth(): Response
    {
        $res = $this->_dashboardService->avgInRange(30);

        $avgMonth = $res['avgPrice'];
        $orders = $res['orders'];

        return $this->render(
            'dashboard/card/avg-month.html.twig',
            ['avgMonth' => $avgMonth, 'orders' => $orders]
        );
    }

    public function avgQuarter(): Response
    {
        $res = $this->_dashboardService->avgInRange(90);

        $avgQuarter = $res['avgPrice'];
        $orders = $res['orders'];

        return $this->render(
            'dashboard/card/avg-quarter.html.twig',
            ['avgQuarter' => $avgQuarter, 'orders' => $orders]
        );
    }

    public function avgYear(): Response
    {
        $res = $this->_dashboardService->avgInRange(365);

        $avgYear = $res['avgPrice'];
        $orders = $res['orders'];

        return $this->render(
            'dashboard/card/avg-year.html.twig',
            ['avgYear' => $avgYear, 'orders' => $orders]
        );
    }

    public function avgAllTime(): Response
    {
        $res = $this->_dashboardService->avgAllTime();

        $avgAllTime = $res['avgPrice'];
        $orders = $res['orders'];

        return $this->render(
            'dashboard/card/avg-all-time.html.twig',
            ['avgAllTime' => $avgAllTime, 'orders' => $orders]
        );
    }

    public function carsSoldLastYear(bool $sliced = false, bool $button = false): Response
    {
        $carsSoldLastYear = $this->_dashboardService->getCarsSoldLastYear();

        if ($sliced) {
            $carsSoldLastYear = array_slice($carsSoldLastYear, 0, 5);
        }

        return $this->render(
            'dashboard/table/cars-sold-last-year.html.twig',
            [
                'carsSoldLastYear' => $carsSoldLastYear,
                'button' => $button,
            ]
        );
    }

    public function unsoldCars(bool $sliced = false, bool $button = false): Response
    {
        $unsoldCars = $this->_dashboardService->getUnsoldCars();

        if ($sliced) {
            $unsoldCars = array_slice($unsoldCars, 0, 5);
        }

        return $this->render(
            'dashboard/table/unsold-cars.html.twig',
            [
                'unsoldCars' => $unsoldCars,
                'button' => $button,
            ]
        );
    }

    public function modelsOnSale(bool $sliced = false, bool $button = false): Response
    {
        $modelsOnSale = $this->_dashboardService->getModelsOnSale();

        if ($sliced) {
            $modelsOnSale = array_slice($modelsOnSale, 0, 5);
        }

        return $this->render(
            'dashboard/table/models-on-sale.html.twig',
            [
                'modelsOnSale' => $modelsOnSale,
                'button' => $button,
            ]
        );
    }
}