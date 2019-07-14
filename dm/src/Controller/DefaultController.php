<?php
    namespace App\Controller;
    
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\Categorie;
    use App\Entity\Serie;
    use App\Form\CategorieType;
    use Symfony\Contracts\Translation\TranslatorInterface;

    use Symfony\Component\HttpFoundation\Request;

    class DefaultController extends AbstractController{
        /**
         * @Route("/", name="home")
         */
        public function index(Request $request){
            $em = $this->getDoctrine()->getManager();

            $categorie = new Categorie();

            $form = $this->createForm(CategorieType::class, $categorie);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                // $datas = $form->getData();

                $em->persist($categorie);
                $em->flush();
            }

            $categorie = $em->getRepository(Categorie::class)->findAll();
            $series = $em->getRepository(Serie::class)->findAll();

            return $this->render('default/index.html.twig', [
                'categorie' => $categorie,
                'series' => $series,
                'add_categorie' => $form->createView()
            ]);
        }

        /**
         * @Route("/categorie/{id}", name="categorie")
         */
        public function categorie(Categorie $categorie, Request $request){
            $form = $this->createForm(CategorieType::class, $categorie);
    
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($categorie);
                $em->flush();
            }
    
            return $this->render('default/categorie.html.twig',
                array(
                    'categorie'  => $categorie,
                    'edit_form' => $form->createView()
                )
            );
        }

        /**
         * @Route("/categorie/delete/{id}", name="categorieDelete") 
         */
        public function CategorieDelete(Categorie $categorie = null){
            if($categorie != null){
                $em = $this->getDoctrine()->getManager();
                $em->remove($categorie);
                $em->flush();
            }
    
            return $this->redirectToRoute('home');
        }
    }
?>