<?php

namespace Sonata\SeoBundle\Tests\Seo;

use PHPUnit\Framework\TestCase;
use Sonata\SeoBundle\Seo\SeoAwareTrait;
use Sonata\SeoBundle\Seo\SeoPageInterface;

class SeoAwareTraitTest extends TestCase
{
    public function testSetSeoPage(): void
    {
        $implementation = new SeoAwareTraitImplementation();
        $this->assertNull($implementation->getSeoPage());
        $implementation->setSeoPage($this->createMock(SeoPageInterface::class));
        $this->assertInstanceOf(SeoPageInterface::class, $implementation->getSeoPage());
    }
}

class SeoAwareTraitImplementation
{
    use SeoAwareTrait;

    public function getSeoPage(): ?SeoPageInterface
    {
        return $this->seoPage;
    }
}
