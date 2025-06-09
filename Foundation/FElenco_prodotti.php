<?php

namespace Foundation;

use Doctrine\ORM\Exception\NotSupported;
use Entity\ECategoria;
use Entity\EElenco_prodotti;
use Entity\EUtente;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EElenco_prodotti.php';


/**
 * Class FElenco_prodotti - Foundation layer for product listings
 *
 * Handles operations related to product listings and menu structure
 * Provides methods to retrieve and organize menu data
 */
class FElenco_prodotti
{

    /**
     * Retrieves the complete menu structure with categories and dishes
     *
     * The menu is organized by categories, each containing an array of dishes
     * with their details (id, name, description, and cost)
     *
     * @return array Hierarchical menu structure in the format:
     * [
     *     [
     *         'categoria' => string,
     *         'piatti' => [
     *             [
     *                 'id' => int,
     *                 'nome' => string,
     *                 'descrizione' => string,
     *                 'costo' => float
     *             ],
     *             ...
     *         ]
     *     ],
     *     ...
     * ]
     *
     * @throws Exception If database access fails or query execution errors occur
     * @throws NotSupported If ORM operations are not supported
     */
    public static function getMenu(): array
    {

        $categorie = FEntityManager::getInstance()::getEntityManager()->getRepository(ECategoria::class)->findAll();;



        $menu = [];

        foreach ($categorie as $cat){
            $piattiArray = [];

            foreach ($cat->getPiatti() as $piatto) {
                $piattiArray[] = [
                    'id' => $piatto->getId(),
                    'nome' => $piatto->getNome(),
                    'descrizione' => $piatto->getDescrizione(),
                    'costo' => $piatto->getCosto()
                ];
            }

            $menu[] = [
                'categoria' => $cat->getNome(),
                'piatti' => $piattiArray
            ];
        }

        return $menu;
    }

}
