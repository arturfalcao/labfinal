<?php
/**
 * Created by PhpStorm.
 * User: Celso
 * Date: 21-08-2015
 * Time: 0:44
 */


namespace AppBundle\EventListener;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class CalendarEventListener
{
    private $entityManager;
    private $token_storage;

    public function __construct(EntityManager $entityManager,TokenStorageInterface $token_storage)
    {
        $this->entityManager = $entityManager;
        $this->token_storage = $token_storage;

    }


    public function loadEvents(CalendarEvent $calendarEvent)
    {

        // The original request so you can get filters from the calendar
        // Use the filter in your query for example

        // load events using your custom logic here,
        // for instance, retrieving events from a repository
        $user_id = $this->token_storage->getToken()->getUser()->getId();

        $companyEvents = $this->entityManager->getRepository('AppBundle:Agenda')
            ->createQueryBuilder('company_events')
            ->select('ag')
            ->from('AppBundle:Agenda', 'ag')
            ->where('ag.FnIdUtilizador = :user')
            ->setParameter('user', $user_id)
            ->getQuery()->getResult();

        // $companyEvents and $companyEvent in this example
        // represent entities from your database, NOT instances of EventEntity
        // within this bundle.
        //
        // Create EventEntity instances and populate it's properties with data
        // from your own entities/database values.

        foreach($companyEvents as $companyEvent) {

            // create an event with a start/end time, or an all day event
            if ($companyEvent->getAllDay() === false) {
                $eventEntity = new EventEntity($companyEvent->getId(),$companyEvent->getTitle(), $companyEvent->getStartDatetime(), $companyEvent->getEndDatetime());
            } else {
                
                $eventEntity = new EventEntity($companyEvent->getId(),$companyEvent->getTitle(), $companyEvent->getStartDatetime(), $companyEvent->getEndDatetime(), $companyEvent->getAllDay());
            }
            $calendarEvent->addEvent($eventEntity);
        }
    }
}