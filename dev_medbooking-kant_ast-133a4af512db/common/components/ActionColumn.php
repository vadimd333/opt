<?php

namespace common\components;


use frontend\models\ApiRecord;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;

class ActionColumn extends \yii\grid\ActionColumn
{
    public function init()
    {
        Html::addCssClass($this->buttonOptions, 'text-lg');
        Html::addCssClass($this->options, 'btn-' . (count(array_filter(explode("{", $this->template)))));
        Html::addCssClass($this->contentOptions, 'action-column');
        parent::init();
        $methods = get_class_methods($this);
        preg_match_all('/button(\w+)/', join(" ", $methods), $m);
        foreach ($m[1] as $button) {
            $this->buttons[lcfirst($button)] = function ($url, $model, $key) use ($button) {
                $result = call_user_func_array([$this, "button" . $button], [$url, $model, $key]);
                if ($result instanceof ButtonColumn) {
                    return $result->asLink();
                } else {
                    return $result;
                }
            };
        }
    }

    public function buttonDelete($url, $model, $key)
    {
        $button = new ButtonColumn();
        $button->icon = "fa fa-trash";
        $button->title = "Удалить";
        $button->url = $url;
        if ($model instanceof ApiRecord) {
            $button->options['title'] = 'В корзину';
        }
        $button->options = [
            'data-confirm' => 'Вы уверены, что хотите удалить этот элемент?',
            'data-method'  => 'post',
            'data-pjax'    => 1,
        ];
        $button->options += $this->buttonOptions;
        return $button;
    }

    public function buttonDownload($url, $model, $key)
    {
        $button = new ButtonColumn();
        $button->icon = "fa fa-download";
        $button->title = "Скачать";
        $button->url = $model->getFile();
        $options = $this->buttonOptions;
        $options['download']='';
        $button->options = $options;
        if (empty($button->url)){
            return false;
        }
        return $button;
    }

    public function buttonRecovery($url, $model, $key)
    {
        $button = new ButtonColumn();
        $button->icon = "fa fa-reply";
        $button->title = "Восстановить";
        $button->url = $url;
        $button->options = $this->buttonOptions;
        return $button;
    }

    public function buttonPlay($url, $model, $key)
    {
        $button = new ButtonColumn();
        $button->icon = "fa fa-play-circle-o";
        $button->title = "Послушать разговоры";
        $button->url = '#';
        $options = [
            'data-file' => $model->getFile(),
            'style'     => 'cursor: pointer',
        ];
        $button->options = array_merge($options, $this->buttonOptions);
        Html::addCssClass($button->options, 'player');
        if (empty($model->getFile())){
            return false;
        }
        return $button;
    }

    public function buttonCalls($url, $model, $key)
    {
        $button = new ButtonColumn();
        $button->icon = "fa fa-play";
        $button->title = "Послушать разговоры";
        $button->url = $url;
        $options = [
            'data-target' => '#player-list',
            'data-toggle' => 'modal',
            'data-id'     => $model->id,
            'data-phone'  => $model->client_phone,
            'data-date'   => $model->create_time,
            'role'        => 'button',
            'aria-hidden' => 'true',
        ];
        $button->options = array_merge($options, $this->buttonOptions);
        return $button;
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        return preg_replace_callback(
            '/\\{([\w\-\/]+)\\}/', function ($matches) use ($model, $key, $index) {
            $action = $matches[1];
            $name = lcfirst(Inflector::camelize(strtr($matches[1], ['/' => '_', '\\' => '_'])));
            if (isset($this->buttons[$name])) {
                if (isset($this->visibleButtons[$name])) {
                    $isVisible = $this->visibleButtons[$name] instanceof \Closure
                        ? call_user_func($this->visibleButtons[$name], $model, $key, $index)
                        : $this->visibleButtons[$name];
                } else {
                    $isVisible = true;
                }
                $url = $this->createUrl($action, $model, $key, $index);
                if ($isVisible) {
                    return call_user_func($this->buttons[$name], $url, $model, $key);
                } else {
                    return '';
                }
            } else {
                return '';
            }
        }, $this->template
        );
    }

    public function createUrl($action, $model, $key, $index)
    {
        if (method_exists($model, 'getUrl') && ($url = $model->getUrl($action)) && !$this->urlCreator) {
            return $url;
        } else {
            return parent::createUrl($action, $model, $key, $index);
        }
    }
}