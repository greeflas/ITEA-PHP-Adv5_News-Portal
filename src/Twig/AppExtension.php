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
            new TwigFunction('parse_url', [$this, 'parseUrl'], ['is_safe' => ['html']])
        ];
    }

    public function getParam($name)
    {
        return $this->container->getParameter($name);
    }

    public function parseUrl(string $text): string
    {
        return \preg_replace(
            '/(http[s]?:\/\/[a-zA-Z0-9\.:\/]+)/',
            '<a href="$1" target="_blank">$1</a>',
            $text
        );
    }
}
