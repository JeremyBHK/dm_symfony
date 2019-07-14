<?php 
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\Serie;
    use App\Form\SerieType;
    use Symfony\Contracts\Translation\TranslatorInterface;

    use Symfony\Component\HttpFoundation\Request;

    /**
     * @Route("/serie")
     */
    class SerieController extends AbstractController{
        /**
         * @Route("/", name="series")
         */
        public function index(Request $request){
            $em = $this->getDoctrine()->getManager();

            $serie = new Serie();
            $form = $this->createForm(SerieType::class, $serie);

            $form->handleRequest($request);

            if($form->isSubmitted()){

                $img = $form['img']->getData(); // Je dois récupérer la photo comme ça maintenant parce qu'elle n'est plus associée à l'entité
    
                if($img) { // Vu que la photo est facultative, je test d'abord si elle a été uploadée
                    $fileName = uniqid().'.'.$img->guessExtension();
    
                    $img->move(
                        'uploads',
                        $fileName
                    );
        
                    $serie->setImg($fileName);
                }
    
                $em->persist($serie);
                $em->flush();
            }

            $series = $em->getRepository(Serie::class)->findAll();

            return $this->render('serie/index.html.twig', [
                'series'     => $series,
                'add_serie'  => $form->createView()
            ]);
        }

        /**
         * @Route("/{id}", name="serie")
         */
        public function serie(Serie $serie, Request $request){
            $em = $this->getDoctrine()->getManager();
    
            $form = $this->createForm(SerieType::class, $serie);
    
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
    
                $img = $form['img']->getData();
    
                if($img) {
                    $fileName = uniqid().'.'.$img->guessExtension();
    
                    $img->move(
                        'uploads',
                        $fileName
                    );
    
                    if(!empty($serie->getImg())){ // Si l'utilisateur a déjà une photo, je la supprime du serveur
                        unlink('uploads/'.$serie->getImg());
                    }
        
                    $serie->setImg($fileName);
                }
    
                $em->persist($serie);
                $em->flush();
            }
    
            return $this->render('serie/serie.html.twig', [
                'serie'      => $serie,
                'edit_form' => $form->createView()
            ]);
        }

        /**
         * @Route("/delete/{id}", name="serieDelete")
         */
        public function serieDelete(Serie $serie){
            $em = $this->getDoctrine()->getManager();
            $em->remove($serie);
            $em->flush();

            return $this->redirectToRoute('series');
        }
    }
?>