<?php

use Controller\BaseController;
use Entity\ERecensione;
use Utility\UHTTPMethods;
use View\VErrors;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Entity/ERecensione.php';
require_once __DIR__ . '/../services/utility/UHTTPMethods.php';
require_once __DIR__ . '/../View/VErrors.php';

class CRecensione extends BaseController{

    public function writeReview(){
        $this->requireRole('cliente');
        $user = $this->getUser();
        try{
            $description = UHTTPMethods::postString('description');
            $vote = UHTTPMethods::postInt('vote',1,1,0,5);
            $review = new ERecensione();
            $review->setCliente($user)
                ->setDescrizione($description)
                ->setVoto($vote)
                ->setData(new DateTime());
            $this->persistent_manager->saveObj($review);
            header("Location: /Delivery/User/showProfile");
            exit;
        } catch (InvalidArgumentException $e) {
            $view = new VErrors();
            $view->showFatalError($e->getMessage());
        } catch (\PDOException $e) {
            error_log("Errore DB: " . $e->getMessage());
            $view = new VErrors();
            $view->showFatalError("Errore durante il salvataggio");
        } catch (\Throwable $th) {
            error_log("Errore generico: " . $th->getMessage());
            $view = new VErrors();
            $view->showFatalError("Errore imprevisto".$th->getMessage());
        }
    }
}