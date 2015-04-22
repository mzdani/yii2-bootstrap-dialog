<?php
/**
 * @project     Yii2 Widget for Bootstrap3 Dialog
 * @filename    Wrapper.php
 * @author      Mirdani Handoko <mirdani.handoko@gmail.com>
 * @copyright   copyright (c) 2015, Mirdani Handoko
 * @license     BSD-3-Clause
 */

namespace mdscomp\BootstrapDialog\widget;

use yii;
use yii\base\Widget;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\web\JsExpression;
use mdscomp\BootstrapDialog\assets\BootstrapDialogAssets;

class BootstrapDialog extends Widget {
	const TYPE_DEFAULT = 'type-default';
	const TYPE_INFO    = 'type-info';
	const TYPE_PRIMARY = 'type-primary';
	const TYPE_SUCCESS = 'type-success';
	const TYPE_WARNING = 'type-warning';
	const TYPE_DANGER  = 'type-danger';
	const ALERT        = 'alert';
	const CONFIRM      = 'confirm';
	const NORMAL       = 'normal';

	const SIZE_NORMAL = 'size-normal';
	const SIZE_WIDE   = 'size-wide';
	const SIZE_LARGE  = 'size-large';

	const EVENT_BEGIN_BODY = 'beginBody';
	const EVENT_END_BODY   = 'endBody';
	const POS_HEAD         = 1;
	const POS_BEGIN        = 2;
	const POS_END          = 3;
	const POS_READY        = 4;
	const POS_LOAD         = 5;
	const PH_HEAD          = '<![CDATA[YII-BLOCK-HEAD]]>';
	const PH_BODY_BEGIN    = '<![CDATA[YII-BLOCK-BODY-BEGIN]]>';
	const PH_BODY_END      = '<![CDATA[YII-BLOCK-BODY-END]]>';

	public $modal           = self::NORMAL;
	public $type            = self::TYPE_DEFAULT;
	public $size            = self::SIZE_NORMAL;
	public $cssClass        = '';
	public $title           = null;
	public $message         = null;
	public $nl2br           = true;
	public $closable        = true;
	public $closeByBackdrop = true;
	public $closeByKeyboard = true;
	public $spinicon        = 'glyphicon glyphicon-asterisk';
	public $autodestroy     = true;
	public $draggable       = true;
	public $animate         = true;
	public $description     = false;
	public $buttons;
	public $data            = false;
	public $onshow          = false;
	public $onshown         = false;
	public $onhide          = false;
	public $onhidden        = false;
	public $callable        = false;
	public $callback        = false;
	public $option          = [];
	public $js              = false;

	public $genId;
	private $options = [];

	public function init() {
		parent::init();

		$this->initOptions();
	}

	public function run() {
		$dialog = $this->generateScript();
		if ($this->js) {
			return $dialog.';';
		} else {
			$this->view->registerJs($dialog, self::POS_END);
		}
		//return $this->genId;
	}

	protected function initOptions() {
		$this->options = [
			'type'            => $this->type,
			'size'            => $this->size,
			'cssClass'        => $this->cssClass,
			'nl2br'           => $this->nl2br,
			'closable'        => $this->closable,
			'closeByBackdrop' => $this->closeByBackdrop,
			'closeByKeyboard' => $this->closeByKeyboard,
			'spinicon'        => $this->spinicon,
			'autodestroy'     => $this->autodestroy,
			'draggable'       => $this->draggable,
			'animate'         => $this->animate,
			'description'     => $this->description,
		];

		$this->options['title']   = ($this->title !== null) ? $this->_setTitle() : 'null';
		$this->options['message'] = ($this->message !== null) ? $this->_setMessage() : 'null';

		if (is_array($this->buttons)) {
			$this->options['buttons'] = $this->_setButtons();
		}

		if ($this->onshow) {
			$this->options['onshow'] = new JsExpression($this->onshow);
		}

		if ($this->onshown) {
			$this->options['onshown'] = new JsExpression($this->onshown);
		}

		if ($this->onhide) {
			$this->options['onhide'] = new JsExpression($this->onhide);
		}

		if ($this->onhidden) {
			$this->options['onhidden'] = new JsExpression($this->onhidden);
		}

		if ($this->modal === self::ALERT || $this->modal === self::CONFIRM) {
			$this->options['callback'] = new JsExpression($this->callback);
		}

		if (is_array($this->option)) {
			$this->options = array_merge($this->option, $this->options);
		}
	}

	protected function _setTitle() {
		return (is_array($this->title) ? new JsExpression($this->title) : $this->title);
	}

	protected function _setMessage() {
		return (is_array($this->message) ? new JsExpression($this->message) : $this->message);
	}

	protected function _setButtons() {
		$button = [];
		foreach ($this->buttons as $key => $value) {
			$value['label'] = (isset($value['label'])) ? $value['label'] : 'Unknown Buttons '.($key + 1);
			if (isset($value['action'])) {
				$value['action'] = new JsExpression(Html::decode($value['action']));
			}
			$button[$key] = $value;
		}
		return $button;
	}

	protected function Bootstrap() {
		return 'BootstrapDialog.show('.Json::encode($this->options).');';
	}

	protected function BootstrapCallable() {
		$this->genId = 'dialog_'.$this->getId();
		return 'var '.$this->genId.' = new BootstrapDialog('.Json::encode($this->options).');';
	}

	protected function BootstrapAlert() {
		$this->genId = 'dialog_'.$this->getId();
		return 'var '.$this->genId.' = BootstrapDialog.alert('.Json::encode($this->options).')';
	}

	protected function BootstrapConfirm() {
		$this->genId = 'dialog_'.$this->getId();
		return 'var '.$this->genId.' = BootstrapDialog.confirm('.Json::encode($this->options).')';
	}

	protected function registerClientScript($dialog) {
		$this->view->registerJs($dialog, self::POS_END);
	}

	protected function clientScript($dialog) {
		return $dialog;
	}

	protected function generateScript() {
		BootstrapDialogAssets::register($this->view);

		switch ($this->modal) {
			case self::ALERT:
				$dialog = $this->BootstrapAlert();
				break;
			case self::CONFIRM:
				$dialog = $this->BootstrapConfirm();
				break;
			default:
				if ($this->callable) {
					$dialog = $this->BootstrapCallable();
				} else {
					$dialog = $this->Bootstrap();
				}
		}

		return $dialog;
	}
}