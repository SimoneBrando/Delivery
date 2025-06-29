<?php
namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use Entity\ERecensione;
use Services\Utility\UHTTPMethods;
use View\VErrors;

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
                ->setData(new \DateTime());
            $this->persistent_manager->saveObj($review);
            header("Location: /Delivery/User/showMyOrders");
            exit;
        } catch (\InvalidArgumentException $e) {
            $this->catchError($e->getMessage(), "User/showMyOrders");
        } catch (\PDOException $e) {
            error_log("Errore DB: " . $e->getMessage());
            $this->catchError("Errore durante il salvataggio, riprovare.", "User/showMyOrders");
        } catch (\Throwable $th) {
            error_log("Errore generico: " . $th->getMessage());
            $this->catchError("Errore imprevisto, riprovare.", "User/showMyOrders");
        }
    }
}