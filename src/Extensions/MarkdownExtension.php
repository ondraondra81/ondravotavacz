<?php

declare(strict_types=1);

namespace App\Extensions;

use App\Utils\Markdown;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class MarkdownExtension
 * @package App\Extensions
 * @author Ondra Votava <ondra@votava.dev>
 */
class MarkdownExtension extends AbstractExtension
{
    /**
     * @var Markdown parser
     */
    private $parser;

    /**
     * MarkdownExtension constructor.
     *
     * @param Markdown $parser
     */
    public function __construct(Markdown $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @return array|TwigFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter(
                'md2html',
                [$this, 'markdownToHtml'],
                [
                'is_safe' => ['html'],
                'pre_escape' => 'html',
                ]
            ),
        ];
    }

    /**
     * @param string $content
     *
     * @return string
     */
    public function markdownToHtml(string $content): string
    {
        return $this->parser->convertMarkdownToHtml($content);
    }
}
