<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookingRepository;
use App\Form\AdminBookingType;
use App\Entity\Booking;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class AdminBookingController extends AbstractController
{
    /**
     * @Route("/admin/bookings", name="admin_bookings_index")
     * 
     * @param BookingRepository $bookings
     * 
     * @return Response
     */
    public function index(BookingRepository $bookings)
    {
        return $this->render('admin/booking/index.html.twig', [
            'bookings' => $bookings->findAll(),
        ]);
    }

    /**
     * Permet d'éditer une réservation
     * 
     * @Route("/admin/bookings/{id}/edit", name="admin_booking_edit")
     *
     * @param Booking $booking
     * @param Request $request
     * @param ObjectManager $manager
     * 
     * @return Response
     */
    public function edit(Booking $booking, Request $request, ObjectManager $manager){

        $form =$this->createForm(AdminBookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $booking->setAmount(0);

            $manager->persist($booking);
            $manager->flush();

            $this->addFlash(
                'success',
                "La réservation n°<strong>{$booking->getId()}</strong> a bien été modifiée !"
            );

            return $this->redirectToRoute('admin_bookings_index');
        }
        
        return $this->render('admin/booking/edit.html.twig', [
            "form" => $form->createView(),
            "booking" => $booking,
        ]);
    }

    /**
     * Permet de supprimer une réservation
     * 
     * @Route("/admin/bookings/{id}/delete", name="admin_booking_delete")
     *
     * @return Response
     */
    public function delete(Booking $booking, ObjectManager $manager){
        $manager->remove($booking);
        $manager->flush();

        $this->addFlash(
            'success',
            "La réservation a bien été supprimée !"
        );

        return $this->redirectToRoute('admin_bookings_index');
    }
}
