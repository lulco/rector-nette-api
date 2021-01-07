# Rector for nette-api

## Installation

```shell
git clone git@github.com:lulco/rector-nette-api.git
cd rector-nette-api/external-rules
composer install
cd ../nette-api-app
composer install
```

## Executing rector
vendor/bin/rector process app --autoload-file app/bootstrap.php -vvv

## Output

```
2 files with changes
====================

1) app/Api/V1/Handler/TestHandler.php

   ---------- begin diff ----------
   --- Original
   +++ New
   @@ -16,7 +16,7 @@
   ];
   }

-    public function handle($params)
+    public function handle(array $params): \Tomaj\NetteApi\Response\ResponseInterface
     {
     return new JsonApiResponse(200, $params);
     }
     ----------- end diff -----------


Applied rules:

* Rector\Generic\Rector\ClassMethod\ArgumentDefaultValueReplacerRector
* Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector
* Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector


2) app/Presenters/ApiPresenter.php

   ---------- begin diff ----------
   --- Original
   +++ New
   @@ -45,7 +45,7 @@

   protected function createComponentApiConsole(): ApiConsoleControl
   {
-        $api = $this->apiDecider->getApiHandler($this->method, $this->version, $this->package, $this->apiAction);
+        $api = $this->apiDecider->getApi($this->method, $this->version, $this->package, $this->apiAction);
         return new ApiConsoleControl($this->getHttpRequest(), $api['endpoint'], $api['handler'], $api['authorization']);
  }
  }
  ----------- end diff -----------


Applied rules:

* Rector\Renaming\Rector\MethodCall\RenameMethodRector
```

## Problem

As you can see "global" rules like RenameMethodRector, AddParamTypeDeclarationRector and AddReturnTypeDeclarationRector are used also those registered in external-rules directory
`external-rules/vendor/efabrica/rector-tomaj-nette-api/src/Sets/tomaj-nette-api-1.x.x-2.0.0.php`. But Rectors defined in this directory are not used - even with AUTOLOAD_PATHS set.

Autoload paths are correctly passed to AdditionalAutoloader but they are not loaded