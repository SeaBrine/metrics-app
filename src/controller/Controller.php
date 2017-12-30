<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 16:42
 */

namespace Metrics\Controller;


use Metrics\Views\bibliotecas\Load;

class Controller
{
    protected const BOOTSTRAP_CSS = "/now-ui-kit/assets/css/bootstrap.min.css";
    protected const NOW_UI_KIT_CSS = "/now-ui-kit/assets/css/now-ui-kit.css";
    protected const BOOTSTRAP_JS = "/now-ui-kit/assets/js/core/bootstrap.min.js";
    protected const JQUERY_JS = "/now-ui-kit/assets/js/core/jquery.3.2.1.min.js";
    protected const POPPER_JS = "/now-ui-kit/assets/js/core/popper.min.js";
    protected const NOW_UI_KIT_JS = "/now-ui-kit/assets/js/now-ui-kit.js";
    protected const GRAF_JS = "/js/graf.js";

    public $view;

    public function __construct()
    {
        $this->view = new \stdClass();

        $this->view->bootstrapCss = $this->css($this::BOOTSTRAP_CSS);
        $this->view->nowUiKitCss = $this->css($this::NOW_UI_KIT_CSS);
        $this->view->bootstrapJs = $this->css($this::BOOTSTRAP_JS);
        $this->view->jquery = $this->css($this::JQUERY_JS);
        $this->view->popper = $this->css($this::POPPER_JS);
        $this->view->nowUiKitJs = $this->css($this::NOW_UI_KIT_JS);
        $this->view->grafJs = $this->css($this::GRAF_JS);

    }

    public function render(string $action) : void
    {
        $current = get_class($this);
        $singleClassName = strtolower(
            str_replace("Controller", "", str_replace(
                "Metrics\\Controller\\",
                "",
                $current
            )));

        include_once "../src/views/".$singleClassName."/".$action.".phtml";
    }

    public function css(string $url) : string
    {
        $arq = new Load();

        $ponteiro = fopen($arq->load()."".$url, "r");
        $linha = "";

        while (!feof($ponteiro)) {
            $linha .= (string) fgets($ponteiro);
        }

        fclose($ponteiro);

        return $linha;
    }
}
