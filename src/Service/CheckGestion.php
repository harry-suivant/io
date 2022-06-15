<?php

namespace App\Service;

use App\Entity\ActionCheck;
use App\Entity\RoadmapCheck;
use App\Entity\StepCheck;
use Doctrine\ORM\EntityManagerInterface;

class CheckGestion
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function checkAction(
        ActionCheck $actionCheck
    ): void {
        if ($actionCheck->getStepCheck()) {
            $stepCheck = $actionCheck->getStepCheck();

            if (CheckGestion::isAllActionCheck($stepCheck)) {
                $stepCheck->setIsComplete(true);
                if ($stepCheck->getRoadmapCheck()) {
                    $raodmapCheck = $stepCheck->getRoadmapCheck();
                    if (CheckGestion::isAllStepCheck($raodmapCheck)) {
                        $raodmapCheck->setIsComplete(true);
                    }
                }
                $this->entityManager->flush();
            }
        }
    }

    public static function isAllActionCheck(StepCheck $stepCheck): bool
    {
        $actionChecks = $stepCheck->getActionChecks();
        foreach ($actionChecks as $actionCheck) {
            if (!$actionCheck->getIsComplete()) {
                return false;
            }
        }
        return true;
    }

    public static function isAllStepCheck(RoadmapCheck $roadmapCheck): bool
    {
        $stepChecks = $roadmapCheck->getStepChecks();
        foreach ($stepChecks as $stepCheck) {
            if (!$stepCheck->getIsComplete()) {
                return false;
            }
        }
        return true;
    }
}
