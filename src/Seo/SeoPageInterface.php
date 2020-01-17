<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\SeoBundle\Seo;

interface SeoPageInterface
{
    /**
     * @param string $title
     *
     * @return SeoPageInterface
     */
    public function setTitle(string $title): void;

    /**
     * @param string $title
     *
     * @return SeoPageInterface
     */
    public function addTitle(string $title): void;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $type
     * @param string $name
     * @param string $value
     *
     * @param array $extras
     * @return mixed
     */
    public function addMeta(string $type, string $name, string $value, array $extras = []): void;

    /**
     * @param string $type
     * @param string $name
     *
     * @return bool
     */
    public function hasMeta(string $type, string $name): bool;

    /**
     * @return array
     */
    public function getMetas(): array;

    /**
     * @param array $metas
     * @return void
     */
    public function setMetas(array $metas): void;

    /**
     * @param array $attributes
     * @return void
     */
    public function setHtmlAttributes(array $attributes): void;

    /**
     * @param string $name
     * @param string $value
     *
     * @return SeoPageInterface
     */
    public function addHtmlAttributes(string $name, string $value): void;

    /**
     * @return array
     */
    public function getHtmlAttributes(): array;

    /**
     * @param array $attributes
     * @return void
     */
    public function setHeadAttributes(array $attributes): void;

    /**
     * @param string $name
     * @param string $value
     *
     * @return SeoPageInterface
     */
    public function addHeadAttribute(string $name, string $value): void;

    /**
     * @return array
     */
    public function getHeadAttributes(): array;

    /**
     * @param string $link
     *
     * @return SeoPageInterface
     */
    public function setLinkCanonical(string $link): void;

    /**
     * @return string
     */
    public function getLinkCanonical(): string;

    /**
     * @param string $separator
     *
     * @return SeoPageInterface
     */
    public function setSeparator(string $separator): void;

    /**
     * @param array $langAlternates
     * @return void
     */
    public function setLangAlternates(array $langAlternates): void;

    /**
     * @param string $href
     * @param string $hrefLang
     *
     * @return SeoPageInterface
     */
    public function addLangAlternate(string $href, string $hrefLang): void;

    /**
     * @return array
     */
    public function getLangAlternates(): array;

    /**
     * @param $title
     * @param $link
     *
     * @return SeoPageInterface
     */
    public function addOEmbedLink(string $title, string $link): void;

    /**
     * @return array
     */
    public function getOEmbedLinks(): array;
}
