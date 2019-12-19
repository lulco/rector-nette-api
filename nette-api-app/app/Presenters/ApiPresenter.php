<?php

namespace App\AdminModule\Presenters;

use Nette\Application\UI\Presenter;
use Tomaj\NetteApi\ApiDecider;
use Tomaj\NetteApi\Component\ApiConsoleControl;
use Tomaj\NetteApi\Component\ApiListingControl;

class ApiPresenter extends Presenter
{
    /** @var ApiDecider */
    public $apiDecider;

    private $method;

    private $version;

    private $package;

    private $apiAction;

    public function __construct(ApiDecider $apiDecider)
    {
        parent::__construct();
        $this->apiDecider = $apiDecider;
    }

    public function actionShow(string $method, int $version, string $package, ?string $apiAction)
    {
        $this->method = $method;
        $this->version = $version;
        $this->package = $package;
        $this->apiAction = $apiAction;
    }

    protected function createComponentApiListing(): ApiListingControl
    {
        $apiListing = new ApiListingControl($this, 'apiListingControl', $this->apiDecider);
        $apiListing->onClick(function ($method, $version, $package, $apiAction) {
            $this->redirect('Api:show', $method, $version, $package, $apiAction);
        });
        return $apiListing;
    }

    protected function createComponentApiConsole(): ApiConsoleControl
    {
        $api = $this->apiDecider->getApiHandler($this->method, $this->version, $this->package, $this->apiAction);
        return new ApiConsoleControl($this->getHttpRequest(), $api['endpoint'], $api['handler'], $api['authorization']);
    }
}
