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

use RuntimeException;

/**
 * http://en.wikipedia.org/wiki/Meta_element.
 */
class SeoPage implements SeoPageInterface
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var array
     */
    protected $metas;

    /**
     * @var array
     */
    protected $htmlAttributes;

    /**
     * @var string
     */
    protected $linkCanonical;

    /**
     * @var string
     */
    protected $separator;

    /**
     * @var array
     */
    protected $headAttributes;

    /**
     * @var array
     */
    protected $langAlternates;

    /**
     * @var array
     */
    protected $oEmbedLinks;

    /**
     * @param string $title
     */
    public function __construct($title = '')
    {
        $this->title = $title;
        $this->metas = [
            'http-equiv' => [],
            'name' => [],
            'schema' => [],
            'charset' => [],
            'property' => [],
        ];

        $this->htmlAttributes = [];
        $this->headAttributes = [];
        $this->linkCanonical = '';
        $this->separator = ' ';
        $this->langAlternates = [];
        $this->oEmbedLinks = [];
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * {@inheritdoc}
     */
    public function addTitle(string $title): void
    {
        $this->title = $title . $this->separator . $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetas(): array
    {
        return $this->metas;
    }

    /**
     * {@inheritdoc}
     */
    public function addMeta(string $type, string $name, string $content, array $extras = []): void
    {
        if (!is_string($content)) {
            @trigger_error(sprintf(
                'Passing meta content of type %s in %s is deprecated since version 2.x and will be unsupported in version 3. Please cast the value to a string first.',
                gettype($content),
                __METHOD__
            ), E_USER_DEPRECATED);
        }

        if (!isset($this->metas[$type])) {
            $this->metas[$type] = [];
        }

        $this->metas[$type][$name] = [$content, $extras];
    }

    /**
     * @param string $type
     * @param string $name
     *
     * @return bool
     */
    public function hasMeta(string $type, string $name): bool
    {
        return isset($this->metas[$type][$name]);
    }

    /**
     * @param string $type
     * @param string $name
     *
     * @return $this
     */
    public function removeMeta(string $type, string $name)
    {
        unset($this->metas[$type][$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function setMetas(array $metaData): void
    {
        $this->metas = [];

        foreach ($metaData as $type => $metas) {
            if (!is_array($metas)) {
                throw new RuntimeException('$metas must be an array');
            }

            foreach ($metas as $name => $meta) {
                [$content, $extras] = is_string($meta) ? [$meta, []] : $meta;

                $this->addMeta($type, $name, $content, $extras);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setHtmlAttributes(array $attributes): void
    {
        $this->htmlAttributes = $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function addHtmlAttributes(string $name, string $value): void
    {
        $this->htmlAttributes[$name] = $value;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function removeHtmlAttributes(string $name): void
    {
        unset($this->htmlAttributes[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function getHtmlAttributes(): array
    {
        return $this->htmlAttributes;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasHtmlAttribute(string $name): bool
    {
        return isset($this->htmlAttributes[$name]);
    }

    /**
     * @param array $attributes
     * @return void
     */
    public function setHeadAttributes(array $attributes): void
    {
        $this->headAttributes = $attributes;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return SeoPageInterface
     */
    public function addHeadAttribute(string $name, string $value): void
    {
        $this->headAttributes[$name] = $value;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function removeHeadAttribute(string $name): void
    {
        unset($this->headAttributes[$name]);
    }

    /**
     * @return array
     */
    public function getHeadAttributes(): array
    {
        return $this->headAttributes;
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function hasHeadAttribute(string $name): bool
    {
        return isset($this->headAttributes[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function setLinkCanonical(string $link): void
    {
        $this->linkCanonical = $link;
    }

    /**
     * {@inheritdoc}
     */
    public function getLinkCanonical(): string
    {
        return $this->linkCanonical;
    }

    /**
     * {@inheritdoc}
     */
    public function removeLinkCanonical(): void
    {
        $this->linkCanonical = '';
    }

    /**
     * {@inheritdoc}
     */
    public function setSeparator(string $separator): void
    {
        $this->separator = $separator;
    }

    /**
     * {@inheritdoc}
     */
    public function setLangAlternates(array $langAlternates): void
    {
        $this->langAlternates = $langAlternates;
    }

    /**
     * {@inheritdoc}
     */
    public function addLangAlternate(string $href, string $hrefLang): void
    {
        $this->langAlternates[$href] = $hrefLang;
    }

    /**
     * @param string $href
     */
    public function removeLangAlternate(string $href): void
    {
        unset($this->langAlternates[$href]);
    }

    /**
     * @param string $href
     * @return bool
     */
    public function hasLangAlternate(string $href): bool
    {
        return isset($this->langAlternates[$href]);
    }

    /**
     * {@inheritdoc}
     */
    public function getLangAlternates(): array
    {
        return $this->langAlternates;
    }

    /**
     * @param $title
     * @param $link
     */
    public function addOEmbedLink(string $title, string $link): void
    {
        $this->oEmbedLinks[$title] = $link;
    }

    /**
     * @return array
     */
    public function getOEmbedLinks(): array
    {
        return $this->oEmbedLinks;
    }
}
