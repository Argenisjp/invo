<?php

use Phalcon\Mvc\View;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;

class Services extends \Base\Services
{
    /**
     * Registramos al gestor de eventos
     */
    protected function initDispatcher()
    {
        $eventsManager = new EventsManager;

        /**
         * Compruebe si el usuario tiene permiso para acceder a determinada acción utilizando       SecurityPlugin
         */
        $eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin);

        /**
         * Manejar excepciones y excepciones no encontradas usando NotFoundPlugin
         */
        $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

        $dispatcher = new Dispatcher;
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    }

    /**
     * El componente URL se utiliza para generar todo tipo de URL en la aplicación.
     */
    protected function initUrl()
    {
        $url = new UrlProvider();
        $url->setBaseUri($this->get('config')->application->baseUri);
        return $url;
    }

    protected function initView()
    {
        $view = new View();

        $view->setViewsDir(APP_PATH . $this->get('config')->application->viewsDir);

        $view->registerEngines([
            ".volt" => 'volt'
        ]);

        return $view;
    }

    /**
     * Configuración de voltios
     */
    protected function initSharedVolt($view, $di)
    {
        $volt = new VoltEngine($view, $di);

        $volt->setOptions([
            "compiledPath" => APP_PATH . "cache/volt/"
        ]);

        $compiler = $volt->getCompiler();
        $compiler->addFunction('is_a', 'is_a');

        return $volt;
    }

    /**
     * La conexión a la base de datos se crea en base a los parámetros definidos en el archivo de configuración.
     */
    protected function initSharedDb()
    {
        $config = $this->get('config')->get('database')->toArray();

        $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
        unset($config['adapter']);

        return new $dbClass($config);
    }

    /**
     * Si la configuración especifica el uso del adaptador de metadatos, utilícelo o utilice la memoria de otro modo

     */
    protected function initModelsMetadata()
    {
        return new MetaData();
    }

    /**
     * 
     * Inicie la sesión la primera vez que algún componente solicite el servicio de sesión
     */
    protected function initSession()
    {
        $session = new SessionAdapter();
        $session->start();
        return $session;
    }

    /**
     * Registre el servicio flash con clases CSS personalizadas
     */
    protected function initFlash()
    {
        return new FlashSession([
            'error' => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice' => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]);
    }

    /**
     * Registrar un componente de usuario
     */
    protected function initElements()
    {
        return new Elements();
    }
}
