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
    /**
     * @Route("/", name="pro_stages_accueil")
     */
    public function afficherAccueil(StageRepository $repositoryStage): Response
    {
        $stages=$repositoryStage->findall();
		    return $this->render('pro_stages/accueil.html.twig',['controller_name'=>'page d\'accueil','stages'=>$stages]);
    }
	
    /**
     * @Route("/stage/{id}", name="pro_stages_stage")
     */
    public function afficherStage(Stage $stage,$id): Response
    {
		    return $this->render('pro_stages/stages.html.twig',['controller_name'=>'page du stage : '.$id,'stage'=>$stage,]);
    }

	  /**
     * @Route("/entreprises", name="pro_stages_entreprises")
     */
    public function afficherEntreprises(EntrepriseRepository $repositoryEntreprises): Response
    {
        $entreprises=$repositoryEntreprises->findAll();
        return $this->render('pro_stages/entreprises.html.twig',['controller_name'=>'page du tri par entreprise','entreprises'=>$entreprises]);
    }

    /**
     * @Route("/entreprise/{id}", name="pro_stages_entreprises_trie")
     */
    public function triParEntreprises(Entreprise $entreprise,$id): Response
    {
        return $this->render('pro_stages/entreprises_trie.html.twig',['controller_name'=>'stages de l\'entreprise : '.$id,'entreprise'=>$entreprise]);
    }
	
    /**
     * @Route("/entreprise/{idE}/stage/{idS}", name="pro_stages_entreprise_stage")
     */
    public function afficherStageEntreprise(StageRepository $repositoryStage,$idE,$idS): Response
    {
        $stage=$repositoryStage->find($idS);
		    return $this->render('pro_stages/stage_Entreprise.html.twig',['controller_name'=>'page du stage : '.$idS,'stage'=>$stage,]);
    }

  	/**
     * @Route("/formations", name="pro_stages_formations")
     */
    public function afficherFormations(FormationRepository $repositoryFormations): Response
    {
      $formations=$repositoryFormations->findAll();
		  return $this->render('pro_stages/formations.html.twig',['controller_name'=>'page du tri par formation','formations'=>$formations]);
    }

    /**
     * @Route("/formation/{id}", name="pro_stages_formations_trie")
     */
    public function triParFormations(Formation $formation,$id): Response
    {
	  	return $this->render('pro_stages/formations_trie.html.twig',['controller_name'=>'stages de la formations : '.$id,'formation'=>$formation]);
    }
	
	  /**
     * @Route("/formation/{idF}/stage/{idS}", name="pro_stages_formation_stage")
     */
    public function afficherStageFormation(StageRepository $repositoryStage,$idF,$idS): Response
    {
      $stage=$repositoryStage->find($idS);
	  	return $this->render('pro_stages/stage_Formation.html.twig',['controller_name'=>'page du stage : '.$idS,'stage'=>$stage,]);
    }
    
}
