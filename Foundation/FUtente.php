<?php

namespace Foundation;

use Entity\ERider;
use Entity\EUtente;
use Exception;

require_once 'FPersistentManager.php';
require_once 'FEntityManager.php';
require_once __DIR__ . '/../Entity/EUtente.php';

/**
 * Class FUtente - Foundation layer for user entity operations
 *
 * Provides data access and business logic methods for EUtente entities
 */
class FUtente
{
    /**
     * Verify if a user with specific attribute exists
     *
     * @param string $field The field/attribute to verify
     * @param mixed $value The value to check against
     * @return bool|null Returns:
     *                   - true if attribute exists
     *                   - false if attribute doesn't exist
     *                   - null on error
     */
    public static function verify($field, $value): ?bool
    {
        return FEntityManager::getInstance()->verifyAttributes(EUtente::class, $field, $value);
    }

    /**
     * Retrieve all users from the database
     *
     * @return array Array of EUtente entities
     * @throws Exception If database access fails
     */
    public static function getAllUsers(): array
    {
        return FEntityManager::getInstance()->getAll(EUtente::class);
    }
}