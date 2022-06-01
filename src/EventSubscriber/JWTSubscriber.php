<?php

namespace App\EventSubscriber;

use App\Entity\Etablissement;
use App\Entity\Professeur;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class JWTSubscriber implements EventSubscriberInterface
{
    public function onLexikJwtAuthenticationOnJwtCreated(JWTCreatedEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if ($user instanceof User) {
            $data["id"] = $user->getId();
            $data['roles'] = $user->getRoles()[0];
            $data['email'] = $user->getEmail();

            if ($user->getProfesseurs()->count() > 0) {
                $data['professeurs'] = $user->getProfesseurs()[0]->getId();
                if ($user->getProfesseurs()[0]->getEtablissements()->count() > 0) {
                    $etablissements = [];
                    foreach ($user->getProfesseurs()[0]->getEtablissements() as $unEtablissement) {
                        $etablissements[] = ["id" => $unEtablissement->getId(), "nom" => $unEtablissement->getNom()];
                    }
                    $data['etablissements'] = $etablissements;
                }
            } elseif ($user->getEleves()->count() > 0) {
                $data['eleves'] = $user->getEleves()[0]->getId();
                if ($user->getEleves()[0]->getEtablissement()->count() > 0) {
                    $etablissements = [];
                    foreach ($user->getEleves()[0]->getEtablissement() as $unEtablissement) {
                        $etablissements[] = ["id" => $unEtablissement->getId(), "nom" => $unEtablissement->getNom()];
                    }
                    $data['etablissements'] = $etablissements;
                }
            }
        }
        $event->setData($data);
    }

    public static function getSubscribedEvents()
    {
        return [
            'lexik_jwt_authentication.on_jwt_created' => 'onLexikJwtAuthenticationOnJwtCreated',
        ];
    }
}