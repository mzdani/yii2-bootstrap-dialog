<?php
/**
 * @project     Yii2 Widget for Bootstrap3 Dialog
 * @filename    Assets.php
 * @author      Mirdani Handoko <mirdani.handoko@gmail.com>
 * @copyright   copyright (c) 2015, Mirdani Handoko
 * @license     BSD-3-Clause
 */

namespace mdscomp\BootstrapDialog\assets;

use yii\web\AssetBundle;

class BootstrapDialogAssets extends AssetBundle {
	public $sourcePath = '@bower/bootstrap3-dialog/dist';
	public $css      = [
		'css/bootstrap-dialog.css',
	];
	public $js       = [
		'js/bootstrap-dialog.js',
	];
	public $depends = [
		'\yii\web\JqueryAsset',
		'\yii\bootstrap\BootstrapPluginAsset',
	];
}
