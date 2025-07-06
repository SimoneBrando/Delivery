<?php
namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use Entity\ERecensione;
use Services\Utility\UFlashMessage;
use Services\Utility\UHTTPMethods;
use Services\MailingService;

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



            
            // ✅ Invia email di conferma
            $email = $user->getEmail();

            $nome = htmlspecialchars($user->getNome());
            $descrizione = htmlspecialchars($description);
            $voto = htmlspecialchars($vote);


            $message = "
                <h2>Grazie per la tua recensione!</h2>
                <p>Ciao $nome,</p>
                <p>Abbiamo ricevuto la tua recensione con successo:</p>
                <ul>
                    <li><strong>Descrizione:</strong> $descrizione</li>
                    <li><strong>Voto:</strong> $voto</li>
                </ul>
                <p>Il tuo feedback è importante per noi.</p>
                <p>Grazie,<br>Il team di Delivery</p>
                 <img src='https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png' style='width:120px; height:auto;' alt='Logo Delivery'>
            ";

            $mailer = new MailingService();
            $mailer->mailTo($email, 'Conferma recensione - Delivery', $message);



            UFlashMessage::addMessage('success', 'Recensione aggiunta con successo');
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