<?php

namespace App\Twig;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_param', [$this, 'getParam']),
        ];
    }

    public function getParam($name)
    {
        return $this->container->getParameter($name);
    }
}
