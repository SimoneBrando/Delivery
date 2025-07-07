<?php
namespace Controller;

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\BaseController;
use Delight\Auth\InvalidPasswordException;
use Doctrine\ORM\Exception\ORMException;
use Entity\ECarta_credito;
use Entity\EIndirizzo;
use Entity\EUtente;
use InvalidArgumentException;
use Services\Utility\UFlashMessage;
use View\VUser;
use Services\MailingService;
use Services\Utility\USession;
use Services\Utility\UHTTPMethods;

class CUser extends BaseController{

    //FUNZIONI PER GESTIRE L'AUTENTICAZIONE

    /**
     * Registra un nuovo utente nel sistema, assegnando un ruolo specifico e dati aggiuntivi al profilo.
     *
     * Recupera i dati dal metodo POST ('password', 'email', 'nome', 'cognome'), crea un nuovo utente tramite
     * 'auth_manager', genera un profilo del ruolo specificato, lo popola con i dati base
     * e opzionalmente con altri dati extra. Salva poi l'entità e reindirizza al login.
     *
     * @param string $role Il ruolo da assegnare all'utente (default: "Cliente"). Deve corrispondere a una classe 'Entity\E{Ruolo}' esistente.
     * @param array $extraData Array associativo di metodi e valori da invocare sull'entità, differenti in base al ruolo dell'utente.
     *
     * @throws \Exception Se la classe del ruolo non esiste o si verifica un errore generico.
     * @throws \Delight\Auth\InvalidEmailException Se l'indirizzo email non è valido.
     * @throws InvalidPasswordException Se la password è troppo debole.
     * @throws \Delight\Auth\UserAlreadyExistsException Se un utente con la stessa email è già registrato.
     * @throws \Delight\Auth\TooManyRequestsException Se ci sono troppi tentativi di registrazione.
     * @throws \Delight\Auth\UnknownIdException Se l'ID utente è sconosciuto durante il rollback manuale.
     * @throws ORMException Se si verifica un errore nel salvataggio del profilo.
     *
     * @return void
     */
    public function registerUser(string $role = 'Cliente', array $extraData = []){
        $password = UHTTPMethods::post('password');
        $email = UHTTPMethods::post('email');
        $name = UHTTPMethods::post('nome');
        $surname = UHTTPMethods::post('cognome');
        try {
            if (strlen($password) < 8) {
                throw new InvalidPasswordException("Password troppo debole");
            }
            $userId = $this->auth_manager->register(
                email: $email,
                password:  $password,
                username: $email,
                callback: null
            );
            $className = "Entity\\E" . ucfirst(strtolower($role));
            if (class_exists($className)) {
                $profile = new $className();
            } else {
                throw new Exception("Classe $className non trovata");
            }
            $profile
                ->setNome($name)
                ->setCognome($surname)
                ->setUserId($userId)
                ->setEmail($email)
                ->setPassword($password);
            foreach ($extraData as $method => $value) {
                if (method_exists($profile, $method)) {
                    $profile->$method($value);
                }
            }
            $this->persistent_manager->saveObj($profile);
            $mailService = new MailingService();
            
            $welcomeText = 'Ciao ' . $name . ',<br><br>
            Grazie per esserti registrato su Delivery!<br><br>
                        
            Ora puoi esplorare il nostro vasto menu, scegliere i tuoi piatti preferiti e riceverli comodamente dove vuoi, in tutta semplicità.<br><br>
                        
            Per iniziare, accedi con le tue credenziali: 
            <a href="https://deliveryhomerestaurant.altervista.org/Delivery/User/showProfile">Il tuo profilo Delivery</a><br><br>
                        
            Buon appetito! Il team di Delivery<br><br>
                        
            Per qualsiasi problema, contattaci all\'indirizzo email: <a href="mailto:info@homerestaurant.it">info@homerestaurant.it</a><br>
            Oppure ai nostri recapiti telefonici: 345 678 9012 -  06 1234 5678<br><br>
                        
            Il team di Delivery

            <br><br><img src="https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png" alt="Logo Delivery Home Restaurant" style="width:150px; height:auto;">
            ';


   



            
            $mailService->mailTo($email, 'Benvenuto su Delivery', $welcomeText);
            header('Location: /Delivery/User/showLoginForm');
        } catch (\Delight\Auth\InvalidEmailException $e) {
            $this->catchError("Indirizzo email non valido.", "User/showRegisterForm");
        } catch (InvalidPasswordException $e) {
            $this->catchError("Password non valida.", "User/showRegisterForm");
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            $this->catchError("Utente già registrato.", "User/showRegisterForm");
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            $this->handleFatalError($e);
        } catch (ORMException $e) {
            //Tentativo di rollback manuale
            if(isset($userId)){
                try {
                    $this->auth_manager->admin()->deleteUserById($userId);
                }
                catch (\Delight\Auth\UnknownIdException $e) {
                    die('Unknown ID');
                }
            }
            die('ORM error');
        } catch (\Delight\Auth\UnknownIdException $e) {
            $this->handleFatalError($e);
        }
    }

    /**
     * Esegue l'autenticazione dell'utente tramite email e password inviate via POST.
     *
     * Se l'utente è già autenticato (presente in sessione), viene reindirizzato alla home.
     * Altrimenti, tenta di effettuare il login tramite 'auth_manager'. Se il flag "rememberMe" è attivo,
     * la sessione persisterà per 30 giorni, altrimenti per 1 giorno. In caso di successo, salva
     * l'identificativo del profilo utente in sessione e reindirizza alla home.
     *
     * Gestisce anche i principali errori di autenticazione, mostrando messaggi appropriati.
     *
     * @throws \Delight\Auth\InvalidEmailException Se l'indirizzo email fornito non è valido.
     * @throws \Delight\Auth\InvalidPasswordException Se la password fornita è errata.
     * @throws \Delight\Auth\EmailNotVerifiedException Se l'email non è stata verificata.
     * @throws \Delight\Auth\TooManyRequestsException Se ci sono stati troppi tentativi di login.
     * @throws \Delight\Auth\AttemptCancelledException Se il tentativo è stato annullato (es. login concorrente).
     * @throws \Delight\Auth\AuthError Per altri errori generici di autenticazione.
     *
     * @return void
     */
    public function loginUser(): void {
        $email = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
        $password = UHTTPMethods::post('password');
        //Da implementare nella form di login
        $rememberMe = UHTTPMethods::post('rememberMe');
        $currentUser = USession::isSetSessionElement("user");
        if ($currentUser) {
            $user = USession::getSessionElement("user");
            header('Location: /Delivery/User/home');
            exit;
        }
        try {
            if ($rememberMe == 1) {
                //30 days
                $duration = 60*60*24*30;
            } else {
                //1 day
                $duration = 60*60*24;
            }
            $this->auth_manager->login($email, $password, $duration);
            $profile = $this->getUser();
            USession::setSessionElement("user", $profile->getId());

            header('Location: /Delivery/User/home');
            exit;
        } catch (\Delight\Auth\InvalidEmailException $e) {
            $this->catchError("Email o password errati.", "User/showLoginForm");
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            $this->catchError("Email o password errati.", "User/showLoginForm");
        } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            $this->catchError("Email non verificata.", "User/showLoginForm");
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            $this->handleFatalError($e);
        } catch (\Delight\Auth\AttemptCancelledException|\Delight\Auth\AuthError $e) {
            $this->handleFatalError($e);
        }
    }

    /**
     * Esegue il logout dell'utente corrente.
     *
     * Invalida la sessione di autenticazione tramite `auth_manager`, rimuove l'utente dalla sessione
     * e imposta un flag per il logout (utile per svuotare l'eventuale carrello nel localStorage una volta fatto il logout).
     * Infine reindirizza l'utente alla home.
     *
     * @return void
     */
    public function logoutUser(){
        $this->auth_manager->logout();
        USession::unsetSessionElement('user');
        USession::setSessionElement('logout', true);
        header('Location: /Delivery/User/home');
    }

    //-----------------------------------------------------------------------------------------------------------------------------------

    //FUNZIONI PER LA GESTIONE DEL PROFILO E DELLE INFORMAZIONI COLLEGATE

    /**
     * Permette all'utente autenticato di cambiare la propria password.
     *
     * Recupera la vecchia e la nuova password via POST, effettua la modifica tramite 'auth_manager'
     * e aggiorna anche l'entità persistente utente. In caso di errore nel salvataggio,
     * tenta un rollback della password originale.
     *
     * @throws \Delight\Auth\NotLoggedInException Se l'utente non è autenticato.
     * @throws \Delight\Auth\InvalidPasswordException Se la vecchia o nuova password non è valida.
     * @throws \Delight\Auth\TooManyRequestsException Se ci sono stati troppi tentativi di modifica.
     * @throws ORMException Se si verifica un errore durante l'aggiornamento nel database.
     *
     * @return void
     */
    public function changePassword() {
        if (!($this->isLogged())){
            header("/Delivery/User/home");
            exit;
        }
        try {
            $oldPassword = UHTTPMethods::post('oldPassword');
            $newPassword = UHTTPMethods::post('newPassword');
            $this->auth_manager->changePassword($oldPassword,$newPassword);
            $userId= $this->auth_manager->getUserId(); //recupero userId dell'utente loggato
            $client = $this->persistent_manager->getObjOnAttribute(EUtente::class,"user_id", $userId); //recupero l'oggetto Cliente relativo a quell'userId
            $client->setPassword($newPassword); //cambio della password nell'oggetto Cliente
            $this->persistent_manager->updateObj($client); //salvataggio sul database
            UFlashMessage::addMessage('success', 'Password cambiata correttamente');

              // Invio email di notifica
            $mailService = new MailingService();
            $name = htmlspecialchars($client->getNome());
            $email = $client->getEmail();

            $message = "
                <h2>La tua password è stata cambiata 🔐</h2>
                <p>Ciao <strong>$name</strong>,</p>
                <p>Ti confermiamo che la tua password è stata modificata con successo sul tuo account Delivery.</p>
                <p>Se sei stato tu ad effettuare questa modifica, non è richiesta alcuna azione.</p>
                <p>Se invece non riconosci questa attività, ti invitiamo a contattarci immediatamente:</p>
                <ul>
                    <li>Email: <a href='mailto:info@homerestaurant.it'>info@homerestaurant.it</a></li>
                    <li>Telefono: 345 678 9012 – 06 1234 5678</li>
                </ul>
                <br>
                <p>Grazie,<br>Il team di Delivery</p>
                <img src='https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png' style='width:120px; height:auto;' alt='Logo Delivery'>
            ";

            $mailService->mailTo(
                $email,
                "Conferma cambio password sul tuo account",
                $message
            );
            header("Location: /Delivery/User/showProfile");
        } catch (\Delight\Auth\NotLoggedInException $e) {
            header("Location: /Delivery/User/home");
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            $this->catchError("Passwords non valide.", "User/showProfile");
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            $this->catchError("Errore insolito, riprova più tardi.", "User/showProfile");
        } catch (ORMException $e) {
            //Tentativo di rollback manuale
            if(isset($userId)){
                try {
                    $this->auth_manager->changePassword($$newPassword,$oldPassword); //ripristino la vecchia password in caso di errore
                } catch (\Delight\Auth\InvalidPasswordException $e) {
                    $this->catchError("Passwords non valide", "User/showProfile");
                } catch (\Delight\Auth\TooManyRequestsException $e) {
                    $this->catchError("Errore insolito, riprova più tardi.", "User/showProfile");
                }
            }
            $this->handleFatalError($e);
        }
    }

    /**
     * Modifica i dati anagrafici (nome e cognome) dell'utente autenticato.
     *
     * Recupera i nuovi valori via POST e aggiorna l'entità utente associata. In caso di errore
     * durante il salvataggio, viene mostrato un messaggio di errore all'utente.
     *
     * @throws ORMException Se si verifica un errore nella persistenza dei dati.
     * @throws Exception Per errori generici durante l'operazione.
     *
     * @return void
     */
    public function modifyProfile(){
        $this->requireLogin();
        try {
            $newName = UHTTPMethods::post('newName');
            $newSurname = UHTTPMethods::post('newSurname');
            $user = $this->getUser();
            $user->setNome($newName)
                ->setCognome($newSurname);
            $this->persistent_manager->updateObj($user);
            UFlashMessage::addMessage('success', 'Modifica avvenuta con successo');
            header("Location: /Delivery/User/showProfile");
            exit;
        } catch (ORMException $e) {
            $this->catchError("Errore durante il salvataggio, riprovare.", "User/showProfile");
        } catch (Exception $e) {
            $this->catchError("Errore durante il salvataggio, riprovare.", "User/showProfile");
        }
    }

    /**
     * Rimuove l'account utente dal sistema, dato l'ID utente.
     *
     * Richiede che l'utente sia autenticato. Elimina l'utente tramite 'auth_manager' e
     * rimuove l'entità associata dal database. È pensato per uso amministrativo o per
     * supportare la cancellazione da parte dell'utente stesso.
     *
     * @param string $userId L'identificativo dell'utente da eliminare.
     *
     * @throws \Delight\Auth\UnknownIdException Se l'ID utente non è valido o non esiste.
     * @throws \Exception Se si verifica un errore generico durante l'eliminazione.
     * @throws \ArgumentCountError Se viene passato un numero errato di argomenti.
     *
     * @return void
     */
    public function removeAccount(string $userId = "") {
        try{
            $this->auth_manager->admin()->deleteUserById($userId);
        } catch (\Delight\Auth\UnknownIdException $e) {
            die('Unknown ID');
        } catch (\Exception $e) {
            die ("Unknown exception $e");
        } catch (\ArgumentCountError $e) {
            die ("Argument passed not valid");
        }
    }

    /**
     * Elimina l'account dell'utente attualmente autenticato.
     *
     * Verifica che l'utente sia loggato, esegue il logout e successivamente
     * chiama 'removeAccount()' per rimuovere l'utente dal sistema.
     * Al termine reindirizza alla home.
     *
     * @return void
     */
    public function deleteAccount(){
        $this->requireLogin();
        $userId = $this->getUserId();
        $this->logoutUser();
        $this->removeAccount($userId);
    }

    //Gestione MetodiPagamento
    public function addCreditCard(){
        $this->requireRole('cliente');
        $user = $this->getUser();
        try{
            $numeroCarta = UHTTPMethods::postInt('numero_carta',16,16);
            $nomeCarta = UHTTPMethods::post('nome_carta');
            $dataScadenza = UHTTPMethods::postDate('data_scadenza', 'm/y');
            $dataScadenza->modify('last day of this month 23:59:59');
            if($dataScadenza < (new \DateTime()) ){
                throw new InvalidArgumentException("Carta scaduta");
            }
            $cvv = UHTTPMethods::postInt('cvv',3,4);
            $nomeIntestatario = UHTTPMethods::postString('nome_intestatario');
            $creditCard =  $this->persistent_manager->getObjOnAttribute(ECarta_credito::class,'numeroCarta',$numeroCarta);
            if($creditCard){               
               $creditCard->setCartaAttiva(true);
               $this->persistent_manager->updateObj($creditCard);
               header("Location: /Delivery/User/showProfile");
               exit;
            }
            $creditCard = new ECarta_credito();
            $creditCard->setNumeroCarta($numeroCarta)
                ->setNominativo($nomeCarta)
                ->setDataScadenza($dataScadenza)
                ->setCvv($cvv)
                ->setNomeIntestatario($nomeIntestatario)
                ->setUtente($user)
                ->setCartaAttiva(true);
            $this->persistent_manager->saveObj($creditCard);
            UFlashMessage::addMessage('success', 'Metodo di pagamento aggiunto con successo');
            header("Location: /Delivery/User/showProfile");
            exit;
        } catch (\InvalidArgumentException $e) {
            $this->catchError($e->getMessage(), "User/showProfile");
        } catch (\PDOException $e) {
            error_log("Errore DB: " . $e->getMessage());
            $this->catchError("Errore durante il salvataggio, riprovare.", "Use/showProfile");
        } catch (\Throwable $th) {
            error_log("Errore generico: " . $th->getMessage());
            $this->catchError("Errore imprevisto, riprovare.", "User/showProfile");
        }
    }
    public function removeCreditCard(){
        try{
            $this->requireRole('cliente');
            $numeroCarta = UHTTPMethods::postInt('numero_carta',16,16);
            $creditCard = $this->persistent_manager->getObjOnAttribute(ECarta_credito::class, 'numeroCarta', $numeroCarta);
            if (!$creditCard) {
                throw new \InvalidArgumentException("Carta di credito non trovata.");
            }
            $creditCard->setCartaAttiva(false);
            $this->persistent_manager->updateObj($creditCard);
            UFlashMessage::addMessage('success', 'Metodo di pagamento rimosso con successo');
            header("Location: /Delivery/User/showProfile");
            exit;
        } catch (\InvalidArgumentException $e) {
            $this->catchError($e->getMessage(), "User/showProfile");
        } catch (\PDOException $e) {
            error_log("Errore DB: " . $e->getMessage());
            $this->catchError("Errore durante il salvataggio, riprovare.", "Use/showProfile");
        } catch (\Throwable $th) {
            error_log("Errore generico: " . $th->getMessage());
            $this->catchError("Errore imprevisto, riprovare.", "User/showProfile");
        }
    }

    //Gestione Indirizzi
    public function addAddress(){
        $this->requireRole('cliente');
        $user = $this->getUser();
        try {
            $via = UHTTPMethods::post('via');
            $civico = UHTTPMethods::post('civico');
            $cap = UHTTPMethods::postInt('cap',5,5);
            $citta = UHTTPMethods::postString('citta');
            $address = new EIndirizzo();
            $address->setVia($via)
                ->setCivico($civico)
                ->setCap($cap)
                ->setCitta($citta)
                ->addCliente($user);
            $this->persistent_manager->saveObj($address);
            UFlashMessage::addMessage('success', 'Indirizzo aggiunto con successo');
            header("Location: /Delivery/User/showProfile");
            exit;
        } catch (\InvalidArgumentException $e) {
            $this->catchError("Errore nei dati inseriti.", "User/showProfile");
        } catch (\PDOException $e) {
            error_log("Errore DB: " . $e->getMessage());
            $this->catchError("Errore durante il salvataggio, riprovare.", "Use/showProfile");
        } catch (\Throwable $th) {
            error_log("Errore generico: " . $th->getMessage());
            $this->catchError("Errore imprevisto, riprovare.", "User/showProfile");
        }
    }
    public function removeAddress(){
        try{
            $this->requireRole('cliente');
            $indirizzoId = UHTTPMethods::post('indirizzo_id');
            $indirizzo = $this->persistent_manager->getObjOnAttribute(EIndirizzo::class, 'id', $indirizzoId);
            if (!$indirizzo) {
                throw new \InvalidArgumentException("Indirizzo non trovato.");
            }
            $indirizzo->setAttivo(false);
            $this->persistent_manager->updateObj($indirizzo);
            UFlashMessage::addMessage('success', 'Indirizzo rimosso con successo');
            header("Location: /Delivery/User/showProfile");
            exit;
        } catch (\InvalidArgumentException $e) {
            $this->catchError($e->getMessage(),"User/showProfile");
        } catch (\PDOException $e) {
            error_log("Errore DB: " . $e->getMessage());
            $this->catchError("Errore durante il salvataggio, riprovare.", "Use/showProfile");
        } catch (\Throwable $th) {
            error_log("Errore generico: " . $th->getMessage());
            $this->catchError("Errore imprevisto, riprovare.", "User/showProfile");
        }
    }


    //-----------------------------------------------------------------------------------------------------------------------------------


    //FUNZIONI DI UTILITA' LEGATE ALL'UTENTE

    public function findActiveUserAdresses(){
        $this->requireRole('cliente');
        $user = $this->getUser();
        $addresses = $this->persistent_manager->getAllActiveAddresses();
        $userAddresses = array_filter(
            $addresses, function($address) use ($user) {
            return $address->getClienti()->contains($user);
        });
        return $userAddresses;
    }

    public function findActiveUserCards(){
        $this->requireLogin();
        $user = $this->getUser();
        $credtCards = $this->persistent_manager->getAllCreditCards();
        $userCreditCard = array_filter(
            $credtCards,
            fn($carta) => $carta->getCliente()->getId() === $user->getId() && $carta->getCartaAttiva() === true
        );
        return $userCreditCard;
    }


    //-----------------------------------------------------------------------------------------------------------------------------------


    //FUNZIONI SHOW (PER IL CAMBIO SCHERMATA)

    public function showRegisterForm(){
        if($this->isLoggedIn()){
            header('Location: /Delivery/User/home');
        }
        $messages = UFlashMessage::getMessage();
        $view = new VUser($this->isLoggedIn(), $this->userRole, $messages);
        $view->showRegisterForm();
    }

    public function showLoginForm(){
        if($this->isLoggedIn()){
            header('Location: /Delivery/User/home');
            exit;
        }
        $messages = UFlashMessage::getMessage();
        $view = new VUser($this->isLoggedIn(), $this->userRole, $messages);
        $view->showLoginForm();
    }

    public function home(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $messages = UFlashMessage::getMessage();
        $view = new VUser($this->isLoggedIn(), $this->userRole, $messages);
        $allReviews = $this->persistent_manager->getAllReviews();
        shuffle($allReviews);
        $reviews = array_slice($allReviews, 0, 3);
        //Per la rimuozione del carrello dal localStorage dopo un logout
        if (USession::isSetSessionElement('logout')) {
            $logout = USession::getSessionElement('logout');
            USession::unsetSessionElement('logout');
        } else {
            $logout = false;
        }
        $view->showHome($reviews, $logout);
    }

    public function mostraMenu(){
        $view = new VUser($this->isLoggedIn(), $this->userRole);
        $menu = $this->persistent_manager->getMenu();
        $view->showMenu($menu);
    }

    public function getMenuJson() {
    $menu = $this->persistent_manager->getMenu();
    header('Content-Type: application/json');
    echo json_encode($menu); // Assicurati che sia serializzabile
    exit;
}


    public function order(){
        $view = new VUser($this->isLoggedIn(), $this->userRole);
        $menu = $this->persistent_manager->getMenu();
        $view->order($menu);
    }
    public function showMyOrders(){
        $this->requireRole('cliente');
        $messages = UFlashMessage::getMessage();
        $view = new VUser($this->isLoggedIn(), $this->userRole, $messages);
        $id = $this->getUser()->getId();
        $orders = $this->persistent_manager->getOrdersByClient($id);
        $view->showMyOrders($orders);
    }

    public function showProfile(){
        $this->requireLogin();
        $user = $this->getUser();
        $messages = UFlashMessage::getMessage();
        $userAddresses = ($user->getRuolo() == "cliente") ? $this->findActiveUserAdresses() : [];
        $userCreditCards = ($user->getRuolo() == "cliente") ? $this->findActiveUserCards() : []; 
        $view = new VUser($this->isLoggedIn(), $this->userRole, $messages);
        $view->showChangePassword($user, $userAddresses, $userCreditCards);
    }

    public function showReviewForm(){
        $this->requireRole('cliente');
        $view = new VUser($this->isLoggedIn(), $this->userRole);
        $view->showReviewForm();
    }


    //-----------------------------------------------------------------------------------------------------------------------------------


    //FORGOT PASSWORD DA TESTARE
    
    //Quando l'utente non ricorda la password
    //Step 1 of 3: Initiating the request
    public function forgotPassword() {
        if($this->isLogged()){
            header('Location: /Delivery/User/home');
            exit;
        }
        $view = new VUser($this->isLoggedIn(), $this->userRole);
        $view->showForgotPasswordForm();


        $email = UHTTPMethods::post('email');
        try {
            
            $this->auth_manager->forgotPassword($email, function ($selector, $token) use ($email) {
                // Costruisci il link di reset password
                $url = 'https://www.delivery.com/reset_password?selector=' . urlencode($selector) . '&token=' . urlencode($token);
                //Da definire le variabili d'ambiente
                $mailService = new MailingService();
                $message = "
                    <h2>Richiesta di reset password</h2>
                    <p>Ciao,</p>
                    <p>Hai richiesto il reset della tua password su Delivery. Clicca sul link qui sotto per procedere:</p>
                    <p><a href='$url'>Resetta la tua password</a></p>
                    <p>Se non hai richiesto questo cambiamento, ignora questa email.</p>
                    <br>
                    <p>Grazie,<br>Il team di Delivery</p>
                    <img src='https://deliveryhomerestaurant.altervista.org/Smarty/Immagini/logo.png' style='width:120px; height:auto;' alt='Logo Delivery'>
                ";
                $mailService->mailTo($email, 'Resetta la tua password su Delivery', $message);

                
                
            });
            
            UFlashMessage::addMessage('success', 'Una email è stata inviata al tuo account per resettare la password');

            exit;
        } catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        } catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        } catch (\Delight\Auth\ResetDisabledException $e) {
            die('Password reset is disabled');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        } catch(Exception $e) {
            die($e->errorMessage());
        }
    }
    
    //Step 2 of 3: Verifying an attempt
    public function showResetPasswordForm() {
        if ($this->auth_manager->canResetPassword($_GET['selector'], $_GET['token'])) {
            echo '<form method="post" action="/Delivery/User/resetPassword">';
            echo '<input type="hidden" name="selector" value="' . htmlspecialchars($_GET['selector']) . '">';
            echo '<input type="hidden" name="token" value="' . htmlspecialchars($_GET['token']) . '">';
            echo '<label>New Password:</label>';
            echo '<input type="password" name="password">';
            echo '<button type="submit">Reset Password</button>';
            echo '</form>';
        }
    }

    //Step 3 of 3: Updating the password
    public function resetPassword() {
        $selector = UHTTPMethods::post('selector');
        $token = UHTTPMethods::post('token');
        $newPassword = UHTTPMethods::post('password');
        try {
            $this->auth_manager->resetPasswordAndSignIn($selector, $token, $newPassword);
            echo 'Password has been reset';
            $userId= $this->auth_manager->getUserId(); //recupero userId dell'utente che si è appena loggato cambiando password
            $client = $this->persistent_manager->getObjOnAttribute("Cliente","user_id", $userId); //recupero l'oggetto Cliente relativo a quell'userId
            $oldPassword = $client->getPassword(); //recupero la vecchia password del Cliente (al fine di eseguire un rollback manuale se necessario)
            $client->setPassword($newPassword); //cambio della password nell'oggetto Cliente
            $this->persistent_manager->updateObj($client); //salvataggio sul database
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            die('Invalid token');
        } catch (\Delight\Auth\TokenExpiredException $e) {
            die('Token expired');
        } catch (\Delight\Auth\ResetDisabledException $e) {
            die('Password reset is disabled');
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password');
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        } catch (ORMException $e) {
            //Tentativo di rollback manuale
            if(isset($userId)){
                try {
                    $this->auth_manager->changePassword($newPassword,$oldPassword); //ripristino la vecchia password in caso di errore
                } catch (\Delight\Auth\InvalidPasswordException $e) {
                    die('Invalid password(s)');
                } catch (\Delight\Auth\TooManyRequestsException $e) {
                    die('Too many requests');
                }
            }
            die('ORM error');
        }
    }
    
}