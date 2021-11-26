<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStagesController extends AbstractController
{
    /**
     * @Route("/", name="pro_stages_accueil")
     */
    public function index(): Response
    {
        return new Response ('<html><body><h1> Bienvenue sur la page d\'accueil de Prostages </h1></body></html>');
    }
	
	/**
     * @Route("/entreprises", name="pro_stages_entreprises")
     */
    public function afficherEntreprises(): Response
    {
        return new Response ('<html><body><h1> Cette page affichera la liste des entreprises proposant un stage </h1></body></html>');
    }
	
	/**
     * @Route("/formations", name="pro_stages_formations")
     */
    public function afficherFormations(): Response
    {
        return new Response ('<html><body><h1> Cette page affichera la liste des formations de l\'IUT</h1></body></html>');
    }
	
	/**
     * @Route("/stage/{id}", name="pro_stages_stage")
     */
    public function afficherStage($id): Response
    {
        return new Response ('<html><body><h1> Cette page affichera le descriptif du stage ayant pour identifiant '.$id.'</h1></body></html>');
    }
}
