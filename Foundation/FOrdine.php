<?php 


namespace Foundation;
use DateTime;
use Entity\ECliente;
use Entity\EOrdine;
use Entity\EUtente;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EOrdine.php';


class FOrdine{
    /**
     * @return array
     * @throws Exception
     * method which return all orders
     */
    public static function getAllOrders(): array
    {
        return FEntityManager::getInstance()->getAll(EOrdine::class);
    }

    /**
     * @param $value
     * @return array
     * method which return all orders made by a specified client
     * @throws Exception
     */
    public static function getOrdersByClient($value): array
    {
        $client = FEntityManager::getInstance()->getObj(ECliente::class, $value);
        return $client->getOrdini()->toArray();
    }

    /** Retrieve all orders with a specified state
     * @param $value
     * @return array
     */
    public static function getOrdersByState($value): array
    {
        return FEntityManager::getInstance()->getObjListOnAttribute(EOrdine::class,'stato',$value );
    }

    /** Retrieve all orders of a specied date
     * @param $value
     * @return array
     */
    public static function getOrdersByDate($value): array
    {
        return FEntityManager::getInstance()->getObjListOnAttribute(EOrdine::class,'dataEsecuzione',$value );
    }

    /**
     * Retrieve all daily orders
     * @param $time
     * @return array
     */
    public static function getDailyOrders($time): array
    {
        $inizio = (clone $time)->setTime(0,0,0);
        $fine = (clone $time)->setTime(23,59,59); //I need to convert a timestamp into a DateTime to fit into Doctrine db
        return FEntityManager::getInstance()->getObjListBetween(EOrdine::class,'dataEsecuzione', [$inizio,$fine]);
    }

    public static function getOrdersByRider($riderId): array
    {
        $rider = FEntityManager::getInstance()->getObj(EUtente::class, $riderId);
        $riderId = $rider->getId();
        $orders = FEntityManager::getInstance()->getObjListOnAttribute(EOrdine::class, 'riderConsegna', $riderId);
        return $orders;
    }

    public static function getOrdersByStateNotMine($state, $userId): array
    {
        $orders = FEntityManager::getInstance()->getObjListOnAttribute(EOrdine::class, 'stato', $state);
        return array_filter($orders, function($order) use ($userId) {
            return $order->getRiderConsegna() === null || $order->getRiderConsegna()->getId() !== $userId;
        });
    }





}






