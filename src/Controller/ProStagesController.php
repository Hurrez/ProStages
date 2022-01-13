<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\Formation;
use App\Repository\StageRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;

class ProStagesController extends AbstractController
{
    //Route de l'accueil
    /**
     * @Route("/", name="pro_stages_accueil")
     */
    public function afficherAccueil(StageRepository $repositoryStage): Response
    {
      //Récupération de tous les stages
      $stages=$repositoryStage->findall();

      //Transmission à la vue des éléments à afficher
		  return $this->render('pro_stages/accueil.html.twig',['controller_name'=>'page d\'accueil','stages'=>$stages]);
    }
	
    //Route permettant d'afficher les stages
    /**
     * @Route("/stage/{id}", name="pro_stages_stage")
     */
    public function afficherStage(Stage $stage,$id): Response
    {
      //Transmission à la vue des éléments à afficher
		  return $this->render('pro_stages/stages.html.twig',['controller_name'=>'page du stage : '.$id,'stage'=>$stage,]);
    }

    //Route affichant toutes les entreprises
	  /**
     * @Route("/entreprises", name="pro_stages_entreprises")
     */
    public function afficherEntreprises(EntrepriseRepository $repositoryEntreprises): Response
    {
      //Récupération de toute les entreprises
      $entreprises=$repositoryEntreprises->findAll();

      //Transmission à la vue des éléments à afficher
      return $this->render('pro_stages/entreprises.html.twig',['controller_name'=>'page du tri par entreprise','entreprises'=>$entreprises]);
    }

    //Route affichant les stages d'une entreprise en particulier
    /**
     * @Route("/entreprise/{id}", name="pro_stages_entreprises_trie")
     */
    public function triParEntreprises(Entreprise $entreprise,$id): Response
    {
      //Transmission à la vue des éléments à afficher
      return $this->render('pro_stages/entreprises_trie.html.twig',['controller_name'=>'stages de l\'entreprise : '.$id,'entreprise'=>$entreprise]);
    }
	
    //Route permettant d'afficher le stage d'une entreprise en particulier
    /**
     * @Route("/entreprise/{idE}/stage/{idS}", name="pro_stages_entreprise_stage")
     */
    public function afficherStageEntreprise(StageRepository $repositoryStage,$idE,$idS): Response
    {
      //Récupération du stage possèdant l'id $idS
      $stage=$repositoryStage->find($idS);

      //Transmission à la vue des éléments à afficher
		  return $this->render('pro_stages/stage_Entreprise.html.twig',['controller_name'=>'page du stage : '.$idS,'stage'=>$stage,]);
    }

    //Route permettant d'afficher toutes les formations
  	/**
     * @Route("/formations", name="pro_stages_formations")
     */
    public function afficherFormations(FormationRepository $repositoryFormations): Response
    {
      //Récupération de toute les formations
      $formations=$repositoryFormations->findAll();

      //Transmission à la vue des éléments à afficher
		  return $this->render('pro_stages/formations.html.twig',['controller_name'=>'page du tri par formation','formations'=>$formations]);
    }

    //Route permettant d'afficher les stages d'une formation en particulier
    /**
     * @Route("/formation/{id}", name="pro_stages_formations_trie")
     */
    public function triParFormations(Formation $formation,$id): Response
    {
      //Transmission à la vue des éléments à afficher
	  	return $this->render('pro_stages/formations_trie.html.twig',['controller_name'=>'stages de la formations : '.$id,'formation'=>$formation]);
    }
	
    //Route permettant d'afficher le stages d'une formation en particulier
	  /**
     * @Route("/formation/{idF}/stage/{idS}", name="pro_stages_formation_stage")
     */
    public function afficherStageFormation(StageRepository $repositoryStage,$idF,$idS): Response
    {
      //Récupération du stages possèdant l'id $idS
      $stage=$repositoryStage->find($idS);
      
      //Transmission à la vue des éléments à afficher
	  	return $this->render('pro_stages/stage_Formation.html.twig',['controller_name'=>'page du stage : '.$idS,'stage'=>$stage,]);
    }
    
}
