<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\Formation;

class ProStagesController extends AbstractController
{
    /**
     * @Route("/", name="pro_stages_accueil")
     */
    public function afficherAccueil(): Response
    {
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
        $stages=$repositoryStage->findall();
		    return $this->render('pro_stages/accueil.html.twig',['controller_name'=>'page d\'accueil','stages'=>$stages]);
    }
	
    /**
     * @Route("/stage/{id}", name="pro_stages_stage")
     */
    public function afficherStage($id): Response
    {
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
        $stage=$repositoryStage->find($id);
		    return $this->render('pro_stages/stages.html.twig',['controller_name'=>'page du stage : '.$id,'stage'=>$stage,]);
    }

	  /**
     * @Route("/entreprises", name="pro_stages_entreprises")
     */
    public function afficherEntreprises(): Response
    {
		    $repositoryEntreprises=$this->getDoctrine()->getRepository(Entreprise::class);
        $entreprises=$repositoryEntreprises->findAll();
        return $this->render('pro_stages/entreprises.html.twig',['controller_name'=>'page du tri par entreprise','entreprises'=>$entreprises]);
    }

    /**
     * @Route("/entreprise/{id}", name="pro_stages_entreprises_trie")
     */
    public function triParEntreprises($id): Response
    {
		    $repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);
        $entreprise=$repositoryEntreprise->find($id);
        return $this->render('pro_stages/entreprises_trie.html.twig',['controller_name'=>'stages de l\'entreprise : '.$id,'entreprise'=>$entreprise]);
    }
	
    /**
     * @Route("/entreprise/{idE}/stage/{idS}", name="pro_stages_entreprise_stage")
     */
    public function afficherStageEntreprise($idE,$idS): Response
    {
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
        $stage=$repositoryStage->find($idS);
		    return $this->render('pro_stages/stage_Entreprise.html.twig',['controller_name'=>'page du stage : '.$idS,'stage'=>$stage,]);
    }

  	/**
     * @Route("/formations", name="pro_stages_formations")
     */
    public function afficherFormations(): Response
    {
      $repositoryFormations=$this->getDoctrine()->getRepository(Formation::class);
      $formations=$repositoryFormations->findAll();
		  return $this->render('pro_stages/formations.html.twig',['controller_name'=>'page du tri par formation','formations'=>$formations]);
    }

    /**
     * @Route("/formation/{id}", name="pro_stages_formations_trie")
     */
    public function triParFormations($id): Response
    {
      $repositoryFormation=$this->getDoctrine()->getRepository(Formation::class);
      $formation=$repositoryFormation->find($id);
	  	return $this->render('pro_stages/formations_trie.html.twig',['controller_name'=>'stages de la formations : '.$id,'formation'=>$formation]);
    }
	
	  /**
     * @Route("/formation/{idF}/stage/{idS}", name="pro_stages_formation_stage")
     */
    public function afficherStageFormation($idF,$idS): Response
    {
      $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
      $stage=$repositoryStage->find($idS);
	  	return $this->render('pro_stages/stage_Formation.html.twig',['controller_name'=>'page du stage : '.$idS,'stage'=>$stage,]);
    }
    
}
