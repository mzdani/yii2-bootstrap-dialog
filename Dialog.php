<?php
/**
 * @project     Yii2 Widget for Bootstrap3 Dialog
 * @filename    BootstrapDialog.php
 * @author      Mirdani Handoko <mirdani.handoko@gmail.com>
 * @copyright   copyright (c) 2015, Mirdani Handoko
 * @license     BSD-3-Clause
 */

namespace mdscomp\BootstrapDialog;

use mdscomp\BootstrapDialog\widget\BootstrapDialog;
use yii\web\JsExpression;

class Dialog {
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

	private $id;
	private $js;

	public function __construct($config = []) {
		$js = new BootstrapDialog($config);
		$this->js = $js->run();
		$this->id = $js->genId;
	}

	public function getId() {
		return $this->id;
	}

	/**
	 * Return the dialog javascript. Usage: dialogInstance.register()
	 *
	 * @param        $view \yii\web\View|string
	 *
	 * @return JsExpression
	 */
	public function register($view) {
		$js = new JsExpression($this->js);
		if($view !== 'js'){
			$view->registerJs($js, self::POS_END);
		} else {
			return $js;
		}
	}

	/**
	 * Open the dialog. Usage: dialogInstance.open()
	 *
	 * @param        $view \yii\web\View|string
	 *
	 * @return JsExpression
	 */
	public function open($view) {
		$js = new JsExpression($this->js.$this->id.'.open();');
		if($view !== 'js'){
			$view->registerJs($js, self::POS_END);
		} else {
			return $js;
		}
	}

	/**
	 * Close the dialog. Usage: dialogInstance.close()
	 *
	 * @param        $view \yii\web\View
	 */
	public function close($view) {
		$js = new JsExpression($this->id.'.close();');
		$view->registerJs($js, self::POS_END);
	}

	/**
	 * Return the raw modal, equivalent to $('<div class='modal fade'...></div>')
	 *
	 * @param        $view \yii\web\View
	 * @param bool|string $return
	 */
	public function getModal($view, $return = false) {
		if (!$return) {
			$bind   = 'var getModal = ';
			$return = 'alert(getModal);';
			$js = new JsExpression($bind.$this->id.'.getModal();'.$return);
		} else {
			$replace = $this->id.'.getModal();';
			$find = '{getModal}';
			$return = str_replace($find, $replace, $return);
			$js = new JsExpression($return);
		}
		$view->registerJs($js, self::POS_END);
	}

	/**
	 * Return the raw modal dialog.
	 *
	 * @param        $view \yii\web\View
	 * @param bool|string $return
	 */
	public function getModalDialog($view, $return = false) {
		if (!$return) {
			$bind   = 'var getModalDialog = ';
			$return = 'alert(getModalDialog);';
			$js = new JsExpression($bind.$this->id.'.getModalDialog();'.$return);
		} else {
			$replace = $this->id.'.getModalDialog();';
			$find = '{getModalDialog}';
			$return = str_replace($find, $replace, $return);
			$js = new JsExpression($return);
		}
		$view->registerJs($js, self::POS_END);
	}

	/**
	 * Return the raw modal content.
	 *
	 * @param        $view \yii\web\View
	 * @param bool|string $return
	 */
	public function getModalContent($view, $return = false) {
		if (!$return) {
			$bind   = 'var getModalContent = ';
			$return = 'alert(getModalContent);';
			$js = new JsExpression($bind.$this->id.'.getModalContent();'.$return);
		} else {
			$replace = $this->id.'.getModalContent();';
			$find = '{getModalContent}';
			$return = str_replace($find, $replace, $return);
			$js = new JsExpression($return);
		}
		$view->registerJs($js, self::POS_END);
	}

	/**
	 * Return the raw modal header.
	 *
	 * @param        $view \yii\web\View
	 * @param bool|string $return
	 */
	public function getModalHeader($view, $return = false) {
		if (!$return) {
			$bind   = 'var getModalHeader = ';
			$return = 'alert(getModalHeader);';
			$js = new JsExpression($bind.$this->id.'.getModalHeader();'.$return);
		} else {
			$replace = $this->id.'.getModalHeader();';
			$find = '{getModalHeader}';
			$return = str_replace($find, $replace, $return);
			$js = new JsExpression($return);
		}
		$view->registerJs($js, self::POS_END);
	}

	/**
	 * Return the raw modal body.
	 *
	 * @param        $view \yii\web\View
	 * @param bool|string $return
	 */
	public function getModalBody($view, $return = false) {
		if (!$return) {
			$bind   = 'var getModalBody = ';
			$return = 'alert(getModalBody);';
			$js = new JsExpression($bind.$this->id.'.getModalBody();'.$return);
		} else {
			$replace = $this->id.'.getModalBody();';
			$find = '{getModalBody}';
			$return = str_replace($find, $replace, $return);
			$js = new JsExpression($return);
		}
		$view->registerJs($js, self::POS_END);
	}

	/**
	 * Return the raw modal footer.
	 *
	 * @param             $view \yii\web\View
	 * @param bool|string $return
	 */
	public function getModalFooter($view, $return = false) {
		if (!$return) {
			$bind   = 'var getModalFooter = ';
			$return = 'alert(getModalFooter);';
			$js = new JsExpression($bind.$this->id.'.getModalFooter();'.$return);
		} else {
			$replace = $this->id.'.getModalFooter();';
			$find = '{getModalFooter}';
			$return = str_replace($find, $replace, $return);
			$js = new JsExpression($return);
		}
		$view->registerJs($js, self::POS_END);
	}

	/**
	 * Get data entry according to the given key, returns null if no data entry found.
	 *
	 * @param        $view \yii\web\View
	 * @param string $key
	 */
	public function getData($view, $key) {
		$js = new JsExpression($this->id.'.getData('.$key.');');
		$view->registerJs($js, self::POS_END);
	}

	/**
	 * Bind data entry to dialog instance, value can be any types that javascript supports.
	 *
	 * @param        $view \yii\web\View
	 * @param string $key
	 * @param string $value
	 */
	public function setData($view, $key, $value) {
		$js = new JsExpression($this->id.'.setData('.$key.', '.$value.');');
		$view->registerJs($js, self::POS_END);
	}

	/**
	 * Disable all buttons in dialog footer when it's false, enable all when it's true.
	 *
	 * @param      $view \yii\web\View
	 * @param bool $value
	 */
	public function enableButtons($view, $value = true) {
		$js = new JsExpression($this->id.'.enableButtons('.$value.');');
		$view->registerJs($js, self::POS_END);
	}

	/**
	 * When set to true (default), dialog can be closed by clicking close icon in dialog header,
	 * or by clicking outside the dialog, or, ESC key is pressed.
	 *
	 * @param      $view \yii\web\View
	 * @param bool $value
	 */
	public function setClosable($view, $value = false) {
		$js = new JsExpression($this->id.'.setClosable('.$value.');');
		$view->registerJs($js, self::POS_END);
	}

	/**
	 * Calling dialog.open() will automatically get this method called first, but if you want to do
	 * something on your dialog before it's shown, you can manually call dialog.realize() before
	 * calling dialog.open().
	 *
	 * @param        $view \yii\web\View
	 * @param string $value
	 */
	public function realize($view, $value = '') {
		$js = new JsExpression($this->id.'.realize('.$value.');');
		$view->registerJs($js, self::POS_END);
	}

	public function onShow(){

	}

	public function onShown(){

	}

	public function onHide(){

	}

	public function onHidden(){

	}

}