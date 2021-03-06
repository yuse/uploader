<?php
/* SVN FILE: $Id$ */
/**
 * ファイルカテゴリモデル
 *
 * PHP versions 5
 *
 * Baser :  Basic Creating Support Project <http://basercms.net>
 * Copyright 2008 - 2013, Catchup, Inc.
 *								1-19-4 ikinomatsubara, fukuoka-shi
 *								fukuoka, Japan 819-0055
 *
 * @copyright		Copyright 2008 - 2013, Catchup, Inc.
 * @link			http://basercms.net BaserCMS Project
 * @package			uploader.models
 * @since			Baser v 0.1.0
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://basercms.net/license/index.html
 */
/**
 * Include files
 */
/**
 * ファイルカテゴリモデル
 *
 * @package			uploader.models
 */
class UploaderCategory extends BcPluginAppModel {
/**
 * クラス名
 *
 * @var		string
 * @access	public
 */
	public $name = 'UploaderCategory';
/**
 * DB接続設定
 *
 * @var		string
 * @access	public
 */
	public $useDbConfig = 'plugin';
/**
 * プラグイン名
 *
 * @var		string
 * @access	public
 */
	public $plugin = 'Uploader';
/**
 * バリデート
 *
 * @var		array
 * @access	public
 */
	public $validate = array(
		'name' => array(
			array(
				'rule'		=> array('notEmpty'),
				'message'	=> 'カテゴリ名を入力してください。')
			)
		);
/**
 * コピーする
 * 
 * @param int $id
 * @param array $data
 * @return mixed page Or false
 */
	public function copy($id = null, $data = array()) {
		
		$data = array();
		if($id) {
			$data = $this->find('first', array('conditions' => array('UploaderCategory.id' => $id)));
		}
		
		$data['UploaderCategory']['name'] .= '_copy';
		$data['UploaderCategory']['id'] = $this->getMax('id', array('UploaderCategory.id' => $data['UploaderCategory']['id'])) + 1;
		
		unset($data['UploaderCategory']['id']);
		unset($data['UploaderCategory']['created']);
		unset($data['UploaderCategory']['modified']);
		
		$this->create($data);
		$result = $this->save();
		if($result) {
			return $result;
		} else {
			if(isset($this->validationErrors['name'])) {
				return $this->copy(null, $data);
			} else {
				return false;
			}
		}
		
	}

}
