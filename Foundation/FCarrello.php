<?php 

namespace Foundation;

use Entity\ECarrello;
use Entity\EItemCarrello;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/ECarta_credito.php';

class FCarrello
{
    /**
     * @param int $clientId
     * @return ECarrello|null
     * @throws Exception
     */
    public static function getCartByClientId(int $clientId): ?ECarrello
    {
        return FEntityManager::getInstance()->getObjOnAttribute(ECarrello::class, 'cliente' ,$clientId);
    }

    /**
     * @param ECarrello $cart
     * @param EItemCarrello $item
     * @return void
     * @throws Exception
     */
    public static function addOrUpdateItemToCart(ECarrello $cart, EItemCarrello $item): void
    {
        foreach ($cart->getCarrelloItems() as $itemCart) {
            if ($itemCart->getProdotto()->getId() === $item->getProdotto()->getId()) {
                $itemCart->setQuantita($itemCart->getQuantita() + $item->getQuantita());
                FEntityManager::getInstance()->updateObj($itemCart);
                return;
            }
        }


        FEntityManager::getInstance()->saveObj($item);
    }

    /**
     * @param int $cartId
     * @param EItemCarrello $item
     * @return void
     * @throws Exception
     */
    public static function removeOrUpdateItemFromCart(int $cartId, EItemCarrello $item): void
    {
        $cart = FEntityManager::getInstance()->getObj(ECarrello::class, $cartId);
        foreach ($cart->getCarrelloItems() as $itemCart) {
            if ($itemCart->getProdotto()->getId() === $item->getProdotto()->getId()) {
                $q = $itemCart->getQuantita();
                $q_r = $item->getQuantita();

                if ($q_r >= $q) {
                    FEntityManager::getInstance()->deleteObj($itemCart);
                } else {
                    $itemCart->setQuantita($q - $q_r);
                    FEntityManager::getInstance()->updateObj($itemCart);
                }

                break;
            }
        }
    }
}