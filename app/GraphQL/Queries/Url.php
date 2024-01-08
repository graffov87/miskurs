<?php declare(strict_types=1);

namespace App\GraphQL\Queries;
use Illuminate\Routing\UrlGenerator;

final class Url
{

    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        if ($_->type == 1) {
            return $_->url;
        } else {
            return $this->url->to("/") . "/storage/" . $_->filename;
        }
    }
}
