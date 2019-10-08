<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 08/10/2019
 * Time: 10:01
 */

namespace App\Listener;


use App\Entity\User;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class EntitiesListener
{
    /**
     * Cette classe est enregistré comme service et écoute les
     * événements doctrine lifecyclecallbacks pour toutes les entités
     *
     * Attention : si vous avez également défini les cycles dans l'entité, les deux sont appelés
     * D'abord le prePersist de l'entité, puis le prePersist du service
     */
    public function prePersist(LifecycleEventArgs $args) {
        // on récupère l'instance concernée de cette manière
        $entity = $args->getObject();
        // si besoin on récupère l'entity manager
        $em = $args->getObjectManager();

        if (method_exists($entity, 'setCreatedAt')) {
            $now = new \DateTime();
            $entity->setCreatedAt($now);
        }

        // pour faire un traitement seulement sur les Users :
        if ($entity instanceof User) {

        }
    }

    public function preUpdate(LifecycleEventArgs $args) {
        // on récupère l'instance concernée de cette manière
        $entity = $args->getObject();

        if (method_exists($entity, 'setUpdatedAt')) {
            $now = new \DateTime();
            $entity->setUpdatedAt($now);
        }
    }
}