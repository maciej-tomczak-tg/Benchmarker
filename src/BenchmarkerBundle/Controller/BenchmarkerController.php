<?php

namespace BenchmarkerBundle\Controller;

use BenchmarkerBundle\BenchmarkerEvents;

use BenchmarkerBundle\Event\BenchmarkCompletedEvent;
use BenchmarkerBundle\Event\BenchmarkInitializeEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use BenchmarkerBundle\Form\Type\SitesType;

class BenchmarkerController extends Controller
{
    /**
     * @Route("/")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(SitesType::class);
        
        $form->handleRequest($request);
        $benchmark = null;
        if ($form->isValid()) {
            $benchmark = $form->getData();
            $event = new BenchmarkInitializeEvent($benchmark);
            $eventDispatcher = $this->container->get('event_dispatcher');
            $eventDispatcher->dispatch(BenchmarkerEvents::RUN_BENCHMARK_INITIALIZE, $event);


            $benchmarkService = $this->container->get('benchmarker.service.benchmark_service');
            $benchmark = $benchmarkService->run($benchmark);
            $event = new BenchmarkCompletedEvent($benchmark);
            $eventDispatcher->dispatch(BenchmarkerEvents::RUN_BENCHMARK_COMPLETED, $event);
        }
        
        return $this->render('BenchmarkerBundle:form:form.html.twig', [
            'form' => $form->createView(),
            'benchmark' => $benchmark
        ]);
    }
}
