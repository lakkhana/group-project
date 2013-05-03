<?php

namespace UCSC\EventCalendarBundle\Controller;

use UCSC\EventCalendarBundle\UCSCEventCalendarBundle;

use UCSC\DatabaseBundle\Form\Type\EventType;

use Symfony\Component\HttpFoundation\Request;

use UCSC\EventCalendarBundle\Object\Event;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use \Zend_Gdata_App_Exception;

class DefaultController extends Controller
{
    
    public function addEventAction(Request $request = null ,$type = null ,$msg = null)
    {
    	
    	$eventobj = new Event();
    	$eventobj->setStartdate(time());
    	$eventobj->setEnddate(time());
    	$form = $this->createForm(new EventType(), $eventobj);
    	
    	if($request && $request->getMethod() == 'POST') {
    		
    		$form->bindRequest($request);
    		$gcal = $this->get('event_calendar')->getCalendar();
    		try {
    			$event = $gcal->newEventEntry();
    			$event->title = $gcal->newTitle($eventobj->getTitle());
    			$when = $gcal->newWhen();
    			$when->startTime = date(DATE_ATOM,$eventobj->getStartdate());
    			$when->endTime = date(DATE_ATOM,$eventobj->getEnddate());
    			$event->when = array($when);
    			$gcal->insertEvent($event);
    		} catch (Zend_Gdata_App_Exception $e) {
    			$type = 'error';
    			$msg = 'Error : Couldn\'t add the entry.';
    			return $this->redirect($this->generateUrl('add_event',array('type'=>$type, 'msg'=>$msg)));
    		}
    		$type = 'note';
    		$msg = 'Event added successfully.';
    		return $this->redirect($this->generateUrl('add_event',array('type'=>$type, 'msg'=>$msg)));
    	}
    	
    	return $this->render('UCSCEventCalendarBundle:Default:newevent.html.twig', array(
    			'form' => $form->createView(), 'type'=>$type, 'msg'=>$msg));
    	
    }
    
    public function viewAction()
    {
    	return $this->render('UCSCEventCalendarBundle:Default:viewcalendar.html.twig');
    }
    
    public function listAction($type = null ,$msg = null)
    {
    	$gcal = $this->get('event_calendar')->getCalendar();
    	$query = $gcal->newEventQuery();
    	$query->setUser('default');
    	$query->setVisibility('private');
    	$query->setProjection('basic');
    	
    	try {
    		$feed = $gcal->getCalendarEventFeed($query);
    	} catch (Zend_Gdata_App_Exception $e) {
    		return new Response("Error: " . $e->getResponse());
    	}
    	
    	foreach ($feed as $event) {
    		$event->id = substr($event->id, strrpos($event->id, '/')+1);
    		$event->summary = substr($event->summary, 0, strpos($event->summary, '<'));
    	}
    	
    	return $this->render('UCSCEventCalendarBundle:Default:listevents.html.twig',array('feed'=>$feed,'type'=>$type, 'msg'=>$msg));
    }
    
    public function editEventAction($id)
    {
    	$gcal = $this->get('event_calendar')->getCalendar();
    	$query = $gcal->newEventQuery();
    	$query->setUser('default');
    	$query->setVisibility('private');
    	$query->setProjection('basic');
    	$query->setEvent($id);
    	try {
    		
    		$event = $gcal->getCalendarEventEntry($query);
    		
    	} catch (Zend_Gdata_App_Exception $e) {
    		die("Error: " . $e->getResponse());
    	}
    	
    	$eventobj = new Event();
    	$eventobj->setTitle($event->title);    	
    	$form = $this->createForm(new EventType(), $eventobj);
    	
    	
    	return $this->render('UCSCEventCalendarBundle:Default:newevent.html.twig', array(
    			'form' => $form->createView() ));
    }
    
    public function deleteEventAction($id)
    {
    	$gcal = $this->get('event_calendar')->getCalendar();
    	$query = $gcal->newEventQuery();
    	$query->setUser('default');
    	$query->setVisibility('private');
    	$query->setProjection('full');    	
    	$query->setEvent($id);
    
    	try {
    		$event = $gcal->getCalendarEventEntry($query);
    		$event->delete();
    		
    	} catch (Zend_Gdata_App_Exception $e) {
    			$type = 'error';
    			$msg = 'Error : Couldn\'t delete the entry.';
    			return $this->redirect($this->generateUrl('list_events',array('type'=>$type, 'msg'=>$msg)));
    	}    
    	$type = 'note';
    	$msg = 'Event deleted successfully.';
    	return $this->redirect($this->generateUrl('list_events',array('type'=>$type, 'msg'=>$msg)));
    }
    
}
